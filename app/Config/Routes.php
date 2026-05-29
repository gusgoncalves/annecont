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
    $routes->get('clientes/abaFuncionarios/(:num)', 'Clientes::abaFuncionarios/$1');
    $routes->get('/', 'Clientes::index');
    $routes->get('abaClientes/(:num)', 'Clientes::abaClientes/$1');
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
    $routes->get('abaFuncionarios/(:num)', 'Funcionarios::abaFuncionarios/$1');
    $routes->get('/', 'FuncionariosClientes/$1');
    $routes->get('busca/(:num)', 'Funcionarios::buscaDados/$1');
    $routes->get('create/(:num)', 'Funcionarios::create/$1');
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
    $routes->get('abaSocios/(:num)', 'Socios::abaSocios/$1');
    $routes->get('create/(:num)', 'Socios::create/$1');
    $routes->get('create', 'Socios::create');
    $routes->post('store', 'Socios::store');
    $routes->get('edit/(:num)', 'Socios::edit/$1');
    $routes->post('update/(:num)', 'Socios::update/$1');
    $routes->post('delete', 'Socios::delete');
});
$routes->group('certificados', ['filter' => 'auth:verCertificado'], function($routes) {
    $routes->get('/', 'Certificados::index');
    $routes->get('abaCertificados/(:num)', 'Certificados::abaCertificados/$1');
    $routes->post('create', 'Certificados::create');
    $routes->get('getById/(:num)', 'Certificados::getById/$1');
    $routes->post('edit/(:num)', 'Certificados::update/$1');
    $routes->post('delete', 'Certificados::delete');
});
$routes->group('certidoes', ['filter' => 'auth:verCertidao'], function($routes) {
    $routes->get('/', 'Certidoes::index');
    $routes->get('abaCertidoes/(:num)', 'Certidoes::abaCertidoes/$1');
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
$routes->group('obrigacoes_cliente', ['filter' => 'auth:verObrigacao'], function($routes) {
    $routes->get('/', 'ObrigacoesCliente::index');
    $routes->get('busca', 'ObrigacoesCliente::buscaDados');
    $routes->get('abaObrigacoesCliente/(:num)', 'ObrigacoesCliente::abaObrigacoesCliente/$1');
    $routes->get('inserir/(:num)', 'ObrigacoesCliente::inserirObrigacaoCliente/$1');
    $routes->get('getById/(:num)', 'ObrigacoesCliente::getById/$1');
    $routes->post('edit/(:num)', 'ObrigacoesCliente::update/$1');
    $routes->get('remover/(:num)', 'ObrigacoesCliente::removerObrigacoesCliente/$1');
    $routes->post('delete/(:num)', 'ObrigacoesCliente::delete/$1');
    $routes->post('create', 'ObrigacoesCliente::create');
});
$routes->group('logins', ['filter' => 'auth:verLogin'], function($routes) {
    $routes->get('/', 'Logins::index');
    $routes->get('abaLogins/(:num)', 'Logins::abaLogins/$1');
    $routes->post('create', 'Logins::create');
    $routes->get('getById/(:num)', 'Logins::getById/$1');
    $routes->post('edit/(:num)', 'Logins::update/$1');
    $routes->post('delete', 'Logins::delete');
});
$routes->group('faturamento', ['filter' => 'auth:verFaturamento'], function($routes) {
    $routes->get('/', 'Faturamentos::index');
    $routes->get('abaFaturamento/(:num)', 'Faturamentos::abaFaturamento/$1');
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
$routes->group('movimento', ['filter' => 'auth:verPagar'], function($routes) {
    $routes->get('/', 'Movimento::index');
    $routes->get('busca', 'Movimento::buscaDados');
    $routes->post('create', 'Movimento::create');
    $routes->get('getById/(:num)', 'Movimento::getById/$1');
    $routes->post('edit/(:num)', 'Movimento::update/$1');
    $routes->post('delete', 'Movimento::delete');
});
$routes->group('receber', ['filter' => 'auth:verReceber'], function($routes) {
    $routes->get('/', 'Receber::index');
    $routes->get('busca', 'Receber::buscaDados');
    $routes->post('create', 'Receber::create');
    $routes->get('getById/(:num)', 'Receber::getById/$1');
    $routes->post('edit/(:num)', 'Receber::update/$1');
    $routes->post('quitar', 'Receber::quitarReceber');
    $routes->post('estornar', 'Receber::estornarReceber/$1');
    $routes->post('delete', 'Receber::delete');
    $routes->get('historico', 'Receber::historicoReceber');
    $routes->post('busca_historico', 'Receber::buscaDadosHistorico');
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
$routes->group('empresa', ['filter' => 'auth:modificarEmpresa'], function($routes) {
    $routes->get('/', 'Empresa::index');
    $routes->get('busca', 'Empresa::buscaDados');
    $routes->get('create', 'Empresa::create');
    $routes->post('store', 'Empresa::store');
    $routes->get('edit/(:num)', 'Empresa::edit/$1');
    $routes->post('update/(:num)', 'Empresa::update/$1');
    $routes->post('update', 'Empresa::update');
    $routes->post('delete', 'Empresa::delete');
    $routes->post('delete/(:num)', 'Empresa::delete/$1');
});
