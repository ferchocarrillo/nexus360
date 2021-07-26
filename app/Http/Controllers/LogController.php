<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:adminlogs')->only('index');
    }
    private function getLogFileDates()
    {
        $dates = [];
        $files = glob(storage_path('logs/*.log'));

        $files = array_reverse($files);
        foreach ($files as $path) {
            $fileName = basename($path);
            array_push($dates, $fileName);
        }

        return $dates;
    }

    private function customlogger($configDate = null){

        $availableDates = $this->getLogFileDates();

        if (count($availableDates) == 0) {
            return [
                'success' => false,
                'message' => 'No log available'
            ];
        }

        if ($configDate == null) {
            $configDate = $availableDates[0];
        }

        if (!in_array($configDate, $availableDates)) {
            return [
                'success' => false,
                'message' => 'No log file found with selected date ' . $configDate
            ];
        }

        
        $pattern = "/^\[(?<date>.*)\]\s(?<env>\w+)\.(?<type>\w+):(?<message>.*)/m";
        $patternUserId = "/\{\"userId\":(?<user>.*)\,/";

        $fileName =  $configDate;
        $content = file_get_contents(storage_path('logs/' . $fileName));
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER, 0);

        $logs = [];
        foreach ($matches as $match) {

            $user = "";
            preg_match_all($patternUserId,$match['message'],$userId,PREG_SET_ORDER,0);
            
            if (count($userId)){
                $user  = User::findOrFail((float)$userId[0]['user'])->name;
            }


            $logs[] = [
                'timestamp' => $match['date'],
                'env' => $match['env'],
                'type' => $match['type'],
                'message' => trim($match['message']),
                'user'=>$user
            ];
        }

        $date = $fileName;

        $data = [
            'available_log_dates' => $availableDates,
            'date' => $date,
            'filename' => $fileName,
            'logs' => $logs
        ];
        

        return ['success' => true, 'data' => $data];
    }


    public function index($configDate = null){
        $logs = $this->customlogger($configDate);
        return view('log',compact('logs'));
    }
}
