<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller{
    
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            "device_id" => "required",
            "news_id" => "required"
        ]);

        if($validator->fails()){
            return response()->json([
                "message" => "Invalid form input"
            ], Response::HTTP_BAD_REQUEST);
        }

        if (count(News::where('id', $request->post('news_id'))->get()) == 0){
            return response()->json([
                "message" => "news id invalid"
            ], Response::HTTP_BAD_REQUEST);
        }

        if (count(Like::where("news_id", $request->post('news_id'))->where("device_id", $request->post('device_id'))->get()) > 0){
            return response()->json([
                "message"=>"Anda telah melakukan like pada berita ini"
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = [
            "device_id" => $request->post('device_id'),
            "news_id" => $request->post('news_id')
        ];

        Like::create($data);

        return response()->json([
            "message" => "Like Berita Berhasil"
        ], Response::HTTP_CREATED);

    }

}
