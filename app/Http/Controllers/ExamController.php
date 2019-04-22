<?php

namespace App\Http\Controllers;

//use App\Question;
use App\Answer;
use App\Level;
use App\Question;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        if( Auth::check() ){
            $username = Auth::user()->name;
            $subject = Subject::all();
            $level = Level::all();
            return view('exam.index', ['subject'=> $subject, 'level' => $level, 'username' => $username]);
        }

        return view('auth.login');
    }

    public function create()
    {
//        if( Auth::check() ){
//            $subject = Subject::all();
//            $level = Level::all();
//            return view('question.create', ['subject'=> $subject, 'level' => $level]);
//        }
//
//        return view('auth.login');
    }
    public function show(Request $request)
    {
//        if( Auth::check() ){
//            $username = Auth::user()->name;
//            $subject = Subject::all();
//            $level = Level::all();
//            return view('exam/show', ['subject'=> $subject, 'level' => $level, 'username' => $username]);
//        }
//
//        return view('auth.login');
    }

    public function store(Request $request)
    {


        return back()->with('success', 'Question has been added');;
    }

    public function test(Request $request)
    {
        if( Auth::check() ){
            $subj = $request->subject_id;
            $lv = $request->level_id;
            $subject = Subject::all();
            $level = Level::all();

            $question = Question::all()->where('subject_id', $subj)->where('level_id', $lv)->inRandomOrder()->limit(5)->get();


            $answer = Answer::all();

            $username = Auth::user()->name;
            return view('exam/test', ['subj'=> $subj, 'lv' => $lv,'username' => $username,'subject'=> $subject, 'level' => $level,'question' => $question,'answer' => $answer]);
        }

        return view('auth.login');
    }
}