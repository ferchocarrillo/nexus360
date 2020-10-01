<?php

namespace App\Http\Controllers;

use App\CgmAppointment;
use App\CgmAppointmentDisposition;
use App\CgmAppointmentList;
use App\CgmQaRating;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppointmentExport;
use App\Exports\AppointmentReportExport;

use App\Imports\AppointmentImport;
use Illuminate\Support\Facades\Crypt;

class CGMController extends Controller
{
    public function __construct()
    {
    }

    public function qa_Index()
    {
        $data = CgmAppointment::leftJoin('cgm_appointment_dispositions', 'cgm_appointments.disposition', '=', 'cgm_appointment_dispositions.name')
        ->leftJoin('users', 'cgm_appointments.user_id', '=', 'users.id')
        ->leftJoin('cgm_qa_ratings','cgm_qa_ratings.appointment_id','=','cgm_appointments.id')
        ->where('cgm_appointment_dispositions.required_appointment',1)
        ->whereNull('cgm_qa_ratings.id')
        ->select('cgm_appointments.id', 'cgm_appointments.callID', 'users.username', 'cgm_appointments.company_name', 'cgm_appointments.appointment_date')
        ->get();

        return view('CGM.QA.index',compact('data'));
    }

    public function qa_rating($callData)
    {
        $appointment = CgmAppointment::leftJoin('cgm_appointment_dispositions', 'cgm_appointments.disposition', '=', 'cgm_appointment_dispositions.name')
        ->leftJoin('cgm_qa_ratings','cgm_qa_ratings.appointment_id','=','cgm_appointments.id')
        ->where('cgm_appointments.id',$callData)
        ->where('cgm_appointment_dispositions.required_appointment',1)
        ->whereNull('cgm_qa_ratings.id')
        ->select('cgm_appointments.*')
        ->get()
        ->first();

        if(!$appointment){
            abort(404); 
        }

        $apt = $appointment;

        return view('CGM.QA.rating',compact(['appointment','apt']));
    }

    public function qa_rating_Store(Request $request){
        
        $qaRating = CgmQaRating::where('appointment_id',$request->appointment_id)->first();
        
        if($qaRating){
            return redirect()->route('cgm.qa.index')->with('error', 'QA Rating Not Valid');
        }

        CgmQaRating::create($request->merge(['details_confirmed_via_call' => $request->has('details_confirmed_via_call'),
        'voice_recording_sent' => $request->has('voice_recording_sent'),
        'accepted_calendar_invite' => $request->has('accepted_calendar_invite'),
        'qa_id' => auth()->user()->id])->all());

        return redirect()->route('cgm.qa.index');
    }

    public function reports()
    {
        return view('CGM.reports');
    }

    public function reportsgetData(Request $request)
    {
        $dates = "$request->startDate||$request->endDate";
        $data = CgmAppointment::leftJoin('cgm_appointment_dispositions', 'cgm_appointments.disposition', '=', 'cgm_appointment_dispositions.name')
            ->leftJoin('users', 'cgm_appointments.user_id', '=', 'users.id')
            ->leftJoin('cgm_qa_ratings','cgm_appointments.id','=','cgm_qa_ratings.appointment_id')
            ->whereDate('cgm_appointments.created_at', '>=', $request->startDate)
            ->whereDate('cgm_appointments.created_at', '<=', $request->endDate)
            ->select('cgm_appointments.id', 'cgm_appointments.callID', 'users.username', 'cgm_appointments.company_name', 'cgm_appointments.disposition', 'cgm_appointment_dispositions.required_appointment','cgm_qa_ratings.id as qaRating')
            ->get();
        return view('CGM.partials.result-report', compact(['dates', 'data']));
    }

    public function downloadReport($dates)
    {
        $objDate = explode('||', $dates);
        return Excel::download(new AppointmentReportExport($objDate), "Appintment_$objDate[0] _ $objDate[1].xlsx");
    }

    public function viewpdf($id)
    {
        $apt =  CgmAppointment::leftJoin('cgm_appointment_dispositions', 'cgm_appointments.disposition', '=', 'cgm_appointment_dispositions.name')
            ->leftJoin('cgm_qa_ratings','cgm_appointments.id','=','cgm_qa_ratings.appointment_id')
            ->leftJoin('users','cgm_qa_ratings.qa_id','=','users.id')
            ->where('cgm_appointment_dispositions.required_appointment', 1)
            ->where('cgm_appointments.id', $id)
            // ->whereNotNull('cgm_qa_ratings.id')
            ->select('cgm_appointments.*','cgm_qa_ratings.details_confirmed_via_call', 
                    'cgm_qa_ratings.voice_recording_sent','cgm_qa_ratings.accepted_calendar_invite',
                    'cgm_qa_ratings.created_at as dateQA','users.name as qaName')
            ->first();

        // return view('CGM.pdf', compact('apt'));

        if (!$apt) return redirect()->back()->with('info', 'PDF not found');
        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->loadView('CGM.pdf', compact('apt'))->stream("dompdf_out.pdf", array("Attachment" => true));

        
    }
    public function pdf($id)
    {
        $apt =  CgmAppointment::leftJoin('cgm_appointment_dispositions', 'cgm_appointments.disposition', '=', 'cgm_appointment_dispositions.name')
            ->leftJoin('cgm_qa_ratings','cgm_appointments.id','=','cgm_qa_ratings.appointment_id')
            ->leftJoin('users','cgm_qa_ratings.qa_id','=','users.id')
            ->where('cgm_appointment_dispositions.required_appointment', 1)
            ->where('cgm_appointments.id', $id)
            // ->whereNotNull('cgm_qa_ratings.id')
            ->select('cgm_appointments.*','cgm_qa_ratings.details_confirmed_via_call', 
                    'cgm_qa_ratings.voice_recording_sent','cgm_qa_ratings.accepted_calendar_invite',
                    'cgm_qa_ratings.created_at as dateQA','users.name as qaName')
            ->first();

        if (!$apt) return redirect()->back()->with('info', 'PDF not found');



        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->loadView('CGM.pdf', compact('apt'))->download($id . '.pdf');
    }

