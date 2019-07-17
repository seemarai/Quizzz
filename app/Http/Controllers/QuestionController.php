<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Examinfo;

class questionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * \Illuminate\Http\Response
     */
    public function index()
    {
         return view('makequestion.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * \Illuminate\Http\Response
     */
    public function create()
    {
         return view('makequestion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question= new Question;

        $question = Question::create([
                'quiz_id' => $request->input('quizid'),
                'question' => $request->input('question'),
                'choice1' => $request->input('option1'),
                'choice2' => $request->input('option2'),
                'choice3' => $request->input('option3'),
                'choice4' => $request->input('option4'),
                'answer' => $request->input('answer')

            ]);

        $id = $request->input('quizid');

        $qustionCount=Question::where('quiz_id','=', $id)->count();

        $selectLenth=Examinfo::where('id','=',$id)->value('question_lenth');
        //return $selectLenth;

        if ($qustionCount < $selectLenth ) {
            $examinfo = Examinfo::find($id);
            return view('makequestion.create', ['examinfo' => $examinfo]);
        }else{
            $uniqueId=Examinfo::where('id','=',$id)->value('uniqueid');
            return view('makequestion.index',['uniqueid' =>$uniqueId]);

        }

    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     *  int  $id
     *  \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if (isset($_GET['submitFromEditPage'])) {
            $questionid=$id;
            $selectAll=Question::where('id',$questionid)->get();
            return view('makequestion.editone')->with('questions',$selectAll);
        }else{
        //this is for review teacher question
        $selectIdForQuestion=Examinfo::where('uniqueid',$id)->value('id');
        $selectQuestions=Question::where('quiz_id',$selectIdForQuestion)->get();
        return view('makequestion.edit')->with('questions',$selectQuestions);
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     *  \Illuminate\Http\Request  $request
     *  int  $id
     *  \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quiz_id=$request->input('quiz_id');
        $update=Question::where('id',$id)->update([
                           'question' => $request->input('question'),
                           'choice1' => $request->input('choice1'),
                           'choice2' => $request->input('choice2'),
                           'choice3' => $request->input('choice3'),
                           'choice4' => $request->input('choice4'),
                           'answer' => $request->input('answer')

                        ]);
        $selectQuestions=Question::where('quiz_id',$quiz_id)->get();
        return view('makequestion.edit')->with('questions',$selectQuestions)->with('success', 'update success');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     *   int  $id
     *  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
