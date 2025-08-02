<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'MitraCorporateController::index');
$routes->get('landing/corporate/supported_document', 'MitraCorporateController::supported_document');
$routes->get('auth/login', 'Admin\LoginController::index');
$routes->get('register', 'MitraCorporateController::register');
$routes->post('register/insert', 'MitraCorporateController::register_insert');
$routes->post('auth/login/check_login', 'Admin\LoginController::check_login');
$routes->get('auth/logout', 'Admin\LoginController::logout');
$routes->get('auth/forgot_password', 'Admin\LoginController::forgot_password');
$routes->post('/auth/forgot_password/send_email_password', 'Admin\LoginController::send_email');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->get('admin', 'Home::index');
    $routes->get('mitra', 'Home::mitra');
    $routes->get('users_management', 'UsersManagement::index');
    $routes->get('users_management/getdata', 'UsersManagement::getdata');
    $routes->post('users_management/insert', 'UsersManagement::insert');
    $routes->post('users_management/activate', 'UsersManagement::activate');
    $routes->post('users_management/deactivate', 'UsersManagement::deactivate');
    $routes->post('users_management/update', 'UsersManagement::update');
    $routes->post('users_management/delete', 'UsersManagement::delete');

    // Master
    $routes->get('master/supported_document', 'Admin\Master\DocumentController::index');
    $routes->get('master/supported_document/getdata', 'Admin\Master\DocumentController::getdata');
    $routes->post('master/supported_document/insert', 'Admin\Master\DocumentController::insert');
    $routes->post('master/supported_document/update', 'Admin\Master\DocumentController::update');
    $routes->post('master/supported_document/delete', 'Admin\Master\DocumentController::delete');

    $routes->get('master/employee_master', 'Admin\Master\EmployeeController::index');
    $routes->get('master/employee_master/getdata', 'Admin\Master\EmployeeController::employee_getdata');
    $routes->post('master/employee_master/insert', 'Admin\Master\EmployeeController::employee_insert');

    // $routes->get('master/ref_codes', '');
    // Profile Mitra
    $routes->get('profile_pelanggan/register', 'MitraCorporateController::register_view_admin');
    $routes->get('profile_pelanggan/register_getdata', 'MitraCorporateController::register_admin_getdata');
    $routes->post('profile_pelanggan/register_approval', 'MitraCorporateController::register_approval');
    $routes->get('profile_pelanggan/kemitraan_reseller', 'Admin\Kemitraan\MitraController::index');
    $routes->get('profile_pelanggan/kemitraan_deleted_history', 'Admin\Kemitraan\MitraController::kemitraan_deleted_history');
    $routes->get('profile_pelanggan/kemitraan_deleted_history_getdata', 'Admin\Kemitraan\MitraController::get_deleted_history');

    $routes->get('profile_pelanggan/kemitraan_reseller/getdata', 'Admin\Kemitraan\MitraController::getdata');
    $routes->get('profile_pelanggan/kemitraan_reseller/getmitra_id', 'Admin\Kemitraan\MitraController::getmitra_id');
    $routes->get('profile_pelanggan/kemitraan_reseller/getrefcode', 'Admin\Kemitraan\MitraController::getrefcode');
    $routes->post('profile_pelanggan/kemitraan_reseller/insert', 'Admin\Kemitraan\MitraController::insert');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_detail', 'Admin\Kemitraan\MitraController::getmitra_detail');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_detail_document', 'Admin\Kemitraan\MitraController::getmitra_detail_document');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_data_layanan', 'Admin\Kemitraan\MitraController::getmitra_data_layanan');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_data_layanan_refrence_table', 'Admin\Kemitraan\MitraController::getmitra_data_layanan_refrence_table');
    $routes->post('profile_pelanggan/kemitraan_reseller/getmitra_data_layanan_otc', 'Admin\Kemitraan\MitraController::getmitra_data_layanan_otc');
    $routes->post('profile_pelanggan/kemitraan_reseller/update', 'Admin\Kemitraan\MitraController::update');
    $routes->post('profile_pelanggan/kemitraan_reseller/delete', 'Admin\Kemitraan\MitraController::delete');
    $routes->get('profile_pelanggan/kemitraan_reseller/(:num)', 'Admin\Kemitraan\MitraController::print_document/$1');
    $routes->get('profile_pelanggan/kemitraan_reseller/detail/(:num)', 'Admin\Kemitraan\MitraController::pelanggan_detail/$1');
    $routes->post('profile_pelanggan/kemitraan_reseller/activate_account', 'Admin\Kemitraan\MitraController::activate_account');
    $routes->post('profile_pelanggan/kemitraan_reseller/nonactive_account', 'Admin\Kemitraan\MitraController::nonactive_account');
});
