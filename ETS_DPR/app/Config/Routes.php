<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');

// Admin routes
$routes->group('admin', ['filter' => 'adminauth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
});

// Client routes
$routes->group('client', ['filter' => 'clientauth'], function($routes) {
    $routes->get('dashboard', 'Client::dashboard');
});