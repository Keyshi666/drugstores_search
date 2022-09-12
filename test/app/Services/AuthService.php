<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(array $request)
    {
        $user = $this->user->create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $user['token'] = $user->createToken($user['email'])->accessToken;
        return $user;
    }

    public function login(array $request)
    {
        $credentials = ['email' => $request['email'], 'password' => $request['password']];
        if(auth()->attempt($credentials)){
            $user = auth()->user();
            $user['token'] = $user->createToken($user['email'])->accessToken;
            return $user;
        }
        return false;
    }
}