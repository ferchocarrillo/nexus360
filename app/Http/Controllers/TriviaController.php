<?php

namespace App\Http\Controllers;

use App\Exports\TriviaReportExport;
use App\Trivia;
use App\TriviaAnswer;
use App\TriviaOption;
use App\TriviaQuestion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TriviaController extends Controller
{

    function __construct()
    {
        $this->middleware('can:trivias')->only(['index', 'show', 'answer']);
        $this->middleware('can:trivias.admin')->only(['admin', 'download', 'edit', 'create', 'store']);
    }

    public function index()
    {
        return view('Trivias.index');
    }

    public function admin()
    {
        $trivias = Trivia::withCount(['answers' => function ($q) {
            $q->from(
                TriviaAnswer::select('trivia_id')
                    ->groupBy('trivia_id', 'created_by'),
                'trivia_answers'
            );
        }])->get();
        return view('Trivias.admin', compact('trivias'));
    }

    public function download(Request $request)
    {
        return Excel::download(new TriviaReportExport($request->id), "TriviaReport.xlsx");
    }

    private function validateTrivia(Trivia $trivia)
    {
        // Check Available
        $today = date('Y-m-d');
        if (!($today >= $trivia->started_at && $today <= $trivia->end_date)) {
            return "Trivia $trivia->code is not available";
        }
        // Check Answered
        $answers = $trivia->answers->where('created_by', auth()->user()->id);
        if (count($answers)) {
            return "You have already answered trivia $trivia->code";
        }

        return;
    }

    public function show($code)
    {
        $trivia = Trivia::where('code', $code)->with('questions', 'questions.options')->firstOrFail();

        $validation = $this->validateTrivia($trivia);
        if ($validation !== null) {
            return redirect()->route('trivias.index')->with('error', $validation);
        }

        return view('Trivias.play', compact('trivia'));
    }

    public function edit($id)
    {
        $trivia = Trivia::with('questions.options')->findOrFail($id);
        $trivia->questions->transform(function ($question) {
            $question->options->transform(function ($option) {
                $option->makeVisible('is_correct');
                return $option;
            });
            return $question;
        });
        return response()->json($trivia);
    }

    public function create()
    {
        return view('Trivias.create');
    }

    private function generateCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        if (Trivia::where('code', $code)->exists()) {
            $this->generateCode();
        }

        return $code;
    }

    public function store(Request $request)
    {
        $data = json_decode($request->data, true);

        $trivia = Trivia::create([
            'code' => $this->generateCode(),
            'name' => $data['name'],
            'created_by' => auth()->user()->id,
            'started_at' => $data['started_at'],
            'end_date' => $data['end_date'],
            'time_limit_question' => $data['time_limit_question'],
            'is_enabled' => 1,
        ]);

        foreach ($data['questions'] as $question) {
            $triviaQuestion = new TriviaQuestion(['question' => $question['question'], 'is_enabled' => 1]);
            $trivia->questions()->save($triviaQuestion);
            foreach ($question['options'] as $option) {
                $optionQuestion = new TriviaOption(['option' => $option['option'], 'is_correct' => $option['is_correct'], 'is_enabled' => 1]);
                $triviaQuestion->options()->save($optionQuestion);
            }
        }

        return redirect('/trivias/admin');
    }

    public function answer(Request $request)
    {
        $trivia = Trivia::with(['questions.options' => function ($query) {
            return $query->where('is_correct', 1);
        }])->findOrFail($request->trivia_id);

        $questions = $trivia->questions->map(function ($question) {
            $question->optionCorrect = $question->options[0]->id;
            return $question;
        });

        foreach ($request->answers as $answer) {
            $question  = $questions->filter(function ($question) use ($answer) {
                return $question->id == $answer['question_id'];
            })->first();

            $triviaAnswer = new TriviaAnswer([
                'trivia_id' => $trivia->id,
                'question_id' => $question->id,
                'option_id' => $answer['option_id'],
                'is_correct' => $answer['option_id'] == $question->optionCorrect,
                'seconds' => $answer['seconds'],
                'created_by' => auth()->user()->id
            ]);
            $triviaAnswer->save();
        }

        return response()->json(true);
    }
}
