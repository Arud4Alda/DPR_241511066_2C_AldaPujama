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
    $routes->get('dpr/hapus/(:segment)', 'Admin::hapusdpr/$1');

    //komponen gaji dpr
    $routes->get('gaji', 'Admin::gaji');
    $routes->get('gaji/tambah', 'Admin::tambahgaji');
    $routes->post('gaji/simpan', 'Admin::simpantambahgaji');
    $routes->get('gaji/edit/(:segment)', 'Admin::editgaji/$1');
    $routes->post('gaji/update/(:segment)', 'Admin::updateeditgaji/$1');
    $routes->get('gaji/hapus/(:segment)', 'Admin::hapusgaji/$1');
    
    //penggajian dpr
    $routes->get('penggajian', 'Admin::penggajian');
});

// Client routes
$routes->group('client', ['filter' => 'clientauth'], function($routes) {
    $routes->get('dashboard', 'Client::dashboard');

    //anggota dpr
    $routes->get('dpr', 'Client::dpr');

    //penggajian dpr
    $routes->get('penggajian', 'Client::penggajian');
});