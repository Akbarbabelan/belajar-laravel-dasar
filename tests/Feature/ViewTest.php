<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Akbar');

        $this->get('/hello-again')
            ->assertSeeText('Hello Akbar');
    }


    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Akbar');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Akbar'])
            ->assertSeeText('Hello Akbar');


        $this->view('hello', ['name' => 'Akbar'])
            ->assertSeeText('Hello Akbar');
    }
}
