<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::index');

$routes->get('hello', 'Hello::index');
$routes->get('about', 'Pages::about');
$routes->get('customers', 'Customers::index', ['filter' => 'auth']);
$routes->get('customers/new', 'Customers::create', ['filter' => 'auth']);
$routes->post('customers/new', 'Customers::create', ['filter' => 'auth']);

$routes->get('users', 'Users::index', ['filter' => 'auth']);
$routes->get('users/new', 'Users::create', ['filter' => 'auth']);
$routes->post('users/new', 'Users::create', ['filter' => 'auth']);

$routes->get('customers/edit/(:num)', 'Customers::edit/$1', ['filter' => 'auth']);
$routes->post('customers/edit/(:num)', 'Customers::edit/$1', ['filter' => 'auth']);

$routes->get('users/edit/(:num)', 'Users::edit/$1', ['filter' => 'auth']);
$routes->post('users/edit/(:num)', 'Users::edit/$1', ['filter' => 'auth']);
$routes->get('login', 'AuthController::login');
$routes->post('login/auth', 'AuthController::authenticate');
$routes->post('logout', 'AuthController::logout');