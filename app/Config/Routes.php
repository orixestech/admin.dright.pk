<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('table', 'Home::table');
$routes->group('support-ticket', static function ($routes) {
    $routes->get('/', 'SupportTickets::index');
    $routes->get('add', 'SupportTickets::index');
    $routes->get('dashboard', 'SupportTickets::index');
    $routes->get('pending', 'SupportTickets::index');
    $routes->post('submit', 'SupportTickets::ticket_form_submit');
    $routes->post('delete', 'SupportTickets::delete_ticket');
    $routes->get('update/(:num)', 'SupportTickets::index');


});