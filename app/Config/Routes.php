<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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

//$routes->get('pelicula','Panel\Pelicula::index');

$routes->group('panel',['namespace'=>'App\Controllers\Panel'],function($routes){
    $routes->get('pelicula','Pelicula::index');
});
//$routes->setAutoRoute(false);
//$routes->get('/','Home::index');

/*$routes->get('test/','Pelicula::test');
$routes->get('test/(:any)','Pelicula::test/$1');
$routes->get('test/(:any)/(:num)','Pelicula::test/$1/$2');

$routes->get('pelicula','Pelicula::index');

$routes->get('pelicula/new','Pelicula::new');
$routes->post('pelicula','Pelicula::create');

$routes->get('pelicula/(:num)/edit','Pelicula::edit/$1');
$routes->post('pelicula/(:num)','Pelicula::update/$1');

$routes->delete('pelicula/(:num)','Pelicula::delete');
*/
//$routes->resource('pelicula');
//$routes->presenter('pelicula');

//$routes->get('/','Home::index');

$routes->group('dashboard', function($routes){
    $routes->presenter('pelicula',['controller' =>'Dashboard\Pelicula']);   
    $routes->presenter('categoria',['except'=>['show'],'controller' =>'Dashboard\Categoria']);    
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
