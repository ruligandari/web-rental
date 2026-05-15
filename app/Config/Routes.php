<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth Routes
$routes->get('login', 'Auth\Auth::login');
$routes->post('login', 'Auth\Auth::attemptLogin');
$routes->get('register', 'Auth\Auth::register');
$routes->post('register', 'Auth\Auth::attemptRegister');
$routes->get('logout', 'Auth\Auth::logout');

// Dashboard Dispatcher
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Owner Routes
$routes->group('owner', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Owner\Dashboard::index');
    $routes->get('laporan', 'Owner\Laporan::index');
    $routes->post('laporan/filter', 'Owner\Laporan::filter');
});
// Admin Travel Routes
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('travel', 'Admin\Travel::index');
    $routes->get('travel/create', 'Admin\Travel::create');
    $routes->post('travel/store', 'Admin\Travel::store');
    $routes->get('travel/edit/(:num)', 'Admin\Travel::edit/$1');
    $routes->post('travel/update/(:num)', 'Admin\Travel::update/$1');
    $routes->get('travel/delete/(:num)', 'Admin\Travel::delete/$1');

    // Admin Pelanggan Routes
    $routes->get('pelanggan', 'Admin\Pelanggan::index');
    $routes->get('pelanggan/create', 'Admin\Pelanggan::create');
    $routes->post('pelanggan/store', 'Admin\Pelanggan::store');
    $routes->get('pelanggan/edit/(:num)', 'Admin\Pelanggan::edit/$1');
    $routes->post('pelanggan/update/(:num)', 'Admin\Pelanggan::update/$1');
    $routes->get('pelanggan/delete/(:num)', 'Admin\Pelanggan::delete/$1');

    // Admin CRM Routes
    $routes->get('crm', 'Admin\Crm::index');
    $routes->get('crm/pelanggan/(:num)', 'Admin\Crm::history/$1');

    // Admin Reservasi Routes
    $routes->get('reservasi', 'Admin\Reservasi::index');
    $routes->get('reservasi/konfirmasi/(:num)', 'Admin\Reservasi::konfirmasi/$1');
    $routes->get('reservasi/selesai/(:num)', 'Admin\Reservasi::selesai/$1');
});

// Pelanggan Routes
$routes->group('pelanggan', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Pelanggan\Reservasi::index');
    $routes->get('travel', 'Pelanggan\Reservasi::travel');
    $routes->get('reservasi/(:num)', 'Pelanggan\Reservasi::create/$1');
    $routes->post('reservasi/store', 'Pelanggan\Reservasi::store');
    $routes->get('riwayat', 'Pelanggan\Reservasi::riwayat');
});

// Global Invoice Route
$routes->get('invoice/(:num)', 'Invoice::index/$1', ['filter' => 'auth']);

// Webhook Route
$routes->post('webhook/mayar', 'Webhook::mayar');
