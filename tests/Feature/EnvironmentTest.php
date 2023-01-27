<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $youtobe = env('YOUTOBE');

        self::assertEquals('Programmer Zaman now', $youtobe);
    }

    public function testDefaultEnv()
    {
        $author = Env::get('AUTHOR', 'Akbar');

        self::assertEquals('Akbar', $author);
    }

}
