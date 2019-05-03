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
            return view('profiles.show', compact('level','subject','currentuser','not_count'));
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

        $s_name="";$l_name="";
//        foreach ($subject as $s){
//            if ($s->id == $subj){
//                $s_name = $s->name;
//            }
//        }
//        foreach ($level as $l){
//            if ($l->id == $lv){
//                $l_name = $l->name;
//            }
//        }


        $visitor = DB::table('results')->select('mark','created_at')
            ->where('user_id',$currentuser->id)
            ->where('subject_id',$subj)
            ->where('level_id',$lv)
            ->orderBy("created_at")
            ->get();
        $result[] = ['Date','Your Mark'];

        foreach ($visitor as $key) {
            $dt = new \DateTime($key->created_at);
            $date = $dt->format('m/d/Y');
            $result[] = [$key->created_at, $key->mark];
        }
        $frs= User::all();
        return view('profiles.show_mark',['currentuser'=>$currentuser,'subj'=>$s_name,'lv'=>$l_name,
                          'subject' => $subject, 'level'=>$level,'visitor'=>json_encode($result),'frs'=>$frs]);
    }
}