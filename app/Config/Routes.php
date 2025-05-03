<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('index', 'Home::index');
$routes->get('api', 'User::index');
$routes->post('postapi', 'User::postApi');


