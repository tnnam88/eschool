<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;


class TestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function testform()
    {
        $levels = DB::table('levels')->get();
        $subjects = DB::table('subjects')->get();
        $frs= User::all();
        return view('tests.testform',['levels'=>$levels,'subjects'=>$subjects,'frs'=>$frs]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {
        $level_id = $request->input('testlvl_id');
        $subject_id = $request->input('testsubject_id');
        $questions = DB::table('questions')
            ->where('level_id',$level_id)
            ->where('subject_id',$subject_id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        $frs= User::all();
        return view('tests.test',['questions'=>$questions,'level_id'=>$level_id,'subject_id'=>$subject_id,'frs'=>$frs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new question.
     *
     * @return \Illuminate\Http\Response
     */
    public function addQuestionForm()
    {
        $levels = DB::table('levels')->get();
        $subjects = DB::table('subjects')->get();
        $frs= User::all();
        return view('tests.addQuestionForm',['levels'=>$levels,'subjects'=>$subjects,'frs'=>$frs]);
    }

    /**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request)
    {

    }

    /**
     * Store a newly created question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addQuestion(Request $request)
    {
        $user_id = Auth::user()->id;
        $level_id = $request->input('testlvl_id');
        $subject_id = $request->input('testsubject_id');
        $question = $request->input('question');
        $answer1 = $request->input('answer1');
        $answer2 = $request->input('answer2');
        $answer3 = $request->input('answer3');
        $answer = $request->input('answer');

        $question_id = DB::table('questions')->insertGetId(
            ['user_id'=>$user_id,'subject_id' => $subject_id, 'level_id' => $level_id, 'content' => $question]
        );
        DB::table('answers')->insert(
            ['question_id' => $question_id, 'content' => $answer1, 'is_correct' => 0]
        );
        DB::table('answers')->insert(
            ['question_id' => $question_id, 'content' => $answer2, 'is_correct' => 0]
        );
        DB::table('answers')->insert(
            ['question_id' => $question_id, 'content' => $answer3, 'is_correct' => 0]
        );
        DB::table('answers')->insert(
            ['question_id' => $question_id, 'content' => $answer, 'is_correct' => 1]
        );
        $frs= User::all();
        return view('tests.addQuestionResult',compact('frs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function result(Request $request)
    {
        $level_id = $request->input('level_id');
        $subject_id = $request->input('subject_id');
        $timetest = $request->input('timetest');
        $user_id = Auth::id();
        $results = $request->all();
        $p = 0;
        if(count($results) == 3){
            $p = 0;
        }
        else {
            foreach ($results as $k => $v) {
                $answer = DB::table('answers')->where('id', $v)->first();
                if ($k == 'starttime'|| $k =='subject_id' || $k =='level_id'|| $k =="timetest"){
                    continue;
                }

                $answer = DB::table('answers')->where('id', $v)->first();
                if ($answer == null) {
                    continue;
                }
                $p += $answer->is_correct;
            }
        }
        DB::table('results')->insert(
            ['user_id'=>$user_id,'subject_id'=>$subject_id,'level_id'=>$level_id,'result'=>$p,'timetest'=>$timetest]
        );
        $frs= User::all();

        return view('tests.result',['p'=>$p,'timetest'=>$timetest,'frs'=>$frs]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
