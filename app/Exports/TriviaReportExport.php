<?php

namespace App\Exports;

use App\TriviaAnswer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TriviaReportExport implements FromCollection, WithHeadings, WithMapping
{

    protected $answers;

    function __construct($trivia_id)
    {
        $this->answers = TriviaAnswer::where('trivia_id',$trivia_id)->get();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->answers;
    }

    public function map($row): array
    {   
        return [
            $row->id,
            $row->creator->national_id,
            $row->creator->name,
            $row->trivia->id,
            $row->trivia->code,
            $row->trivia->name,
            $row->question->id,
            $row->question->question,
            ($row->option_id ? $row->option->id : null),
            ($row->option_id ? $row->option->option : null),
            $row->is_correct,
            $row->seconds,
            $row->created_at
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'national_id',
            'name',
            'trivia_id',
            'trivia_code',
            'trivia_name',
            'question_id',
            'question',
            'option_id',
            'option',
            'is_correct',
            'seconds',
            'created_at',
        ];
    }
}
