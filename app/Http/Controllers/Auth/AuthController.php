<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login(LoginRequest $request): JsonResponse
  {
    $user = User::where('username', $request->username)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
      return response()->json([
        'message' => 'Username atau password salah.',
      ], 401);
    }

    $token = $user->createToken('dashboard')->plainTextToken;

    return response()->json([
      'message' => 'Login berhasil.',
      'token' => $token,
      'user' => $user,
    ]);
  }

  public function logout(): JsonResponse
  {
    request()->user()->currentAccessToken()->delete();

    return response()->json([
      'message' => 'Logout berhasil.',
    ]);
  }
}
