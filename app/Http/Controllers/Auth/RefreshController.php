<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

/**
 * @resource Autenticação - Refresh
 *
 * Retorna um novo token e invalida o antigo.
 */
class RefreshController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Obter novo token
     *
     * Retorna um novo token e invalida o antigo.
     *
     * O token é obtido através do header, sendo assim
     * não é necessário enviá-lo via post.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        try {
            $token = JWTAuth::getToken();

            $refreshToken = JWTAuth::refresh($token);

            return response()->json(compact('refreshToken'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível gerar um novo token'], 500);
        }

        return response()->json(['error' => 'Dados inválidos'], 401);
    }
}
