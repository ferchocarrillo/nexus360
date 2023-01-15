<?php

namespace App\Mail;

use App\PayrollAdjustment;
use App\PayrollAdmin;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use stdClass;

class PayrollAdjustmentPendingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adjustments;
    public $countSupervisor;
    public $countOM;
    public $total;
    private $mail;
    private $permissionsFilter;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->adjustments = PayrollAdjustment::withoutAppends()
        ->with([
            'employee'=>function($query){
                $query->select('id','full_name','supervisor','payroll_manager')
                ->whereNull('termination_date');
            }, 
        ])
        ->where('status','Pendiente')
        ->select(
            'payroll_adjustments.employee_id',
            DB::raw("IIF([payroll_adjustments].[supervisor_approval_status] is null,'Supervisor','OM') as pending_for"),
            )
        ->get();



        $this->countOM = $this->adjustments->where('pending_for','OM')->count();
        $this->countSupervisor = $this->adjustments->where('pending_for','Supervisor')->count();
        $this->total =$this->countOM + $this->countSupervisor;
        
        $this->adjustments = $this->adjustments->groupBy(function($adjustment, $key){
            return $adjustment->employee->supervisor.$adjustment->employee->payroll_manager.$adjustment->pending_for;
        });
        
        $this->adjustments =  $this->adjustments->values()->map(function ($item, $key) {
            $firstAdjustment = $item->first();
            return (object)[
                'supervisor' => $firstAdjustment->employee->supervisor,
                'payroll_manager' => $firstAdjustment->employee->payroll_manager,
                'pending_for' => $firstAdjustment->pending_for,
                'cant' => $item->count()
            ];
        })->sortByDesc(function($adjustment){
            return [$adjustment->pending_for, $adjustment->cant];
        })->values();

        $this->mail= new stdClass;

        $this->permissionsFilter = ['payroll.adjustments'];

        $this->mail->to =  User::whereHas('roles.permissions',function($query){
            $query->whereIn('permissions.slug',$this->permissionsFilter);
        })->whereHas('masterfile2',function($query){
            $query->whereNull('termination_date');
        })
        ->select('users.email')
        ->pluck('email')
        ->toArray();

        $this->mail->cc = PayrollAdmin::where('name','emails_reportadjustmentspending')->firstOrFail()->value;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('prenomina.mail.adjustments')->with(['message'=>$this])
        ->to($this->mail->to)
        ->cc($this->mail->cc);
    }
}
