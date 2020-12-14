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

Route::get('/', 'HomePageController@index');
Route::get('/listing', 'ListingPageController@index');
Route::get('/details', 'DetailsPageController@index');


Route::get('/hello', function () {
    return 'Hello world';
});

Route::get('/football', function () {
    return 'Hello I Love Coding';
});


Route::get('/user/{id}', function ($id) {
    return 'Your id '.' '.$id;
})->where('id','[0-9]+');


Route::get('/world','HelloController@hello');
Route::get('/add','AddController@index');
Route::get('/about',['uses'=>'AboutController@about', 'as'=>'about']);
Route::view('/home','home');

Route::get('/query', 'DBController@index');
Route::get('/joining', 'DBController@joining');

//model
Route::get('/model', 'DBController@model');



// ===============================================
// ADMIN BACK END SECTION ========================
// ===============================================
Route::group(['prefix' =>'back','middleware'=>'auth'], function() {

    Route::get('','admin\DashboardController@index');
    Route::get('/category','Admin\CategoryController@index');
    Route::get('/category/create','Admin\CategoryController@create');
    Route::get('/category/edit','Admin\CategoryController@edit');

    Route::get('permission','Admin\PermissionController@index');
    Route::get('permission/create','Admin\PermissionController@create');
    Route::post('permission/store','Admin\PermissionController@store');

    Route::get('/permission/edit/{id}',['uses'=>'Admin\PermissionController@edit', 'as'=>'permission-edit']);
    Route::put('/permission/edit/{id}',['uses'=>'Admin\PermissionController@update', 'as'=>'permission-update']);
    Route::delete('/permission/delete/{id}',['uses'=>'Admin\PermissionController@destroy', 'as'=>'permission-delete']);

    Route::get('/roles','Admin\RoleController@index');
    Route::get('/roles/create','Admin\RoleController@create');
    Route::post('/roles/store','Admin\RoleController@store');
     

    Route::get('/roles/edit/{id}',['uses'=>'Admin\RoleController@edit', 'as'=>'role-edit']);
    Route::put('/roles/edit/{id}',['uses'=>'Admin\RoleController@update', 'as'=>'role-update']);
    Route::delete('/roles/delete/{id}',['uses'=>'Admin\RoleController@destroy', 'as'=>'role-delete']);

    //Author Controller
    Route::get('author','Admin\AuthorController@index');
    Route::get('author/create','Admin\AuthorController@create');
    Route::post('/author/store','Admin\AuthorController@store');

    Route::get('/author/edit/{id}',['uses'=>'Admin\AuthorController@edit', 'as'=>'author-edit']);

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
