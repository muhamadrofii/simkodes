<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * Otentikasi pengguna dan terbitkan Sanctum Bearer Token
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->sendError('Email atau password yang Anda masukkan salah.', null, 401);
        }

        // Single active token: hapus token lama
        $user->tokens()->delete();

        $token = $user->createToken('simkodes-api-token')->plainTextToken;

        return $this->sendResponse([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 'Login berhasil.', 200);
    }

    /**
     * Dapatkan data user yang sedang aktif
     */
    public function me(Request $request): JsonResponse
    {
        return $this->sendResponse($request->user(), 'Profil pengguna berhasil dimuat.');
    }

    /**
     * Revoke Bearer Token (Logout)
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(null, 'Token berhasil dicabut, Anda telah logout.');
    }
}
