<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Custom routes
$routes->get('cetak/(:any)', 'Cetak::show/$1');
$routes->get('blog/(:any)', 'Blog::detail/$1');
$routes->get('blog/page/(:any)', 'Blog::index/$1');
$routes->post('send_comment', 'Blog::submit_comment');
$routes->get('category/(:any)', 'Category::detail/$1');
$routes->get('category/(:any)/(:num)', 'Category::detail/$1/$2');
$routes->get('tag/(:any)', 'Tag::detail/$1');
$routes->get('tag/(:any)/(:num)', 'Tag::detail/$1/$2');
$routes->get('search', 'Result::search');
$routes->get('administrator', 'Backend\Login::index');
$routes->get('logout', 'Backend\Login::logout');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times when you need additional routing and you
 * need to override the default system routing. You can do that here.
 *
 * Require additional route files here to avoid class and route name collisions.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
