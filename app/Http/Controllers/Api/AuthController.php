<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:' . User::class . ',email'],
            'password' => ['required', 'string', Password::defaults()],
        ]);

        if (!auth()->attempt($data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Credentials'
            ], 422);
        }

        $permissions = auth()->user()->hasAnyRole('admin', 'moderator') ? ['full'] : ['read'];
        $token = auth()->user()->createToken(
            $request->device_name ?? 'api',
            $permissions,
            now()->addMinutes(30)
        );

        return response()->json([
           'status' => 'success',
           'data' => [
               'token' => $token->plainTextToken
           ]
        ]);
    }
}
