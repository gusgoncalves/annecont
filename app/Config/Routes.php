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
    $routes->get('busca', 'Clientes::buscaDados');
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
    $routes->get('busca', 'Funcionarios::buscaDados');
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
    $routes->get('busca', 'Socios::buscaDados');
    $routes->get('create', 'Socios::create');
    $routes->post('store', 'Socios::store');
    $routes->get('edit/(:num)', 'Socios::edit/$1');
    $routes->post('update/(:num)', 'Socios::update/$1');
    $routes->post('delete', 'Socios::delete');
});
$routes->group('certificados', ['filter' => 'auth:verCertificado'], function($routes) {
    $routes->get('/', 'Certificados::index');
    $routes->get('busca', 'Certificados::buscaDados');
    $routes->post('create', 'Certificados::create');
    $routes->get('getById/(:num)', 'Certificados::getById/$1');
    $routes->post('edit/(:num)', 'Certificados::update/$1');
    $routes->post('delete', 'Certificados::delete');
});
$routes->group('certidoes', ['filter' => 'auth:verCertidao'], function($routes) {
    $routes->get('/', 'Certidoes::index');
    $routes->get('busca', 'Certidoes::buscaDados');
    $routes->post('create', 'Certidoes::create');
    $routes->get('getById/(:num)', 'Certidoes::getById/$1');
    $routes->post('edit/(:num)', 'Certidoes::update/$1');
    $routes->post('delete', 'Certidoes::delete');
});
$routes->group('obrigacoes', ['filter' => 'auth:verObrigacao'], function($routes) {
    $routes->get('/', 'Obrigacoes::index');
    $routes->get('busca', 'Obrigacoes::buscaDados');
    $routes->post('create', 'Obrigacoes::create');
    $routes->get('getById/(:num)', 'Obrigacoes::getById/$1');
    $routes->post('edit/(:num)', 'Obrigacoes::update/$1');
    $routes->post('delete', 'Obrigacoes::delete');
});
$routes->group('logins', ['filter' => 'auth:verLogin'], function($routes) {
    $routes->get('/', 'Logins::index');
    $routes->get('busca', 'Logins::buscaDados');
    $routes->post('create', 'Logins::create');
    $routes->get('getById/(:num)', 'Logins::getById/$1');
    $routes->post('edit/(:num)', 'Logins::update/$1');
    $routes->post('delete', 'Logins::delete');
});
$routes->group('faturamento', ['filter' => 'auth:verFaturamento'], function($routes) {
    $routes->get('/', 'Faturamentos::index');
    $routes->get('busca', 'Faturamentos::buscaDados');
    $routes->post('create', 'Faturamentos::create');
    $routes->get('getById/(:num)', 'Faturamentos::getById/$1');
    $routes->post('edit/(:num)', 'Faturamentos::update/$1');
    $routes->post('delete', 'Faturamentos::delete');
});
$routes->group('pagar', ['filter' => 'auth:verPagar'], function($routes) {
    $routes->get('/', 'Pagar::index');
    $routes->get('busca', 'Pagar::buscaDados');
    $routes->post('create', 'Pagar::create');
    $routes->get('getById/(:num)', 'Pagar::getById/$1');
    $routes->post('edit/(:num)', 'Pagar::update/$1');
    $routes->post('quitar', 'Pagar::quitarPagar');
    $routes->post('estornar', 'Pagar::estornarPagar/$1');
    $routes->post('delete', 'Pagar::delete');
    $routes->get('historico', 'Pagar::historicoPagar');
    $routes->post('busca_historico', 'Pagar::buscaDadosHistorico');
});
$routes->group('receber', ['filter' => 'auth:verReceber'], function($routes) {
    $routes->get('/', 'Receber::index');
    $routes->get('busca', 'Receber::buscaDados');
    $routes->post('create', 'Receber::create');
    $routes->get('getById/(:num)', 'Receber::getById/$1');
    $routes->post('edit/(:num)', 'Receber::update/$1');
    $routes->post('delete', 'Receber::delete');
});
$routes->group('fluxo_caixa', ['filter' => 'auth:verPagar'], function($routes) {
    $routes->get('/', 'FluxoCaixa::index');
    $routes->get('busca', 'FluxoCaixa::buscaDados');
    $routes->post('create', 'FluxoCaixa::create');
    $routes->get('getById/(:num)', 'FluxoCaixa::getById/$1');
    $routes->post('edit/(:num)', 'FluxoCaixa::update/$1');
    $routes->post('delete', 'FluxoCaixa::delete');
});
$routes->group('tipo_certidao', ['filter' => 'auth:verCertidao'], function($routes) {
    $routes->get('/', 'TiposCertidao::index');
    $routes->get('busca', 'TiposCertidao::buscaDados');
    $routes->post('create', 'TiposCertidao::create');
    $routes->get('getById/(:num)', 'TiposCertidao::getById/$1');
    $routes->post('edit/(:num)', 'TiposCertidao::update/$1');
    $routes->post('delete', 'TiposCertidao::delete');
});
$routes->group('portes', ['filter' => 'auth:verPorte'], function($routes) {
    $routes->get('/', 'Portes::index');
    $routes->get('busca', 'Portes::buscaDados');
    $routes->post('create', 'Portes::create');
    $routes->get('getById/(:num)', 'Portes::getById/$1');
    $routes->post('edit/(:num)', 'Portes::update/$1');
    $routes->post('delete', 'Portes::delete');
});
$routes->group('uf', ['filter' => 'auth:verUF'], function($routes) {
    $routes->get('/', 'UF::index');
    $routes->get('busca', 'UF::buscaDados');
    $routes->post('create', 'UF::create');
    $routes->get('getById/(:num)', 'UF::getById/$1');
    $routes->post('edit/(:num)', 'UF::update/$1');
    $routes->post('delete', 'UF::delete');
});
$routes->group('cidades', ['filter' => 'auth:verCidade'], function($routes) {
    $routes->get('/', 'Cidades::index');
    $routes->get('busca', 'Cidades::buscaDados');
    $routes->post('create', 'Cidades::create');
    $routes->get('getById/(:num)', 'Cidades::getById/$1');
    $routes->post('edit/(:num)', 'Cidades::update/$1');
    $routes->post('delete', 'Cidades::delete');
});
$routes->group('tipo_conta', ['filter' => 'auth:verTipoConta'], function($routes) {
    $routes->get('/', 'TiposConta::index');
    $routes->get('busca', 'TiposConta::buscaDados');
    $routes->post('create', 'TiposConta::create');
    $routes->get('getById/(:num)', 'TiposConta::getById/$1');
    $routes->post('edit/(:num)', 'TiposConta::update/$1');
    $routes->post('delete', 'TiposConta::delete');
});
$routes->group('bancos', ['filter' => 'auth:modificarEmpresa'], function($routes) {
    $routes->get('/', 'Bancos::index');
    $routes->get('busca', 'Bancos::buscaDados');
    $routes->post('create', 'Bancos::create');
    $routes->get('getById/(:num)', 'Bancos::getById/$1');
    $routes->post('edit/(:num)', 'Bancos::update/$1');
    $routes->post('delete', 'Bancos::delete');
});
$routes->group('usuarios', ['filter' => 'auth:verUser'], function($routes) {
    $routes->get('/', 'Usuarios::index');
    $routes->get('busca', 'Usuarios::buscaDados');
    $routes->post('store', 'Usuarios::store');
    $routes->get('create', 'Usuarios::create');
    $routes->get('edit/(:num)', 'Usuarios::edit/$1');
    $routes->post('update/(:num)', 'Usuarios::update/$1');
    $routes->post('delete', 'Usuarios::delete');
});
$routes->group('grupos', ['filter' => 'auth:verGrupo'], function($routes) {
    $routes->get('/', 'Grupos::index');
    $routes->get('busca', 'Grupos::buscaDados');
    $routes->get('create', 'Grupos::create');
    $routes->post('store', 'Grupos::store');
    $routes->get('edit/(:num)', 'Grupos::edit/$1');
    $routes->post('update/(:num)', 'Grupos::update/$1');
    $routes->post('update', 'Grupos::update');
    $routes->post('delete', 'Grupos::delete');
    $routes->post('delete/(:num)', 'Grupos::delete/$1');
});
