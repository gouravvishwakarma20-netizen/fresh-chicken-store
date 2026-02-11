<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Customer Routes
$routes->get('/', 'Home::index');

// Cart AJAX Routes
$routes->post('cart/add', 'Cart::add');
$routes->post('cart/update', 'Cart::update');
$routes->post('cart/remove', 'Cart::remove');
$routes->post('cart/clear', 'Cart::clear');
$routes->get('cart/count', 'Cart::count');
$routes->get('cart/contents', 'Cart::contents');

// Checkout Routes
$routes->get('checkout', 'Checkout::index');
$routes->post('checkout/process', 'Checkout::process');
$routes->get('order-success/(:segment)', 'Checkout::success/$1');

// Admin Auth Routes (no filter)
$routes->get('admin/login', 'Admin\Auth::login');
$routes->post('admin/login', 'Admin\Auth::attemptLogin');
$routes->get('admin/logout', 'Admin\Auth::logout');

// Admin Protected Routes
$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Orders
    $routes->get('orders', 'Admin\Orders::index');
    $routes->get('orders/(:num)', 'Admin\Orders::view/$1');
    $routes->post('orders/update-status/(:num)', 'Admin\Orders::updateStatus/$1');
    $routes->post('orders/delete/(:num)', 'Admin\Orders::delete/$1');

    // Products
    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->post('products/store', 'Admin\Products::store');
    $routes->get('products/edit/(:num)', 'Admin\Products::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\Products::update/$1');
    $routes->post('products/delete/(:num)', 'Admin\Products::delete/$1');
    $routes->post('products/toggle-availability/(:num)', 'Admin\Products::toggleAvailability/$1');
});
