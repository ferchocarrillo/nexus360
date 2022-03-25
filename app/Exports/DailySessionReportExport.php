<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DailySessionReportExport implements FromCollection, WithHeadings
{
    public $dailySessions;

    function __construct($dailySessions)
    {
        $this->dailySessions = $dailySessions;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->dailySessions;
    }

    public function headings(): array
    {
        return [
            "id",
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
            "created_by",
            "created_at",
            "updated_at"
        ];
    }
}
