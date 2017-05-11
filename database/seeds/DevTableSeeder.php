<?php

use Illuminate\Database\Seeder;

class DevTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qtd = 15;
        // Create just one User and one Post
        // because the tests will run the migrations
        // and seeds for each test, and if we need 
        // reacreate all the test will run very slow
        if (App::environment('testing')) {
            $qtd = 1;
        }

        // Criando posts
        factory(App\Models\User::class, $qtd)->create()->each(function($user) use ($qtd) {
            foreach (range(1, $qtd) as $i ) {
                $user->posts()->save(factory(App\Models\Post::class)->make());
            }
        });

        $this->command->info('Usuários e Posts criados');
    }
}
