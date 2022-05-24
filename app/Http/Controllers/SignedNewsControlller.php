<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class SignedNewsControlller extends Controller
{
    public function generatejwtclaims($token){
        
        $res = JWTAuth::parseToken($token)->getPayload();
        return $res['data'];
    }

    public function createnews(Request $request){
        
        $user = $this->generatejwtclaims($request->bearerToken());
        
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'tag_name' => 'required',
            'isi' => 'required',
            'gambar' => 'required|mimes:jpeg,jpg,png',
        ]); 

        if($validator->fails()){
            return response()->json([
                "message" => 'invalid form input'
            ]);
        }

        $image = $request->file('gambar');
        $image_name = md5(time().'_'.$image->getClientOriginalName()).".png";
        $image->move('assets/img/', $image_name);

        $data = [
            'gambar' => asset('assets/img/'.$image_name),
            'judul' => $request->post('judul'),
            'tag_name' => $request->post('tag_name'),
            'isi' => $request->post('isi'),
            'dilihat' => 0,
            'kategori_id' => $request->post('kategori_id'),
            'user_id' => $user['id']
        ];

        News::create($data);

        return response()->json([
            "message" => "berita baru berhasil dibuat"
        ], Response::HTTP_CREATED);

    }

    public function getallnews(Request $request){
        $user = $this->generatejwtclaims($request->bearerToken());
        $news = News::getallnewssigned($user['id']);

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

    public function updatenews(Request $request){
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'tag_name' => 'required',
            'isi' => 'required',
            'gambar' => 'required|mimes:jpeg,jpg,png',
        ]); 

        if($validator->fails()){
            return response()->json([
                "message" => $validator->getMessageBag(),
                "data" => $_POST
            ], Response::HTTP_BAD_REQUEST);
        }

        $image = $request->file('gambar');
        $image_name = md5(time().'_'.$image->getClientOriginalName()).".png";
        $image->move('assets/img/', $image_name);

        $data = [
            'gambar' => asset('assets/img/'.$image_name),
            'judul' => $request->post('judul'),
            'tag_name' => $request->post('tag_name'),
            'isi' => $request->post('isi'),
            'kategori_id' => $request->post('kategori_id'),
        ];

        News::where('id', $request->segment(4))->update($data);

        return response()->json([
            "message" => "berita baru berhasil diupdate"
        ], Response::HTTP_OK);

    }

    public function getnewsbyid(Request $request){
        
        $news = News::getbyidnews($request->segment(4));

        if(empty($news)){
            return response()->json([
                "message" => "berita tidak ditemukan"
            ], Response::HTTP_OK);
        }

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
        ];

        return response()->json([
            "data" => $data
        ], Response::HTTP_OK);

    }

    public function deletenews(Request $request){
        News::where('id', $request->segment(4))->delete();
        return response()->json([
            "message" => 'berita berhasil dihapus'
        ], Response::HTTP_OK);
    }

}
