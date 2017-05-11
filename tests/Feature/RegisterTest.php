<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;

class RegisterTest extends TestCase
{

    /**
     * Testa o cadastro de usuários
     */
    public function test_register_user()
    {
        $this->post('api/v1/register', [
            'name'       => 'Juliano Petronetto',
            'email'      => 'juliano.petronetto@gmail.com',
            'password'   => 'secret',
            'cellphone'  => '(27) 9 9999-9999',
        ])->seeJsonStructure(['token']);

        $this->seeInDatabase('users', ['email' => 'juliano.petronetto@gmail.com']);
    }

    /**
     * Testa as validações
     */
    public function test_register_user_with_invalid_data()
    {
        $this->post('api/v1/register')->assertResponseStatus(422);
    }
}
