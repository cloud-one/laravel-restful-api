<?php

namespace App\Http\Controllers\Auth;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\ActivateUserRequest;
use App\Http\Requests\User\ResendConfirmationCodeRequest;
use JWTAuth;

/**
 * @resource Autenticação - Cadastro
 *
 * Cadastro de novos usuários.
 */
class RegisterController extends Controller
{
    protected $users;

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
     * Cadastrar
     *
     * Recebe a requisição de cadastro e retorna o ID do usuário criado.
     * Um SMS será enviado com o código de ativação.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(StoreUserRequest $request)
    {
        try {
            $token = $this->users->register($request);

            return response()->json(compact('token'), 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