    public function appointmentTracker()
    {
        return view('CGM.appointment-tracker');
    }

    public function appointmentTrackersearch(Request $request)
    {
        return redirect()->route('cgm.appointmenttracker.getdata', Crypt::encrypt($request->CallID));
    }
    public function appointmentTrackerGetData($callData)
    {
        $dataCall = CgmAppointmentList::where('id', Crypt::decrypt($callData))->first();
        if (!$dataCall) return redirect()->back()->withErrors(['CallID' => 'Call ID not found']);
        $dispositions =  CgmAppointmentDisposition::pluck('name', 'name')->toArray();
        return view('CGM.appointment-tracker', compact(['dataCall', 'dispositions']));
    }

    public function appointmentTrackerStore(Request $request)
    {
        $dispositions = join(',', CgmAppointmentDisposition::all()->pluck('name')->toArray());

        if ($request->disposition) {
            $disposition = CgmAppointmentDisposition::where('name', $request->disposition)->first();
        } else {
            $disposition = null;
        }


        $request->validate([
            'callID' => 'required',
            'executive_first_name' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'executive_last_name' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'executive_title' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'company_name' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'location_address' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'location_city' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'location_state' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'location_zip_code' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'phone_number_combined' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'disposition' => ['required', "in:$dispositions"],
            'speciality_of_the_practice' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'solutions_currently_being_used' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'current_contract_term' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'customer_budget' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'percent_of_claims_paid' => ['numeric', 'max:100', ($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'current_solution_positives' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'current_solution_challenges' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'additional_participants' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'cgm_solutions_of_interest' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'confirmed_email' => [($disposition && $disposition->required_appointment) ? 'required' : 'nullable'],
            'appointment_date' => [($disposition && ($disposition->required_appointment || $disposition->required_date)) ? 'required' : 'nullable'],
            // 'lunch_and_learn' => [($disposition && $disposition->required_appointment && ($request->location_state == 'AZ' || $request->location_state == 'SC')) ? 'required' : 'nullable'],
            'lunch_and_learn' => ['nullable'],
            'comments' => 'required'
        ]);

        CgmAppointment::create($request->merge([
            'user_id' => auth()->user()->id
        ])->except(['_token']));
        return redirect('cgm/appointmenttracker')->with('info', 'Record saved successfully');
    }

    public function downliadlists()
    {
        $lists = CgmAppointmentList::selectRaw('name_file_upload, count(0) as Cant')
            ->groupBy('name_file_upload')
            ->get();
        return view('CGM.downloadlists', compact('lists'));
    }

    public function downliadlist($name_file_upload)
    {
        return Excel::download(new AppointmentExport($name_file_upload), "Appintment_$name_file_upload.xlsx");
    }


    public function uploadlist()
    {
        return view('CGM.uploadlist');
    }

    public function uploadlistStore(Request $request)
    {
        $request->validate([
            'uploadList' => 'required'
        ]);

        //get file
        $uploadList = $request->file('uploadList');
        $filePath = $uploadList->getRealPath();

        $checkHeaders = ["companyname", "phonenumbercombined", "executivefirstname", "executivelastname", "executivetitle", "professionaltitle", "executivegender", "mailingaddress", "mailingcity", "mailingstate", "mailingzipcode", "mailingzip4", "locationaddress", "locationcity", "locationstate", "locationzipcode", "locationzip4"];
        $modelHeaders = ["company_name", "phone_number_combined", "executive_first_name", "executive_last_name", "executive_title", "professional_title", "executive_gender", "mailing_address", "mailing_city", "mailing_state", "mailing_zip_code", "mailing_zip_4", "location_address", "location_city", "location_state", "location_zip_code", "location_zip_4"];

        //open and read
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);
        $escapedHeader = [];
        foreach ($header as $key => $value) {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z0-9]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        if ($escapedHeader != $checkHeaders) return redirect()->back()->withErrors(['uploadList' => 'File invalid-> required structure: ' . json_encode($checkHeaders)]);


        $csv_importer = new AppointmentImport();

        if ($csv_importer->import($uploadList)) {
            $message = 'Your file has been successfully imported!';
        } else {
            $message = 'Your file did not import!';
        }
        return redirect()->back()->with('info', $message);
    }
}
