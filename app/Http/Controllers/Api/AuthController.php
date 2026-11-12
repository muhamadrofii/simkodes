<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Otentikasi pengguna dan terbitkan Sanctum Bearer Token
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password yang Anda masukkan salah.',
            ], 401);
        }

        // Hapus token lama untuk keamanan (Single Active Token)
        $user->tokens()->delete();

        $token = $user->createToken('simkodes-api-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil.',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ],
        ], 200);
    }

    /**
     * Dapatkan data user yang sedang aktif
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user(),
        ], 200);
    }

    /**
     * Revoke Bearer Token (Logout)
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Token berhasil dicabut, Anda telah logout.',
        ], 200);
    }
}
