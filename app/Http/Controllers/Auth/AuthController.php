<?php

namespace App\Http\Controllers\Auth; 

use App\Http\Controllers\Controller; //pake ini untuk namespace config
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input dari permintaan
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Periksa apakah ada kesalahan validasi
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }

        // Ekstrak kredensial
        $credentials = $request->only('username', 'password');

        // Coba otentikasi
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Username atau password salah!'], 401);
        }

        // Kembalikan respons sukses
        return response()->json([
            'success' => true,
            'user' => Auth::user(),
            'accessToken' => $token
        ], 200);
    }

    public function register(Request $request)
    {
        // Validasi input dari permintaan
        $validator = Validator::make($request->all(), [
            'level' => 'required|string|max:10',
            'nama' => 'required|string|max:50',
            'username' => 'required|string|max:20|unique:users',
            'foto' => 'nullable|string|max:225',
            'password' => 'required|string|min:1|max:100',
        ]);

        // Periksa apakah ada kesalahan validasi
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }

        // Buat pengguna baru
        $user = User::create([
            'level' => $request->input('level'),
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'foto' => $request->input('foto'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Kembalikan respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil didaftarkan!',
            'user' => $user,
        ], 201);
    }
}
