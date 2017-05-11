<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use App\Models\Post;

class PostTest extends TestCase
{
    public function test_token_not_provided()
    {
        $this->json('GET', 'api/v1/posts')
            ->seeJson(['error' => 'token_not_provided']);

        $this->json('POST', 'api/v1/posts')
            ->seeJson(['error' => 'token_not_provided']);
            
        $this->json('PUT', 'api/v1/posts/123')
            ->seeJson(['error' => 'token_not_provided']);

        $this->json('DELETE', 'api/v1/posts/123')
            ->seeJson(['error' => 'token_not_provided']);
    }

    public function test_fetch_all_posts()
    {
        $user = factory(User::class)->create();

        $token = $this->generateToken($user);

        $rep = $this->json('GET', "api/v1/posts?token={$token}")
            ->seeJsonStructure(['data']);
        // dd($rep);
    }

    public function test_fetch_one_post()
    {
        $user = factory(User::class)->create();

        $token = $this->generateToken($user);

        $rep = $this->json('GET', "api/v1/posts/1?token={$token}")
            ->seeJsonStructure(['data']);
    }

    public function test_create_post()
    {
        $user = factory(User::class)->create();

        $token = $this->generateToken($user);

        $this->json('POST', 'api/v1/posts', [
            'published' => true,
            'title'     => 'Lorem ipsum',
            'body'      => 'Lorem ipsum dot dolar met',
            'category'  => 'lorem',
        ], [
            'HTTP_Authorization' => "Bearer {$token}"
        ])->seeJson(['title' => 'Lorem ipsum']);

        $this->seeInDatabase('posts', ['title' => 'Lorem ipsum']);
    }

    public function test_update_post()
    {
        $user = factory(User::class)->create();

        $post = factory(Post::class)->create();

        $token = $this->generateToken($user);

        $this->json('PUT', 'api/v1/posts/' . $post->id, [
            'published' => true,
            'title'     => 'Lorem ipsum',
            'body'      => 'Lorem ipsum dot dolar met',
            'category'  => 'lorem',
        ], [
            'HTTP_Authorization' => "Bearer {$token}"
        ])->seeJson(['title' => 'Lorem ipsum']);

        $this->seeInDatabase('posts', ['title' => 'Lorem ipsum']);
    }

    public function test_delete_post()
    {
        $user = factory(User::class)->create();

        $token = $this->generateToken($user);

        $post = factory(Post::class)->create();

        $this->json('DELETE',
            'api/v1/posts/' . $post->id,
            [],
            ['HTTP_Authorization' => "Bearer {$token}"]
        )->assertResponseStatus(204);
    }
}
