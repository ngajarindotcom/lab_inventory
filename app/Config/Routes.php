<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/attemptLogin', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {
    // Dashboard
    $routes->get('/dashboard', 'DashboardController::index');

    // Users
    $routes->group('users', function($routes) {
        $routes->get('/', 'UserController::index');
        $routes->get('create', 'UserController::create');
        $routes->post('store', 'UserController::store');
        $routes->get('edit/(:num)', 'UserController::edit/$1');
        $routes->post('update/(:num)', 'UserController::update/$1');
        $routes->get('delete/(:num)', 'UserController::delete/$1');
    });

    // Categories
    $routes->group('categories', function($routes) {
        $routes->get('/', 'CategoryController::index');
        $routes->get('create', 'CategoryController::create');
        $routes->post('store', 'CategoryController::store');
        $routes->get('edit/(:num)', 'CategoryController::edit/$1');
        $routes->post('update/(:num)', 'CategoryController::update/$1');
        $routes->get('delete/(:num)', 'CategoryController::delete/$1');
    });

    // Item Types
    $routes->group('item-types', function($routes) {
        $routes->get('/', 'ItemTypeController::index');
        $routes->get('create', 'ItemTypeController::create');
        $routes->post('store', 'ItemTypeController::store');
        $routes->get('edit/(:num)', 'ItemTypeController::edit/$1');
        $routes->post('update/(:num)', 'ItemTypeController::update/$1');
        $routes->get('delete/(:num)', 'ItemTypeController::delete/$1');
    });

    // Power Types
    $routes->group('power-types', function($routes) {
        $routes->get('/', 'PowerTypeController::index');
        $routes->get('create', 'PowerTypeController::create');
        $routes->post('store', 'PowerTypeController::store');
        $routes->get('edit/(:num)', 'PowerTypeController::edit/$1');
        $routes->post('update/(:num)', 'PowerTypeController::update/$1');
        $routes->get('delete/(:num)', 'PowerTypeController::delete/$1');
    });

    // Item Kinds
    $routes->group('item-kinds', function($routes) {
        $routes->get('/', 'ItemKindController::index');
        $routes->get('create', 'ItemKindController::create');
        $routes->post('store', 'ItemKindController::store');
        $routes->get('edit/(:num)', 'ItemKindController::edit/$1');
        $routes->post('update/(:num)', 'ItemKindController::update/$1');
        $routes->get('delete/(:num)', 'ItemKindController::delete/$1');
    });

    // Units
    $routes->group('units', function($routes) {
        $routes->get('/', 'UnitController::index');
        $routes->get('create', 'UnitController::create');
        $routes->post('store', 'UnitController::store');
        $routes->get('edit/(:num)', 'UnitController::edit/$1');
        $routes->post('update/(:num)', 'UnitController::update/$1');
        $routes->get('delete/(:num)', 'UnitController::delete/$1');
    });

    // Items
    $routes->group('items', function($routes) {
        $routes->get('/', 'ItemController::index');
        $routes->get('create', 'ItemController::create');
        $routes->post('store', 'ItemController::store');
        $routes->get('edit/(:num)', 'ItemController::edit/$1');
        $routes->post('update/(:num)', 'ItemController::update/$1');
        $routes->get('delete/(:num)', 'ItemController::delete/$1');
        $routes->get('detail/(:num)', 'ItemController::detail/$1');
    });

    // Item In
    $routes->group('item-in', function($routes) {
        $routes->get('/', 'ItemInController::index');
        $routes->get('create', 'ItemInController::create');
        $routes->post('store', 'ItemInController::store');
        $routes->get('edit/(:num)', 'ItemInController::edit/$1');
        $routes->post('update/(:num)', 'ItemInController::update/$1');
        $routes->get('delete/(:num)', 'ItemInController::delete/$1');
        $routes->get('report', 'ItemInController::report');
        $routes->get('export-pdf', 'ItemInController::exportPdf');
        $routes->get('export-excel', 'ItemInController::exportExcel');
    });

    // Item Out
    $routes->group('item-out', function($routes) {
        $routes->get('/', 'ItemOutController::index');
        $routes->get('create', 'ItemOutController::create');
        $routes->post('store', 'ItemOutController::store');
        $routes->get('edit/(:num)', 'ItemOutController::edit/$1');
        $routes->post('update/(:num)', 'ItemOutController::update/$1');
        $routes->get('delete/(:num)', 'ItemOutController::delete/$1');
        $routes->get('report', 'ItemOutController::report');
        $routes->get('export-pdf', 'ItemOutController::exportPdf');
        $routes->get('export-excel', 'ItemOutController::exportExcel');
    });

    // Stock Opname
    $routes->group('stock-opname', function($routes) {
        $routes->get('/', 'StockOpnameController::index');
        $routes->get('create', 'StockOpnameController::create');
        $routes->post('store', 'StockOpnameController::store');
        $routes->get('edit/(:num)', 'StockOpnameController::edit/$1');
        $routes->post('update/(:num)', 'StockOpnameController::update/$1');
        $routes->get('delete/(:num)', 'StockOpnameController::delete/$1');
        $routes->get('report', 'StockOpnameController::report');
        $routes->get('export-pdf', 'StockOpnameController::exportPdf');
        $routes->get('export-excel', 'StockOpnameController::exportExcel');
    });
});