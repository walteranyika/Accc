<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function subscribe(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'=>'required|integer|exists:users,id',
            'website_id'=>'required|integer|exists:websites,id',
        ]);
        if ($validator->fails()){
            $errors= $validator->errors();
            return response(['status'=>'Subscription creation failed','errors'=>$errors],400);
        }
        //check if subscription exists
        $sub = Subscription::where(['user_id'=>$request->user_id,'website_id'=>$request->website_id])->first();
        if ($sub){
            return response(['status'=>'Subscription creation failed','errors'=>['Subscription already exists']],400);
        }
        $sub = Subscription::create($request->all());

        return response(['status'=>'Subscription created'], 201);
    }
}
