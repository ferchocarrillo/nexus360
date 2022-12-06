<?php

use App\ReminderUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


    function recipients()
    {
        $recipients = ReminderUser::with('reminder')->where('user_id',Auth::user()->id)->get();
        return $recipients;
    }
    function reminders_pend()
    {
        $reminders_pend = ReminderUser::with('reminder')
            ->where('user_id',Auth::user()->id)
            ->where('acknowledge_required', 1)
            ->where('acknowledge', NULL)
            ->get();
        $count = $reminders_pend->count();
        $last_reminder = $reminders_pend->last();
        $last_creation = $last_reminder ? Carbon::parse($last_reminder->created_at)->diffForHumans() : '';
        return  [
            'reminders'=>$reminders_pend,
            'count'=>$count,
            'last_creation'=>$last_creation
        ];
    }
    function creation()
    {
        $recipients = ReminderUser::with('reminder')->where('user_id',Auth::user()->id)->get();
        $recipients_pend = $recipients ->where('user_id',Auth::user()->id)->where('acknowledge_required', 1)->where('acknowledge', NULL);
        $creation = $recipients_pend->where('user_id',Auth::user()->id)->where('acknowledge_required', 1)->where('acknowledge', NULL)->last();
        $date =  $creation->created_at;
        $result = (isset($date)) ? trim($date) : '';
        $result = Carbon::parse($date)->diffForHumans();
        return  $result;
    }

