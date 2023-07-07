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
    // test user
    // $routes->get('usuario/crear','\App\Controllers\Web\Usuario::create_user');   
    // $routes->get('usuario/probar/contrasena','\App\Controllers\Web\Usuario::probar_contrasena');       
    $routes->presenter('pelicula',['controller' =>'Dashboard\Pelicula']);   
    $routes->presenter('categoria',['except'=>['show'],'controller' =>'Dashboard\Categoria']);  
    //$routes->get('categoria','Dashboard\Categoria::index');  
});
$routes->get('login','\App\Controllers\Web\Usuario::login',['as'=>'usuario.login']);
$routes->post('login_post','\App\Controllers\Web\Usuario::login_post',['as'=>'usuario.login_post']);

$routes->get('register','\App\Controllers\Web\Usuario::register',['as'=>'usuario.register']);
$routes->post('register_post','\App\Controllers\Web\Usuario::register_post',['as'=>'usuario.register_post']);

$routes->get('logout','\App\Controllers\Web\Usuario::logout',['as'=>'usuario.logout']);


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
