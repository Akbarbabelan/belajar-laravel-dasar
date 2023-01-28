<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config('Contoh.author.first');
        $firstName2 = Config::get('contoh.authot.first');

        self::assertEquals($firstName1, $firstName2);

        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.authot.first');

        $firstName1 = config('Contoh.author.first');
        $firstName2 = Config::get('contoh.authot.first');

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);

        var_dump(Config::all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
        ->with('contoh.author.first')
        ->andReturn('Akbar keren');

        $firstName = Config::get('contoh.author,first');

        self::assertEquals('Akbar keren', $firstName);
    }
}
