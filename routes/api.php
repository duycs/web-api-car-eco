<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::put('users/{id}','UserController@updateInfo');
    Route::get('users/{id}', 'UserController@getById');
    Route::get('users', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('object-types', 'ObjectTypeController@create');
    Route::put('object-types/{id}', 'ObjectTypeController@update');
    Route::get('object-types/{id}', 'ObjectTypeController@getById');
    Route::get('object-types', 'ObjectTypeController@getList');
    Route::get('object-types/{object_type_id}/sales', 'ObjectTypeController@getListSalesByObjectTypeId');
    Route::get('object-types/{object_type_id}/object-locations', 'ObjectTypeController@getListObjectLocationsByObjectTypeId');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('cities', 'CityController@create');
    Route::put('cities/{id}', 'CityController@update');
    Route::get('cities/{id}', 'CityController@getById');
    Route::get('cities', 'CityController@getList');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('locations', 'LocationController@create');
    Route::put('locations/{id}', 'LocationController@update');
    Route::get('locations/{id}', 'LocationController@getById');
    Route::get('locations', 'LocationController@getList');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('brands', 'BrandController@create');
    Route::put('brands/{id}', 'BrandController@update');
    Route::get('brands/{id}', 'BrandController@getById');
    Route::get('brands', 'BrandController@getList');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('carmodels', 'CarModelController@create');
    Route::put('carmodels/{id}', 'CarModelController@update');
    Route::get('carmodels/{id}', 'CarModelController@getById');
    Route::get('carmodels', 'CarModelController@getList');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('colors', 'ColorController@create');
    Route::put('colors/{id}', 'ColorController@update');
    Route::get('colors/{id}', 'ColorController@getById');
    Route::get('colors', 'ColorController@getList');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('cars', 'CarController@create');
    Route::put('cars/{id}', 'CarController@update');
    Route::get('cars/{id}', 'CarController@getById');
    Route::get('cars', 'CarController@getList');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('sales', 'SaleController@create');
    Route::put('sales/{id}', 'SaleController@update');
    Route::get('sales/{id}', 'SaleController@getById');
    Route::get('sales', 'SaleController@getList');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('object-locations', 'ObjectLocationController@create');
    Route::put('object-locations/{id}', 'ObjectLocationController@update');
    Route::get('object-locations/{id}', 'ObjectLocationController@getById');
    Route::get('object-locations', 'ObjectLocationController@getList');
});
