<?php

namespace App\Http\Controllers;

use App\Level;
use App\Result;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Support\Facades\DB;

class ShowProfileController extends Controller
{

    public function index()
    {
        if( Auth::check() ){

            $user = User::all();
            $currentuser = new User();
            foreach ($user as $u){
                if ($u->id == Auth::user()->id){
                    $currentuser = $u;
                }
            }

            $subject = Subject::all();
            $level = Level::all();

            return view('profile.show_profile', ['currentuser'=> $currentuser,'subject' => $subject, 'level'=>$level]);
        }

        return view('auth.login');
    }
    public function showmark(Request $request)
    {
        $user = User::all();
        $currentuser = new User();
        foreach ($user as $u){
            if ($u->id == Auth::user()->id){
                $currentuser = $u;
            }
        }
        $subject = Subject::all();
        $level = Level::all();
        $subj = $request->subject_id;
        $lv = $request->level_id;

        $visitor = DB::table('results')->select('mark','created_at')
            ->where('user_id',$currentuser->id)
            ->where('subject_id',$subj)
            ->where('level_id',$lv)
            ->orderBy("created_at")

            ->get();

        $result[] = ['Date','Your Mark'];
        $count = 0;
        foreach ($visitor as $key) {
            $dt = new \DateTime($key->created_at);
            $date = $dt->format('m/d/Y');
            $result[] = [$key->created_at, $key->mark];
        }

        return view('profile.show_mark',['currentuser'=>$currentuser,'subject' => $subject, 'level'=>$level,'visitor'=>json_encode($result)]);

    }



}