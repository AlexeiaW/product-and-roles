<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthToken extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            throw ValidationException::withMessages([
                'error' => ['Not authorized.'],
            ]);
        }

        $token = $user->createToken(Str::random(60))->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }
}
