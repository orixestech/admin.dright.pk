<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('table', 'Home::table');
$routes->get('login', 'Home::login');
$routes->post('/fruit_search_filter', 'Home::fruit_search_filter');
$routes->post('/clear_session', 'Home::clear_session');
$routes->post('fruit-data', 'HealthCare::fetch_fruit');
$routes->post('vegetable-data', 'HealthCare::fetch_vegetable');
$routes->post('miscellaneous-data', 'HealthCare::fetch_miscellaneous');

$routes->group('support-ticket', static function ($routes) {
    $routes->get('/', 'SupportTickets::index');
    $routes->get('add', 'SupportTickets::index');
    $routes->get('dashboard', 'SupportTickets::dashboard');
    $routes->get('pending', 'SupportTickets::index');
    $routes->post('submit', 'SupportTickets::ticket_form_submit');
    $routes->post('delete', 'SupportTickets::delete_ticket');
    $routes->get('update/(:num)', 'SupportTickets::index');
});
$routes->group('builder', static function ($routes) {
    $routes->get('/', 'Builder::index');
    $routes->get('add', 'Builder::index');
    $routes->get('hospital', 'Builder::index');
    $routes->get('images', 'Builder::index');
    $routes->get('banners', 'Builder::index');
    $routes->get('dashboard', 'Builder::dashboard');
    $routes->post('submit', 'Builder::builder_form_submit');
    $routes->post('delete', 'Builder::delete');
    $routes->get('update/(:num)', 'Builder::index');
});
$routes->group('users', static function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('add', 'Users::index');
    $routes->get('access-level', 'Users::index');
    $routes->get('admin-activites', 'Users::index');
    $routes->post('users-data', 'Users::fetch_users');

    $routes->get('dashboard', 'Users::dashboard');
    $routes->post('submit', 'Users::user_form_submit');
    $routes->post('delete', 'Users::delete');
    $routes->get('update/(:num)', 'Users::index');
});
$routes->group('diet', static function ($routes) {
    $routes->get('/', 'HealthCare::index');
    $routes->get('add', 'HealthCare::index');
    $routes->get('dashboard', 'HealthCare::dashboard');
    $routes->get('fruit', 'HealthCare::index');
    $routes->get('detail/(:num)', 'HealthCare::index');
    $routes->get('pulses-grains', 'HealthCare::index');
    $routes->get('dry-fruits', 'HealthCare::index');
    $routes->get('miscellaneous', 'HealthCare::index');
    $routes->get('dry-fruits', 'HealthCare::index');
    $routes->post('dry-fruits-data', 'HealthCare::fetch_dry_fruit');

    $routes->get('vegetable', 'HealthCare::index');
    $routes->post('submit', 'HealthCare::user_form_submit');
    $routes->post('delete', 'HealthCare::delete');
    $routes->get('update/(:num)', 'HealthCare::index');
});
$routes->group('pharmacy', static function ($routes) {
    $routes->get('dashboard', 'Pharmacy::dashboard');
});
$routes->group('lookups', static function ($routes) {
    $routes->get('/', 'Lookup::index');
    $routes->post('lookup-data', 'Lookup::fetch_lookups');

});

$routes->group('franchises', static function ($routes) {
    $routes->get('/', 'HealthCare::index');

});
$routes->group('representative', static function ($routes) {
    $routes->get('/', 'HealthCare::index');

});
$routes->group('medicine', static function ($routes) {
    $routes->get('/', 'Pharmacy::index');
    $routes->get('add', 'Pharmacy::index');
    $routes->post('submit', 'Pharmacy::user_form_submit');
    $routes->post('delete', 'Pharmacy::delete');
    $routes->get('update/(:num)', 'Pharmacy::index');
    $routes->post('medicine-data', 'HealthCare::fetch_medicine');

});
$routes->group('therapy', static function ($routes) {
    $routes->get('/', 'Pharmacy::index');
    $routes->get('add', 'Pharmacy::index');
    $routes->post('submit', 'Pharmacy::user_form_submit');
    $routes->post('delete', 'Pharmacy::delete');
    $routes->get('update/(:num)', 'Pharmacy::index');
});
$routes->group('customers', static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('add', 'Customers::index');
    $routes->post('submit', 'Customers::customer_form_submit');
    $routes->post('delete', 'Customers::delete');
    $routes->get('update/(:num)', 'Customers::index');

});$routes->group('document', static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('add', 'Customers::index');
    $routes->post('submit', 'Customers::customer_form_submit');
    $routes->post('delete', 'Customers::delete');
    $routes->get('update/(:num)', 'Customers::index');

});

$routes->group('diseases', static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('add', 'Customers::index');
    $routes->post('submit', 'Customers::customer_form_submit');
    $routes->post('delete', 'Customers::delete');
    $routes->get('update/(:num)', 'Customers::index');

});
$routes->group('investigation', static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('add', 'Customers::index');
    $routes->post('submit', 'Customers::customer_form_submit');
    $routes->post('delete', 'Customers::delete');
    $routes->get('update/(:num)', 'Customers::index');

});
$routes->group('specialities', static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('add', 'Customers::index');
    $routes->post('submit', 'Customers::customer_form_submit');
    $routes->post('delete', 'Customers::delete');
    $routes->get('update/(:num)', 'Customers::index');

});


$routes->group('clinta_members', static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('add', 'Customers::index');
    $routes->post('submit', 'Customers::customer_form_submit');
    $routes->post('delete', 'Customers::delete');
    $routes->get('update/(:num)', 'Customers::index');
});$routes->group('investigation', static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('add', 'Customers::index');
    $routes->post('submit', 'Customers::customer_form_submit');
    $routes->post('delete', 'Customers::delete');
    $routes->get('update/(:num)', 'Customers::index');
});
$routes->group('task', static function ($routes) {
    $routes->get('/', 'Tasks::index');
    $routes->get('add', 'Tasks::index');
    $routes->get('assigned_task', 'Tasks::index');
    $routes->get('dashboard', 'Tasks::dashboard');
    $routes->post('submit', 'Tasks::user_form_submit');
    $routes->post('delete', 'Tasks::delete');
    $routes->get('update/(:num)', 'Tasks::index');
});