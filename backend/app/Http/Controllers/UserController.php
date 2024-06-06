<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    // Mendapatkan semua pengguna
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function makeAdmin($userId)
    {
        $user = User::findOrFail($userId);
        $user->role = 'admin';
        $user->save();

        return response()->json(['message' => 'User role updated to admin']);
    }
}