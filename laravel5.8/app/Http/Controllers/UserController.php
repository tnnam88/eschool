<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;

class UserController extends Controller
{

    public function index()
    {
        if( Auth::check() ){
            $question = Question::all();

            return view('question.index', ['question'=> $question]);
        }

        return view('auth.login');
    }

    public function save(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($files = $request->file('image')) {
            $destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $insert['image'] = "$profileImage";
        }
        $check = Image::insertGetId($insert);

        return Redirect::to("profile/user_image")
            ->withSuccess('Great! Image has been successfully uploaded.');

    }
}