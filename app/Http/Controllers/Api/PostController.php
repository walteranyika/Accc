<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SentMail;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required|string|min:10',
            'body'=>'required|string|min:50',
            'website_id'=>'required|integer|exists:websites,id',
        ]);
        if ($validator->fails()){
            $errors= $validator->errors();
            return response(['status'=>'Failed to create a post', 'errors'=>$errors],400);
        }
        $post = Post::create($request->all());
        //Entry for all subscribed users
        $website = Website::find($request->website_id);
        $subscriptions = $website->subscriptions;
        foreach ($subscriptions as $subscription){
           SentMail::create(['user_id'=>$subscription->user->id,'post_id'=>$post->id]);
        }
        return response(['status'=>'Post created', 'post'=>$post->id],201);

    }
}
