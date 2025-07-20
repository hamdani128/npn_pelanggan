<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'MitraCorporateController::index');
$routes->get('/landing/corporate/supported_document', 'MitraCorporateController::supported_document');
$routes->get('auth/login', 'Admin\LoginController::index');
$routes->post('auth/login/check_login', 'Admin\LoginController::check_login');
$routes->get('auth/logout', 'Admin\LoginController::logout');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->get('admin', 'Home::index');

    $routes->get('users_management', 'UsersManagement::index');
    $routes->get('users_management/getdata', 'UsersManagement::getdata');
    $routes->post('users_management/insert', 'UsersManagement::insert');
    // Master
    $routes->get('master/supported_document', 'Admin\Master\DocumentController::index');
    $routes->get('master/supported_document/getdata', 'Admin\Master\DocumentController::getdata');
    $routes->post('master/supported_document/insert', 'Admin\Master\DocumentController::insert');
    $routes->post('master/supported_document/update', 'Admin\Master\DocumentController::update');
    $routes->post('master/supported_document/delete', 'Admin\Master\DocumentController::delete');
    // Profile Mitra
    $routes->get('profile_pelanggan/kemitraan_reseller', 'Admin\Kemitraan\MitraController::index');
    $routes->get('profile_pelanggan/kemitraan_reseller/getdata', 'Admin\Kemitraan\MitraController::getdata');
    $routes->get('profile_pelanggan/kemitraan_reseller/getmitra_id', 'Admin\Kemitraan\MitraController::getmitra_id');
    $routes->get('profile_pelanggan/kemitraan_reseller/getrefcode', 'Admin\Kemitraan\MitraController::getrefcode');
    $routes->post('profile_pelanggan/kemitraan_reseller/insert', 'Admin\Kemitraan\MitraController::insert');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_detail', 'Admin\Kemitraan\MitraController::getmitra_detail');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_detail_document', 'Admin\Kemitraan\MitraController::getmitra_detail_document');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_data_layanan', 'Admin\Kemitraan\MitraController::getmitra_data_layanan');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_data_layanan_refrence_table', 'Admin\Kemitraan\MitraController::getmitra_data_layanan_refrence_table');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_data_layanan_otc', 'Admin\Kemitraan\MitraController::getmitra_data_layanan_otc');

});
