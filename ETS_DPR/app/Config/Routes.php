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
    //anggota dpr
    $routes->get('dpr', 'Admin::dpr');
    $routes->get('dpr/tambah', 'Admin::tambahdpr');
    $routes->post('dpr/simpan', 'Admin::simpantambahdpr');
    $routes->get('dpr/edit/(:segment)', 'Admin::editdpr/$1');
    $routes->post('dpr/update/(:segment)', 'Admin::updateeditdpr/$1');

    //tunjangan gaji dpr
    $routes->get('gaji', 'Admin::gaji');
});

// Client routes
$routes->group('client', ['filter' => 'clientauth'], function($routes) {
    $routes->get('dashboard', 'Client::dashboard');

    //anggota dpr
    $routes->get('dpr', 'Client::dpr');
});