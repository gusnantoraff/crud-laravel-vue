<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Set validasi
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Respons kesalahan validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Coba melakukan login
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Jika berhasil login
            $user = Auth::user();
    
            // Dapatkan token
            $token = $user->createToken('token-name')->plainTextToken;
    
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => $user,
                'token' => $token,
            ], 200);
        }
    
        // Jika login gagal
        return response()->json([
            'success' => false,
            'message' => 'Login gagal',
        ], 401);
    }
    public function store(Request $request)
    {
        // Set validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required', 
            'username' => 'required', 
            'email' => 'required', 
            'password' => 'required',
        ]);

        // Respons kesalahan validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Simpan ke database
        $registrasi = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Sukses menyimpan ke database
        if ($registrasi) {
            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil',
                'data' => $registrasi
            ], 201);
        }

        // Gagal menyimpan ke database
        return response()->json([
            'success' => false,
            'message' => 'Registrasi gagal',
        ], 409);
    }

}
