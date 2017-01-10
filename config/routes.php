<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', ['_namePrefix' => 'admin:'], function ($routes) {
    $routes->plugin(
        'DejwCake/StandardCMS',
        ['path' => '/'],
        function (RouteBuilder $routes) {
            $routes->scope('/settings', function (RouteBuilder $routes) {
                $routes->connect('/', ['controller' => 'Settings', 'action' => 'index', 'plugin' => 'DejwCake/StandardCMS']);
                $routes->connect('/add', ['controller' => 'Settings', 'action' => 'add', 'plugin' => 'DejwCake/StandardCMS']);
                $routes->connect('/view/:id', ['controller' => 'Settings', 'action' => 'view', 'plugin' => 'DejwCake/StandardCMS'], ['pass' => ['id'],]);
                $routes->connect('/edit/:id', ['controller' => 'Settings', 'action' => 'edit', 'plugin' => 'DejwCake/StandardCMS'], ['pass' => ['id'],]);
                $routes->connect('/delete/:id', ['controller' => 'Settings', 'action' => 'delete', 'plugin' => 'DejwCake/StandardCMS'], ['pass' => ['id'],]);
                $routes->connect('/enable/:id', ['controller' => 'Settings', 'action' => 'enable', 'plugin' => 'DejwCake/StandardCMS'], ['pass' => ['id'],]);
            });
        });
});
