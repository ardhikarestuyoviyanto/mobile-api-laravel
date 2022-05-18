<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller{

    public function index(){
        return response()->json([
            "message"=>"Hello World"
        ], Response::HTTP_OK);
    }
    
}
