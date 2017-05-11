<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Controllers\Controller;

use JWTAuth;

/**
 * @resource Usuários
 */
class UserController extends Controller
{
    protected $users;

    public function __construct(UserService $users)
    {
        $this->users = $users;
    }

    /**
     * Listar Usuários
     *
     * Lista todos os usuários.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->users->getAll();
    }

    /**
     * Exibir Usuário
     *
     * Exibe os dados de um usuário.
     *
     * @param  uuid  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->users->getById($id);
    }

    /**
     * Identificar Request
     *
     * Retorna a informação do usuário que fez
     * a requisição baseado na informação do token.
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return $this->users->getById($user->id);
    }

    /**
     * Atualizar Usuário
     *
     * Atualiza um usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = $this->users->update($request, $id);

            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Apagar Usuário
     *
     * **Obs. O Usuário `NÃO é removido do banco de dados`,
     * apenas marcado como deletado.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->users->delete($id);

            return response()->json(true, 204);
        }
        catch (ModelNotFoundException $ex) {
            throw $ex;
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
