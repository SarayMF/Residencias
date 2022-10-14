<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::attemptLogin');
$routes->get('/salir', 'Home::salir');
$routes->match(['get', 'post'],'/registro', 'Registrar::registro');
$routes->get('/completarRegistro/(:any)/(:any)', 'Registrar::completar/$1/$2');
$routes->post('/registrarContraseña', 'Registrar::guardarContraseña');
$routes->get('/Otorgar permisos', 'Permisos::index');
$routes->post('/Otorgar permisos/mostrar', 'Permisos::mostrar');
$routes->get('/Otorgar permisos/(:any)', 'Permisos::permisosUsuario/$1');
$routes->post('/Otorgar permisos/guardarPermisos', 'Permisos::guardar');
$routes->get('/Entrada de activos', 'Activos::entradaDeActivos');
$routes->post('/Entrada de activos/mostrar activos', 'Activos::read');
$routes->match(['get', 'post'],'/Entrada de activos/editar/(:any)', 'Activos::update/$1');
$routes->get('/Salida de activos', 'Activos::salidaDeActivos');
$routes->post('/Salida de activos/mostrar activos', 'Activos::read');
$routes->post('/Salida de activos/eliminar activo', 'Activos::delete');
$routes->get('/Entrada de activos/agregar activo', 'Activos::create');
$routes->get('/Entrada de activos/asignar/(:any)', 'Asignacion::asignacionActivo/$1');
$routes->post('/Entrada de activos/asignar/buscarUsuario', 'Asignacion::buscarUsuario');
$routes->post('/Entrada de activos/asignar/guardarAsignacion', 'Asignacion::createActivo');
$routes->get('/Registro de mis activos', 'Asignacion::index');
$routes->post('/Entrada de activos/mostrar accesorios', 'Accesorios::read');
$routes->post('/Salida de activos/mostrar accesorios', 'Accesorios::read');
$routes->post('/Salida de activos/eliminar accesorio', 'Accesorios::delete');
$routes->post('/mostrar asignacion activo', 'Asignacion::readActivo');
$routes->get('/Registro de mis activos/agregarActivo', 'Asignacion::asignacionUsuario');
$routes->post('/Registro de mis activos/buscarActivo', 'Activos::buscarActivo');
$routes->post('/Registro de mis activos/guardarAsignacion', 'Asignacion::createActivo');
$routes->post('/Entrada de activos/guardarActivo', 'Activos::create');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
