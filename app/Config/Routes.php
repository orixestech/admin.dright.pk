<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('table', 'Home::table');
$routes->get('login', 'Home::login');

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
    $routes->get('dashboard', 'Users::dashboard');
    $routes->post('submit', 'Users::user_form_submit');
    $routes->post('delete', 'Users::delete');
    $routes->get('update/(:num)', 'Users::index');
});
$routes->group('pharmacy', static function ($routes) {
    $routes->get('dashboard', 'Pharmacy::dashboard');
});
$routes->group('medicine', static function ($routes) {
    $routes->get('/', 'Pharmacy::index');
    $routes->get('add', 'Pharmacy::index');
    $routes->post('submit', 'Pharmacy::user_form_submit');
    $routes->post('delete', 'Pharmacy::delete');
    $routes->get('update/(:num)', 'Pharmacy::index');
});
$routes->group('therapy', static function ($routes) {
    $routes->get('/', 'Pharmacy::index');
    $routes->get('add', 'Pharmacy::index');
    $routes->post('submit', 'Pharmacy::user_form_submit');
    $routes->post('delete', 'Pharmacy::delete');
    $routes->get('update/(:num)', 'Pharmacy::index');
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