<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\UserService;
use JWTAuth, Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Modelos\User;

/**
 * @resource Autenticação - Login
 *
 * Autentica um usuário através do CPF e senha. Retorna um JWT.
 */
class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->users = $service;
    }

    /**
     * Autenticar usuário
     *
     * Autentica o usuário e retorna um token JWT.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(LoginRequest $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $token = JWTAuth::fromUser(
                    Auth::user(),
                    Auth::user()->toArray()
                );

                return response()->json(compact('token'));
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Server error'], 500);
        }

        return response()->json(['error' => 'Dados inválidos'], 401);
    }
}
