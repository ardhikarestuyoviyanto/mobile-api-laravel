<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function getalltag(){
        return response()->json([
            "data" =>Tag::orderBy("name", "ASC")->get(['id', 'name'])
        ], Response::HTTP_OK);
    }
}
