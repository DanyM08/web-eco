<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->post('api/registro', 'AuthController::registro');
$routes->post('api/login',    'AuthController::login');
