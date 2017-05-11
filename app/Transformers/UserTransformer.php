<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;
use App;

class UserTransformer extends TransformerAbstract {

    protected $defaultIncludes = ['posts'];

    /**
     * Serializa dos dados de Usuário
     *
     * @param  App\Models\User  $user
     * @return League\Fractal\Resource\Collection
     */
    public function transform(User $user)
    {
        return [
            'id'                      => $user->id,
            'active'                  => (boolean) $user->active,
            'roleId'                  => $user->role,
            'name'                    => $user->name,
            'email'                   => $user->email,
            'cellphone'               => $user->cellphone,
        ];
    }

    /**
     * Serialze Posts
     *
     * @param  User $user
     * @return League\Fractal\Resource\Collection
     */
    public function includePosts(User $user)
    {
        if (!$user->posts) {
            return null;
        }
        return $this->collection($user->posts, new PostTransformer());
    }
}
