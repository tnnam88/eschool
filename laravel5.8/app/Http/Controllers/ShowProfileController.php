<?php
namespace App\Http\Controllers;
use App\Level;
use App\Result;
use App\Subject;
use App\Test_history;
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
            /*for all view include layout*/
            $user = Auth::user();
            $notifications = DB::table('notifications')
                ->where('receiver_id','=',$user->id)
                ->where('sender_id','!=',$user->id)
                ->where('checked','=',0)
                ->orderBy('id','DESC')
                ->limit(5)
                ->get();
            $not_count = DB::table('notifications')
                ->where('receiver_id','=',$user->id)
                ->where('sender_id','!=',$user->id)
                ->where('checked','=',0)
                ->orderBy('id','DESC')
                ->count();
            $activities = DB::table('notifications')
                ->where('sender_id','=',$user->id)
                ->where('checked','=',0)
                ->orderBy('id','DESC')
                ->limit(5)
                ->get();
            $frs= User::all();

//            $test = DB::table('test_histories')->select('subject_id','level_id','mark','time','created_at')
//                ->where('user_id',$currentuser->id)
//                ->orderBy('created_at')
//                ->get();

            $test = Test_history::all()->where('user_id',Auth::user()->id)->sortBy('created_at',0,true);

            return view('profiles.show', compact('frs','notifications','not_count','activities','user','level','subject','currentuser','test'));
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
        foreach ($subject as $s){
            if ($s->id == $subj){
                $s_name = $s->name;
            }
        }
        foreach ($level as $l){
            if ($l->id == $lv){
                $l_name = $l->name;
            }
        }

        $notifications = DB::table('notifications')
            ->where('receiver_id','=',$currentuser->id)
            ->where('sender_id','!=',$currentuser->id)
            ->where('checked','=',0)
            ->orderBy('id','DESC')
            ->limit(5)
            ->get();
        $not_count = DB::table('notifications')
            ->where('receiver_id','=',$currentuser->id)
            ->where('sender_id','!=',$currentuser->id)
            ->where('checked','=',0)
            ->orderBy('id','DESC')
            ->count();
        $activities = DB::table('notifications')
            ->where('sender_id','=',$currentuser->id)
            ->where('checked','=',0)
            ->orderBy('id','DESC')
            ->limit(5)
            ->get();



        //graph1
        $visitor = DB::table('test_histories')->select('mark','created_at')
            ->where('user_id',$currentuser->id)
            ->where('subject_id',$subj)
            ->where('level_id',$lv)
            ->orderBy("created_at",'asc')
            ->get();
        $result[] = ['Date','Your Mark'];

        foreach ($visitor as $key) {
            $dt = new \DateTime($key->created_at);
            $date = $dt->format('m/d/Y');
            $result[] = [$key->created_at, $key->mark];
        }

        //graph2
        $time_count = DB::table('test_histories')->select('time','created_at')
            ->where('user_id',$currentuser->id)
            ->where('subject_id',$subj)
            ->where('level_id',$lv)
            ->orderBy("created_at",'asc')
            ->get();
        $time[] = ['Date','Your Mark'];

        foreach ($time_count as $key) {
            $dt = new \DateTime($key->created_at);
            $date = $dt->format('m/d/Y');
            $time[] = [$key->created_at, $key->time];
        }
        $frs= User::all();

        return view('profiles.show_mark',['currentuser'=>$currentuser,'subj'=>$s_name,'lv'=>$l_name,
                          'subject' => $subject, 'level'=>$level,'visitor'=>json_encode($result),'time_count'=>json_encode($time)
                            ,'frs'=>$frs,'notifications'=>$notifications,'not_count'=>$not_count,'activities'=>$activities]);
    }
}