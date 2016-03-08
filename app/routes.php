<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::post('/login','UsersController@login');
Route::post('/forgot','UsersController@forgot');
Route::post('/changepassword/{id}','UsersController@changepassword');

Route::get('users','UsersController@index');
Route::post('users','UsersController@store');
Route::get('users/{id}','UsersController@show');
Route::post('users/{id}','UsersController@update');
Route::get('users/delete/{id}','UsersController@destroy');


Route::post('users/categories/{id}','UsersController@storeCategoriesOfUser');
Route::post('/users/subcategories/{id}','UsersController@storeSubCategoriesOfUser');
Route::get('/users/categories/{id}','UsersController@getAllCategoriesOfUser');
Route::get('/users/subcategories/{id}','UsersController@getAllSubCategoriesOfUser');
Route::post('/users/post/{id}','UsersController@storePost');
Route::get('/users/post/{id}','UsersController@getAllPost');


Route::get('post','PostsController@index');
Route::post('post','PostsController@store');
Route::get('post/{id}','PostsController@show');
Route::post('post/{id}','PostsController@update');
Route::get('post/delete/{id}','PostsController@destroy');

Route::get('allcategories','CategoriesController@getAllCategories');
Route::get('categories','CategoriesController@index');
Route::post('categories','CategoriesController@store');
Route::get('categories/{id}','CategoriesController@show');
Route::post('categories/{id}','CategoriesController@update');
Route::get('categories/delete/{id}','CategoriesController@destroy');
Route::get('categories/subcategories/{id}','CategoriesController@getsubcategories');

Route::get('subcategories','SubcategoriesController@index');
Route::post('subcategories','SubcategoriesController@store');
Route::get('subcategories/{id}','SubcategoriesController@show');
Route::post('subcategories/{id}','SubcategoriesController@update');
Route::get('subcategories/delete/{id}','SubcategoriesController@destroy');