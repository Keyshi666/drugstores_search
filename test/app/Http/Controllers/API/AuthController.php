<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(UserCreateRequest $request)
    {
        $user = $this->service->register($request->all());

        return response()->json([
            'message' => 'Success',
            'user'    => $user
        ], Response::HTTP_CREATED);
    }

    public function login(UserLoginRequest $request)
    {
        $user = $this->service->login($request->all());

        if($user) {
            return response()->json([
                'message' => 'Success',
                'user'    => $user
            ], Response::HTTP_OK);
        }
        else{
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}

