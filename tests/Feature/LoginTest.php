<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;

class LoginTest extends TestCase
{
    public function test_success_login()
    {
        $user = factory(User::class)->create();
        $this->post('api/v1/login', ['email' => $user->email, 'password' => 'secret'])
            ->seeJsonStructure(['token']);

    }

    public function test_fail_login_user()
    {
        $user = factory(User::class)->create();
        $this->post('api/v1/login', ['email' => $user->email, 'password' => '1'])
            ->assertResponseStatus(401);

    }

    public function test_bad_credentials()
    {
        $user = factory(User::class)->create();
        $this->post('api/v1/login', ['email' => $user->email, 'password' => 'something'])
            ->seeJson([
                'error' => 'Dados inválidos'
            ]);
    }

}
