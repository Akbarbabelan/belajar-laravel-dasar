<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Akbar')
            ->assertSeeText('Hello Akbar');

        $this->post('/input/hello', [
            'name' => 'Akbar'
        ])->assertSeeText('Hello Akbar');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Akbar",
                "last" => "Babelan"
            ]
        ])->assertSeeText("Hello Akbar");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Akbar",
                "last" => "Babelan"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
        ->assertSeeText("last")->assertSeeText("Akbar")
        ->assertSeeText("Babelan");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
                    ->assertSeeText("Samsung Galaxy S10");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => 'true',
            'birth_date' => '1998-10-10'
        ])->assertSeeText('Budi')->assertSeeText("true")->assertSeeText("1998-10-10");
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Akbar",
                "middle" => "Babelan",
                "last" => "Musthofa"
            ]
        ])->assertSeeText("Akbar")->assertSeeText("Musthofa")
            ->assertDontSeeText("Babelan");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
                "username" => "Musthofa",
                "password" => "rahasia",
                "admin" => "true"
        ])->assertSeeText("Musthofa")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
                "username" => "Musthofa",
                "password" => "rahasia",
                "admin" => "true"
        ])->assertSeeText("Musthofa")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }


}
