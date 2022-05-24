<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnonimNewsController extends Controller{
    
    public function getallnews(){
        
        $news = News::getallnews();

        $data = array();

        foreach($news as $n){

            $data[] = [
                'id' => $n->id,
                'judul' => $n->judul,
                'tag_name' => $n->tag_name,
                'isi' => $n->isi,
                'gambar' => $n->gambar,
                'dilihat' => $n->dilihat,
                'author_name' => $n->author_name,
                'kategori_name' => $n->kategori_name,
                'kategori_id' => $n->kategori_id,
                'total_like' => count(Like::where('news_id', $n->id)->get())
            ];

        }

        return response()->json([
            "total" => count($data),
            "data" => $data
        ], Response::HTTP_OK);

    }

    public function getnewsbyid(Request $request){

        $id = $request->segment(3);
        
        $news = News::getbyidnews($id);

        if(empty($news)){
            return response()->json([
                "message" => "news data not found"
            ], Response::HTTP_BAD_REQUEST);
        }

        # dilihat ++
        News::where("id", $id)->update([
            "dilihat"=> $news?->dilihat + 1
        ]);

        $data = [
            'id' => $news?->id,
            'judul' => $news?->judul,
            'tag_name' => $news?->tag_name,
            'isi' => $news?->isi,
            'gambar' => $news?->gambar,
            'dilihat' => $news?->dilihat,
            'author_name' => $news?->author_name,
            'kategori_name' => $news?->kategori_name,
            'total_like' => count(Like::where('news_id', $news?->id)->get()),
            'comment' => Comment::where("news_id", $news?->id)->orderBy("id", "DESC")->get(["nama", "email", "value_comment"])
        ];

        return response()->json([
            "data" => $data
        ], Response::HTTP_OK);

    }
}
