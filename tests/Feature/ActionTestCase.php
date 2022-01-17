<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

abstract class ActionTestCase extends TestCase
{
    /**
     * The route name
     *
     * @return string
     */
    abstract public function getRouteName(): string;

    public function assertRouteContainsMiddleware(...$names)
    {
        $route = $this->getRouteByName();

        foreach ($names as $name) {
            $this->assertContains(
                $name, $route->middleware(), "Route doesn't contain middleware [{$name}]"
            );
        }

        return $this;
    }

    public function assertRouteHasExactMiddleware(...$names)
    {
        $route = $this->getRouteByName();

        $this->assertRouteContainsMiddleware(...$names);
        $this->assertTrue(count($names) === count($route->middleware()), 'Route contains not the same amount of middleware.');

        return $this;
    }


    /**
     * @return Route
     */
    private function getRouteByName(): Route
    {
        $routes = \Illuminate\Support\Facades\Route::getRoutes();

        /** @var Route $route */
        $route = $routes->getByName($this->getRouteName());

        if (!$route) {
            $this->fail("Route with name [{$this->getRouteName()}] not found!");
        }

        return $route;
    }

    /**
     * Call an unauthorized request to the controller
     *
     * @param array $data Request body
     * @param array $parameters Route parameters
     * @param array $headers Request headers
     *
     * @return TestResponse
     */
    protected function callRouteAction(array $data = [], array $parameters = [], array $headers = []): TestResponse
    {
        $route = $this->getRouteByName();
        $method = $route->methods()[0];
        $url = route($this->getRouteName(), $parameters);

        return $this->json($method, $url, $data, $headers);
    }
}