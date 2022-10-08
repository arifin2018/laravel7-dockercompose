<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserLogin;
use Facade\FlareClient\Http\Response;
use App\Http\Requests\User\UserRequest;
use Illuminate\Http\Response as HttpResponse;

class AuthController extends Controller
{
    public function login(UserLogin $request)
    {
        $auth = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        if (!$auth) {
            return response([
                'access_token'   => 'failed get access token'
            ], HttpResponse::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken('admin')->accessToken;
        return response([
            'access_token'  =>  $token
        ], HttpResponse::HTTP_ACCEPTED);
    }

    public function register(UserRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        return response($user, HttpResponse::HTTP_CREATED);
    }
}
