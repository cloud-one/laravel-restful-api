<?php

use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;

$fakerBR = Faker\Factory::create('pt_BR');

//--------------------------------------------------
// User Factory
//--------------------------------------------------
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'active'    => true,
        'roleId'    => 2,
        'name'      => $faker->name,
        'email'     => $faker->safeEmail,
        'password'  => 'secret',
        'cellphone' => $faker->phoneNumber
    ];
});

$factory->state(User::class, 'admin', function (Faker\Generator $faker) {
    return ['roleId' => 1];
});

//--------------------------------------------------
// Post Factory
//--------------------------------------------------
$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'published' => true,
        'user_id'   => factory(User::class)->create()->id,
        'title'     => $faker->sentence,
        'body'      => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});