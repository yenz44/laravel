<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function imageUpload()
    {
    	return view('image.upload');
    }
    public function imageUploadPost(Request $Request)
    {
    	$Request->validate(['image' => 'required|image|mimes:jpeg,png,gif|max:2048',]);

    	$imageName= time().'.'.$request->image->
               extension();

               $request ->image->move(public_path('image'), $imageName);

               return back()
               -> with ('success','You Have Successfully upload Image.')
               -> with ('image',$imageName);
    }
}
