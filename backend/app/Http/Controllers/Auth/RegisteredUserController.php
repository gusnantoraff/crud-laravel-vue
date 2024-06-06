<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    // Set validation rules
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Response for validation errors
    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    // Attempt to create a new user
    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Check if user creation was successful
    if ($user) {
        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data' => $user
        ], 201);
    }

    // Failed to create a new user
    return response()->json([
        'success' => false,
        'message' => 'Registrasi gagal',
    ], 409);
}

}
