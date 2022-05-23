<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller{
    
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            "nama" => "required",
            "email" => "email|required",
            "news_id" => "required",
            "value_comment" => "required"
        ]);
        
        if ($validator->fails()){
            return response()->json([
                "message" => "Invalid form input"
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = [
            "nama" => $request->post('nama'),
            "email" => $request->post('email'),
            "news_id" => $request->post('news_id'),
            "value_comment" => $request->post('value_comment')
        ];

        Comment::create($data);

        return response()->json([
            "message"=>"Komentar anda berhasil dipublish"
        ], Response::HTTP_CREATED);

    }
}
