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
use Illuminate\Support\Facades\Input;


// import the Intervention Image Manager Class
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
            $subjects = Subject::all();
            $levels = Level::all();
            $frs= User::all();
            return view('profiles.edit', ['subject' => $subjects, 'level'=>$levels,'currentuser'=>$currentuser,'frs'=>$frs]);
        }
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $id = Auth::user()->id;

        $change_name = $request->get('user_name');
        $change_email = $request->get('user_email');
        $change_city = $request->get('user_city');

        //check if user pass null data
        if ($change_name == null){
            $username = Auth::user()->name;
        }else{
            $username = $change_name;
        }
        if ($change_email == null){
            $email =Auth::user()->email;
        }else{
            $email =$change_email;
        }
        if ($change_city == null){
            $city =Auth::user()->city;
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
            $subject = Auth::user()->subject;
        }

        if (!empty($_POST['user_level'])){
            $level = $_POST['user_level'];
        }else {
            $level = Auth::user()->level;
        }

        //profile img
        if ($request->file('avatar') != NULL){

            $photo = $request->file('avatar');
//            $avatar = Image::make($photo->getRealPath())->resize(45,45)->save($photo.time().$photo->getClientOriginalName());

            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public_avatars')->put($photo->getFilename() . '.' . $extension, File::get($photo));


            $mime = $photo->getClientMimeType();
            $original_filename = $photo->getClientOriginalName();
            $filename = $photo->getFilename() . '.' . $extension;


        }
        else{
            $mime=Auth::user()->mime;
            $original_filename=Auth::user()->original_filename;
            $filename=Auth::user()->filename;
        }
        $frs= User::all();

        //end check

        //update database
        DB::table('users')->where('id', $id) ->update(
            ['name'=>$username,'email'=>$email,'role'=>$role,'mime'=>$mime,'original_filename'=>$original_filename
                ,'filename'=>$filename,'level'=>$level, 'subject' => $subject, 'city'=>$city]
        );
        return back()->with('success','Profile updated !',[$frs]);
    }
}