<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
    $foo1 = $this->app->make(Foo::class); // new Foo()
    $foo2 = $this->app->make(Foo::class); // new Foo()

    self::assertEquals('Foo', $foo1->foo());
    self::assertEquals('Foo', $foo2->foo());
    self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app){
            return new Person("Akbar", "Babelan");
        });

        $person1 = $this->app->make(Person::class); // closure() //new Person("Akbar", "Babelan");
        $person2 = $this->app->make(Person::class); // closure() //new Person("Akbar", "Babelan");

        self::assertEquals('Akbar', $person1->firstName);
        self::assertEquals('Akbar', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app){
            return new Person("Akbar", "Babelan");
        });

        $person1 = $this->app->make(Person::class); // closure() //new Person("Akbar", "Babelan");
        $person2 = $this->app->make(Person::class); // closure() //new Person("Akbar", "Babelan");

        self::assertEquals('Akbar', $person1->firstName);
        self::assertEquals('Akbar', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Akbar", "Babelan");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // person
        $person2 = $this->app->make(Person::class); // person
        $person3 = $this->app->make(Person::class); // person
        $person4 = $this->app->make(Person::class); // person

        self::assertEquals('Akbar', $person1->firstName);
        self::assertEquals('Akbar', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {

        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);


        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }
}
