<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
        return view('testform',['levels'=>$levels,'subjects'=>$subjects]);
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
        return view('test',['questions'=>$questions,'level_id'=>$level_id,'subject_id'=>$subject_id]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user_id = Auth::id();
        $results = $request->all();
        $p = 0;
        if(count($results) == 3){
            $p = 0;
        }
        else {
            foreach ($results as $k => $v) {
                $answer = DB::table('answers')->where('id', $v)->first();
                if ($k == 'starttime'|| $k =='subject' || $k =='level'){
                    continue;
                }

                $answer = DB::table('answers')->where('id', $v)->first();
                if ($answer == null) {
                    continue;
                }
                $p += $answer->is_correct;
            }
        }
        $p = ($p*100)/3;
        DB::table('test_histories')->insert(
            ['user_id'=>$user_id,'subject_id'=>$subject_id,'level_id'=>$level_id,'result'=>$p]
        );

        return view('result',['p'=>$p]);
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
