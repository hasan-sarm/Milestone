<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminActionController extends Controller
{
    public function newPost(Request $request)
    {
        $input= $request->all();
        $rules =[
            'description'=>'required',
        ];
        $validator=validator($input,$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = Auth::guard('api')->user();
        $input['user_id']=$user->id;
        $post = Post::create($input);

        if($request->has('images')){
            foreach($request->file('images') as $image){
                $file_extension = $image->extension();
                $file_name = time() . '.' . $file_extension;
                $image->move(public_path('images/products'), $file_name);
                Image::create([
                    'post_id'=>$post->id,
                    'image'=>$file_name
                ]);

            }
        }

        return response()->json([
            'Post' => $post,

            'message' => 'Successfully added',
        ],201);
    }
}
