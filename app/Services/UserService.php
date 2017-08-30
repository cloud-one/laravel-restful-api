<?php

namespace App\Services;

use App\Models\User;
use App\Transformers\UserTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Fractal, JWTAuth;

class UserService
{
    /**
     * @var User
     */
    protected $users;

    public function __construct(User $user)
    {
        $this->users = $user;
    }

    /**
     * Obtém todos os usuários.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $paginator = $this->users->paginate(5);
        $companies = $paginator->getCollection();

        return Fractal::collection($companies)
                ->transformWith(new UserTransformer())
                ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                ->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  String $userId
     * @return \Illuminate\Http\Response
     */
    public function getById($userId)
    {
        $user = $this->users->findOrFail($userId);

        return Fractal::create($user)
                ->transformWith(new UserTransformer())
                ->toArray();
    }

    /**
     * Método para cadastro de usuários
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string id
     */
    public function register($request)
    {
        $user = $this->users->create($request->all());

        return JWTAuth::fromUser($user, $user->toArray());
    }

    /**
     * Atualiza um usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $userId
     * @return \Illuminate\Http\Response
     */
    public function update($request, $userId)
    {
        $user = $this->users->findOrFail($userId);

        $user->fill($request->all())->save();

        return Fractal::create($user)
                ->transformWith(new UserTransformer())
                ->toArray();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $userId
     * @return \Illuminate\Http\Response
     */
    public function delete($userId)
    {
        $user = $this->users->findOrFail($userId);

        return $user->delete();
    }
}
