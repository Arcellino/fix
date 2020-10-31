<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard', function () {
   return view('layouts.master');
});



Route::group(['middleware' => 'auth'], function () {
    Route::resource('categories','CategoryController');
    Route::get('/apiCategories','CategoryController@apiCategories')->name('api.categories');
    Route::get('/exportCategoriesAll','CategoryController@exportCategoriesAll')->name('exportPDF.categoriesAll');
    Route::get('/exportCategoriesAllExcel','CategoryController@exportExcel')->name('exportExcel.categoriesAll');
    Route::get('/exportCategory/{id}','CategoryController@exportCategory')->name('exportPDF.categories');

   
    Route::resource('customers','CustomerController');
    Route::get('/apiCustomers','CustomerController@apiCustomers')->name('api.customers');
    Route::post('/importCustomers','CustomerController@ImportExcel')->name('import.customers');
    Route::get('/exportCustomersAll','CustomerController@exportCustomersAll')->name('exportPDF.customersAll');
    Route::get('/exportCustomersAllExcel','CustomerController@exportExcel')->name('exportExcel.customersAll');

    Route::resource('suppliers','SupplierController');
    Route::get('/apiSuppliers','SupplierController@apiSuppliers')->name('api.suppliers');
    Route::post('/importSuppliers','SupplierController@ImportExcel')->name('import.suppliers');
    Route::get('/exportSupplierssAll','SupplierController@exportSuppliersAll')->name('exportPDF.suppliersAll');
    Route::get('/exportSuppliersAllExcel','SupplierController@exportExcel')->name('exportExcel.suppliersAll');

    Route::resource('materials','MaterialController');
    Route::get('/apiMaterials','MaterialController@apiMaterials')->name('api.materials');

    Route::resource('materialsOut','MaterialKeluarController');
    Route::get('/apiMaterialsOut','MaterialKeluarController@apiMaterialsOut')->name('api.materialsOut');
    Route::get('/exportMaterialKeluarAll','MaterialKeluarController@exportMAterialKeluarAll')->name('exportPDF.materialKeluarAll');
    Route::get('/exportMaterialKeluarAllExcel','MaterialKeluarController@exportExcel')->name('exportExcel.materialKeluarAll');
    Route::get('/exportMaterialKeluar/{id}','MaterialKeluarController@exportMaterialKeluar')->name('exportPDF.materialKeluar');

    Route::resource('materialsIn','MaterialMasukController');
    Route::get('/apiMaterialsIn','MaterialMasukController@apiMaterialsIn')->name('api.materialsIn');
    Route::get('/exportMaterialMasukAll','MaterialMasukController@exportMaterialMasukAll')->name('exportPDF.materialMasukAll');
    Route::get('/exportMaterialMasukAllExcel','MaterialMasukController@exportExcel')->name('exportExcel.materialMasukAll');
    Route::get('/exportMaterialMasuk/{id}','MaterialMasukController@exportMaterialMasuk')->name('exportPDF.materialMasuk');

    Route::resource('user', 'UserController');  
});

