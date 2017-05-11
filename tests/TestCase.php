<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Seeder\TestingDatabaseSeeder;
use App\Models\User;
use JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions, DatabaseMigrations;

    public $baseUrl = 'http://localhost';

    public function setUp()
    {
        parent::setUp();
        // Running the database seeders.
        $this->artisan("db:seed");
    }

    public function generateToken($user) {
        return JWTAuth::fromUser($user, $user->toArray());
    }
}
