<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                "message"=> "ada inputan yang tidak sesuai"
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = [
            'email' => $request->post('email'),
            'password' => $request->post('password')
        ];

        if (!$token = auth('api')->attempt($data)){

            return response()->json([
                "message"=>"email atau password saalah"
            ], Response::HTTP_BAD_REQUEST);

        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
        
        return response()->json([
            'token' => $token,
        ], Response::HTTP_OK);
    }

    public function register(Request $request) {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'email' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                "message"=> "ada inputan yang tidak sesuai"
            ], Response::HTTP_BAD_REQUEST);
        }

        if (count(User::where('email', $request->post('email'))->get()) > 0){
            return response()->json([
                "message"=> "email telah digunakan"
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = [
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'nama' => $request->post('nama'),
            'alamat' => $request->post('alamat')
        ];

        User::create($data);

        return response()->json([
            "message"=>"Registrasi akun berhasil"
        ], Response::HTTP_OK);

    }

}
