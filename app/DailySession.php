<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailySession extends Model
{
    protected $fillable = [
        "employee_id",
        "national_id",
        "agent_name",
        "corporate_email",
        "lob",
        "campaign",
        "team_leader",
        "type",
        "tactic",
        "behaviour",
        "metric",
        "score",
        "documented",
        "root_cause",
        "educational_tool",
        "comments",
        "acknowledge",
        "created_by"
    ];

    public function creator(){
        return $this->belongsTo('App\User','created_by');
    }
}
