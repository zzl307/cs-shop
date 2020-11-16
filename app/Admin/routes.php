<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    // 优惠券
    $router->resource('coupon_codes', 'CouponCodeController');
    // 商户优惠券
    $router->resource('coupon_businesses', 'CouponBusinessController');
    // 全局优惠券
    $router->resource('coupon_publishers', 'CouponPublisherController');
});
