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
// Home
Route::get('/', 'Auth\LoginController@home');
Route::get('homepage', 'UserController@showHome');

//Users
Route::get('users/{id}', 'UserController@show')->name('users.profile');
Route::get('users/{id}/edit',  'UserController@showEditForm')->name('editUser');
Route::patch('users/{id}/edit',  'UserController@update')->name('users.update');
Route::get('users/{id}/questions', 'PostController@showUserQuestions')->name('users.questions');
Route::get('users/{id}/answers', 'PostController@showUserAnswers')->name('users.answers');

//Posts


// API
Route::delete('api/answers/{answer_id}', 'PostController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
