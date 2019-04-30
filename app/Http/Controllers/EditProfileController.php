<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Subject;
use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
class EditProfileController extends Controller
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
            return view('profiles.edit', ['user_name'=> $currentuser->name,'user_email'=> $currentuser->email,'user_city'=> $currentuser->user_city,
                'subject' => $currentuser->user_fav_subject, 'level'=>$currentuser->user_level,'subject' => $subject, 'level'=>$level]);
        }
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $id = Auth::user()->id;

//        $this->validate(request(), [
//            'username' => 'required',
//            'city' => 'required'
//        ]);


//        request()->validate([
//            'name' => 'required',
//            'author' => 'required',
//        ]);
        $username ="";
        $change_name = $request->get('user_name');
        if ($change_name == null){
            $username = Auth::user()->name;
        }else{
            $username = $change_name;
        }
        $city='';
        $change_city = $request->get('user_city');
        if ($change_city == null){
            $city =Auth::user()->user_city;
        }else{
            $city =$change_city;
        }
        if (!empty($_POST['user_role'])){
            $role = $_POST['user_role'];
        }else{
            $role = Auth::user()->role;
        }
        if (!empty($_POST['user_subject'])){
            $subject = $_POST['user_subject'];
        }else{
            $subject = Auth::user()->user_fav_subject;
        }
        if (!empty($_POST['user_level'])){
            $level = $_POST['user_level'];
        }else{
            $level = Auth::user()->user_level;
        }
        //profile img
        if ($request->file('avatar') != NULL){

            $photo = $request->file('avatar');


            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public_avatars')->put($photo->getFilename() . '.' . $extension, File::get($photo));


            $mime = $photo->getClientMimeType();
            $original_filename = $photo->getClientOriginalName();
            $filename = $photo->getFilename() . '.' . $extension;



//            $name = $request->file('avatar');
//            $extension = $name->getClientOriginalExtension();
//            Storage::disk('public')->put($name->getFilename().'.'.$extension,  File::get($name));
//            $mime = $name->getClientMimeType();
//            $original_filename = $name->getClientOriginalName();
//            $filename = $name->getFilename().'.'.$extension;
        }
        else{
            $mime=Auth::user()->mime;
            $original_filename=Auth::user()->original_filename;
            $filename=Auth::user()->filename;
        }
        DB::table('users')->where('id', $id) ->update(
            ['name'=>$username,'role'=>$role,'mime'=>$mime,'original_filename'=>$original_filename,'filename'=>$filename,
                'level'=>$level, 'subject' => $subject, 'city'=>$city]
        );
        $user_name = Auth::user()->name;
        return back()->with('success','Profile updated !');
    }
}