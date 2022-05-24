<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriController extends Controller
{
    public function getallkategori(){
        return response()->json([
            "data" => Kategori::orderBy("name", "ASC")->get(['id', 'name'])
        ], Response::HTTP_OK);
    }
}
