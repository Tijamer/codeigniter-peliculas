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
// $routes->setDefaultController('Home');
// $routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

//$routes->get('/','Home::index');

$routes->group('dashboard', function($routes){
    $routes->presenter('pelicula',['controller' =>'Dashboard\Pelicula']);
    //$routes->presenter('categoria',['only'=>['index','new','create']]);    
    //$routes->presenter('categoria',['except'=>'show']);    
    $routes->presenter('categoria',['except'=>['show'],'controller' =>'Dashboard\Categoria']);    
});
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
