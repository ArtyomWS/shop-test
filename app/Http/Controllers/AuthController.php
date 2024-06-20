<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request): UserResource
    {
        return UserResource::make($request->user())->additional([
            'token' => $request->user()->createToken(Str::random())->plainTextToken,
        ]);
    }
}
