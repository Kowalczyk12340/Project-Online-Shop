<?php

namespace Tests\Unit\Providers;

use Illuminate\Database\Connection;
use Mockery as m;
use Tests\SimpleTestCase;
use Illuminate\Container\Container;
use App\Providers\AppServiceProvider;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\DatabaseManager;

class AppServiceProviderTest extends SimpleTestCase
{
    public function test_it_for_category_all_instances()
    {
        $container = new Container();
        $provider = new AppServiceProvider($container);

        $container->bind('db', function () {
            $mock = m::mock(DatabaseManager::class);
            $mock->shouldReceive('connection')->andReturn(m::mock(Connection::class));
            return $mock;
        });

        $this->assertNotEquals(null, $provider, 'Podany provider nie jest nullem');
        $this->assertNotEquals(null, $container->make(Category::class), 'Podana wartość nie jest nullem');
    }

    public function test_it_for_product_all_instances()
    {
        $container = new Container();
        $provider = new AppServiceProvider($container);

        $container->bind('db', function () {
            $mock = m::mock(DatabaseManager::class);
            $mock->shouldReceive('connection')->andReturn(m::mock(Connection::class));
            return $mock;
        });

        $this->assertNotEquals(null, $provider, 'Podany provider nie jest nullem');
        $this->assertNotEquals(null, $container->make(Product::class), 'Podana wartość nie jest nullem');
    }
}