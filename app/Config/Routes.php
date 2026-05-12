<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('logout', 'Auth::logout');

$routes->group('clientes', ['filter' => 'auth:verCliente'], function($routes) {
    $routes->get('/', 'Clientes::index');
    $routes->get('busca', 'Clientes::buscaDadosCliente');
    $routes->get('create', 'Clientes::create');
    $routes->post('store', 'Clientes::store');
    $routes->get('edit/(:num)', 'Clientes::edit/$1');
    $routes->post('update/(:num)', 'Clientes::update/$1');
    $routes->post('delete/(:num)', 'Clientes::delete/$1');
    $routes->post('delete', 'Clientes::delete');
    $routes->get('ver/(:num)', 'Clientes::ver/$1');
    $routes->post('getCidades', 'Clientes::getCidades');
});
$routes->group('funcionarios', ['filter' => 'auth:verFuncionario'], function($routes) {
    $routes->get('/', 'Funcionarios::index');
    $routes->get('busca', 'Funcionarios::buscarDadosFuncionario');
    $routes->get('create', 'Funcionarios::create');
    $routes->post('store', 'Funcionarios::store');
    $routes->get('edit/(:num)', 'Funcionarios::edit/$1');
    $routes->post('update/(:num)', 'Funcionarios::update/$1');
    $routes->post('delete/(:num)', 'Funcionarios::delete/$1');
});
$routes->group('usuarios', ['filter' => 'auth:verUser'], function($routes) {
    $routes->get('/', 'Usuarios::index');
    $routes->get('busca', 'Usuarios::buscarDadosFuncionario');
    $routes->post('store', 'Usuarios::store');
    $routes->get('create', 'Usuarios::create');
    $routes->get('edit/(:num)', 'Usuarios::edit/$1');
    $routes->post('update/(:num)', 'Usuarios::update/$1');
    $routes->post('delete', 'Usuarios::delete');
});
$routes->group('grupos', ['filter' => 'auth:verGrupo'], function($routes) {
    $routes->get('/', 'Grupos::index');
    $routes->get('busca', 'Grupos::buscarDadosFuncionario');
    $routes->get('create', 'Grupos::create');
    $routes->post('store', 'Grupos::store');
    $routes->get('edit/(:num)', 'Grupos::edit/$1');
    $routes->post('update/(:num)', 'Grupos::update/$1');
    $routes->post('update', 'Grupos::update');
    $routes->post('delete', 'Grupos::delete');
    $routes->post('delete/(:num)', 'Grupos::delete/$1');
});