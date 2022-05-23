<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Like;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller{
    
    public function getnewsbykategori(Request $request){

        $id = $request->segment(4);
        $news = News::getbykategorinews($id);

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
            "kategori_name" => Kategori::where("id", $id)->first()?->name,
            "total" => count($data),
            "data" => $data
        ], Response::HTTP_OK);

    }

    public function getnewsbytagname(Request $request){

        $validator = Validator::make($request->all(), [
            "tag_name"=>'required'
        ]);

        if($validator->fails()){
            return response()->json([
                "message" => "invalid form input"
            ], Response::HTTP_BAD_REQUEST);
        }

        $tagname = $request->post('tag_name');
        $news = News::getbytagnews($tagname);

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
            "tag_name" => $tagname,
            "total" => count($data),
            "data" => $data
        ], Response::HTTP_OK);

    }

}
