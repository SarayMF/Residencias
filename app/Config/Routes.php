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
$routes->get('/Permisos', 'Permisos::index');
$routes->post('/Permisos/mostrar', 'Permisos::mostrar');
$routes->get('/Permisos/(:any)', 'Permisos::permisosUsuario/$1');
$routes->post('/Permisos/guardarPermisos', 'Permisos::guardar');
$routes->get('/Altas', 'Activos::entradaDeActivos');
$routes->post('/Altas/mostrar activos', 'Activos::read');
$routes->match(['get', 'post'],'/Altas/editar/(:any)', 'Activos::update/$1');
$routes->get('/Asignar', 'Activos::salidaDeActivos');
$routes->post('/Asignar/mostrar activos', 'Activos::read');
$routes->get('/Altas/agregar activo', 'Activos::create');
$routes->get('/Asignar/asignar/(:any)', 'Asignacion::asignacionActivo/$1');
$routes->post('/Asignar/asignar/buscarUsuario', 'Asignacion::buscarUsuario');
$routes->post('/Asignar/asignar/guardarAsignacion', 'Asignacion::createActivo');
$routes->get('/Mis activos', 'Asignacion::index');
$routes->post('/Altas/mostrar accesorios', 'Accesorios::read');
$routes->post('/Asignar/mostrar accesorios', 'Accesorios::read');
$routes->post('/mostrar asignacion activo', 'Asignacion::readActivo');
$routes->get('/Mis activos/agregarActivo', 'Asignacion::asignacionUsuario');
$routes->post('/Mis activos/buscarActivo', 'Activos::buscarActivo');
$routes->post('/Mis activos/guardarAsignacion', 'Asignacion::createActivo');
$routes->post('/Altas/guardarActivo', 'Activos::create');
$routes->get('/Altas/agregar accesorio', 'Accesorios::create');
$routes->match(['get', 'post'],'/Altas/editar accesorio/(:any)', 'Accesorios::update/$1');
$routes->post('/Altas/guardarAccesorio', 'Accesorios::create');
$routes->get('/Reporte de activos', 'Reportes::reporteActivos');
$routes->post('/Reporte de activos/mostrar accesorios', 'Accesorios::read');
$routes->post('/Reporte de activos/mostrar activos', 'Activos::read');
$routes->post('/Reporte de activos/eliminar activo', 'Activos::delete');
$routes->post('/Reporte de activos/eliminar accesorio', 'Accesorios::delete');
$routes->get('/Reporte de activos/generar reporte', 'Reportes::generarReporteActivos');
$routes->get('/Reporte de bajas', 'Reportes::reporteBajas');
$routes->post('/mostrar bajas', 'Activos::readDeleted');
$routes->get('/Reporte de bajas/generar reporte', 'Reportes::generarReporteBajas');
$routes->get('/Mis activos/agregarActivo/registar activo', 'Activos::create');
$routes->post('/Mis activos/agregarActivo/guardarActivo', 'Activos::create');
$routes->get('/Asignar/asignar accesorio/(:any)', 'Asignacion::asignacionAccesorio/$1');
$routes->post('/Asignar/asignar accesorio/buscarUsuario', 'Asignacion::buscarUsuario');
$routes->post('/Asignar/asignar accesorio/guardarAsignacion', 'Asignacion::createAccesorio');
$routes->get('/Asignar/reasignar/(:any)', 'Asignacion::reasignar/$1');
$routes->post('/Asignar/reasignar/buscarUsuario', 'Asignacion::buscarUsuario');
$routes->post('/Asignar/reasignar/(:any)', 'Asignacion::reasignar/$1');
$routes->post('/Mis activos/mostrar accesorios', 'Asignacion::readAccesorio');
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
