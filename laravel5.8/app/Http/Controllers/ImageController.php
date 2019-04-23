<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class ImageController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $image = User::latest()->first();
        return view('createimage', compact('image'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'filename' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
//        ]);
        $originalImage= $request->file('filename');
//        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/thumbnail/';
        $originalPath = public_path().'/image/';
//        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
//        $thumbnailImage->resize(150,150);
//        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
        $username = Auth::user()->name;
        $imagemodel= DB::table('user')-> where('name',$username)->update();
        $imagemodel->user_image=time().$originalImage->getClientOriginalName();

        $imagemodel->save();

        return back()->with('success', 'Your images has been successfully Upload');

    }

}