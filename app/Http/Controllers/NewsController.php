<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse('News successfully fetched', NewsResource::collection(News::all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $user_id = Auth::user()->id;
        $path = Storage::disk('public')->put('img/news', $request->file('gambar'));

        $news = News::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tag_name' => $request->tag_name,
            'gambar' => asset('storage/' . $path),
            'dilihat' => 0,
            'user_id' => $user_id,
            'kategori_id' => $request->kategori_id
        ]);

        return $this->successResponse('Berita berhasil disimpan', new NewsResource($news));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        if (is_null($news)) {
            return $this->errorResponse('News does not exist');
        }
        return $this->successResponse('News successfully fetched', new NewsResource($news));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $this->validation($request);

        $user_id = Auth::user()->id;
        $path = Storage::disk('public')->put('img/news', $request->file('gambar'));

        $news->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tag_name' => $request->tag_name,
            'gambar' => asset('storage/' . $path),
            'dilihat' => 0,
            'user_id' => $user_id,
            'kategori_id' => $request->kategori_id
        ]);

        return $this->successResponse('Berita berhasil diubah', new NewsResource($news));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return $this->successResponse('Berita berhasil dihapus');
    }

    public function successResponse($message, $result = [], $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $result
        ];

        return response()->json($response, $code);
    }

    public function errorResponse($message, $result = [], $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($result)) {
            $response['data'] = $result;
        }

        return response()->json($response, $code);
    }

    public function validation($request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'tag_name' => 'required',
            'kategori_id' => 'required|integer'
        ]);

        // if validation fails, an Illuminate\Validation\ValidationException
        // exception will be thrown and the proper error response will automatically be sent back to the user
    }

}
