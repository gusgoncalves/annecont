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
    $routes->post('delete', 'Funcionarios::delete');
    $routes->get('transporte/(:num)', 'Funcionarios::transporte/$1');
    $routes->get('alimentacao/(:num)', 'Funcionarios::alimentacao/$1');
});
$routes->group('socios', ['filter' => 'auth:verCliente'], function($routes) {
    $routes->get('/', 'Socios::index');
    $routes->get('busca', 'Socios::buscarDadosSocios');
    $routes->get('create', 'Socios::create');
    $routes->post('store', 'Socios::store');
    $routes->get('edit/(:num)', 'Socios::edit/$1');
    $routes->post('update/(:num)', 'Socios::update/$1');
    $routes->post('delete', 'Socios::delete');
});
$routes->group('certificados', ['filter' => 'auth:verCertificado'], function($routes) {
    $routes->get('/', 'Certificados::index');
    $routes->get('busca', 'Certificados::buscarDadosCertificados');
    $routes->post('create', 'Certificados::create');
    $routes->get('getById/(:num)', 'Certificados::getById/$1');
    $routes->post('edit/(:num)', 'Certificados::update/$1');
    $routes->post('delete', 'Certificados::delete');
});
$routes->group('certidoes', ['filter' => 'auth:verCertidao'], function($routes) {
    $routes->get('/', 'Certidoes::index');
    $routes->get('busca', 'Certidoes::buscarDadosCertidao');
    $routes->post('create', 'Certidoes::create');
    $routes->get('getById/(:num)', 'Certidoes::getById/$1');
    $routes->post('edit/(:num)', 'Certidoes::update/$1');
    $routes->post('delete', 'Certidoes::delete');
});
$routes->group('obrigacoes', ['filter' => 'auth:verObrigacao'], function($routes) {
    $routes->get('/', 'Obrigacoes::index');
    $routes->get('busca', 'Obrigacoes::buscaDadosObrigacao');
    $routes->post('create', 'Obrigacoes::create');
    $routes->get('getById/(:num)', 'Obrigacoes::getById/$1');
    $routes->post('edit/(:num)', 'Obrigacoes::update/$1');
    $routes->post('delete', 'Obrigacoes::delete');
});
$routes->group('logins', ['filter' => 'auth:verLogin'], function($routes) {
    $routes->get('/', 'Logins::index');
    $routes->get('busca', 'Logins::buscaDadosLogin');
    $routes->post('create', 'Logins::create');
    $routes->get('getById/(:num)', 'Logins::getById/$1');
    $routes->post('edit/(:num)', 'Logins::update/$1');
    $routes->post('delete', 'Logins::delete');
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
$routes->group('tipo_certidao', ['filter' => 'auth:verCertidao'], function($routes) {
    $routes->get('/', 'TiposCertidao::index');
    $routes->get('busca', 'TiposCertidao::buscarDadosTipoCertidao');
    $routes->post('create', 'TiposCertidao::create');
    $routes->get('getById/(:num)', 'TiposCertidao::getById/$1');
    $routes->post('edit/(:num)', 'TiposCertidao::update/$1');
    $routes->post('delete', 'TiposCertidao::delete');
});