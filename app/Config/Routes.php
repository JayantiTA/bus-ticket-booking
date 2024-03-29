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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('contact', 'Home::contactPage');
$routes->post('contact', 'Home::contactLink');

$routes->get('/register', 'UserController::registerPage');
$routes->post('/register', 'UserController::registerUser');
$routes->get('/login', 'UserController::loginPage');
$routes->post('/login', 'UserController::loginUser');
$routes->get('/logout', 'UserController::logoutUser');

$routes->get('discover', 'BusController::searchPage');
$routes->get('buses', 'BusController::searchBuses');
$routes->get('seats', 'SeatController::getSeatsPage');
$routes->get('book', 'BookingController::getBookingPage');
$routes->post('pay', 'BookingController::createBooking');
$routes->get('bookings', 'BookingController::getBookingsPage');

$routes->get('admin/user', 'UserController::getUsers');
$routes->post('admin/user/create', 'UserController::createUser');
$routes->post('admin/user/update/(:num)', 'UserController::updateUser/$1');
$routes->post('admin/user/delete/(:num)', 'UserController::deleteUser/$1');

$routes->get('admin/bus', 'BusController::getBuses');
$routes->post('admin/bus/create', 'BusController::createBus');
$routes->post('admin/bus/update/(:num)', 'BusController::updateBus/$1');
$routes->post('admin/bus/delete/(:num)', 'BusController::deleteBus/$1');

$routes->get('admin/seat', 'SeatController::getSeats');
$routes->post('admin/seat/create', 'SeatController::createSeat');
$routes->post('admin/seat/update/(:num)', 'SeatController::updateSeat/$1');
$routes->post('admin/seat/delete/(:num)', 'SeatController::deleteSeat/$1');

$routes->get('admin/book', 'BookingController::getBookings');
$routes->post('admin/book/create', 'BookingController::createBooking');
$routes->post('admin/book/update/(:num)', 'BookingController::updateBooking/$1');
$routes->post('admin/book/delete/(:num)', 'BookingController::deleteBooking/$1');
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
