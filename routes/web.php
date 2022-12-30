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
Route::get('homepage', 'UserController@showHome')->name('homepage');

//Users
Route::get('users/{id}', 'UserController@show')->name('users.profile');
Route::get('users/{id}/edit',  'UserController@showEditForm')->name('editUser');
Route::patch('users/{id}/edit',  'UserController@update')->name('users.update');
Route::get('users/{id}/questions', 'PostController@showUserQuestions')->name('users.questions');
Route::get('users/{id}/answers', 'PostController@showUserAnswers')->name('users.answers');
Route::get('users/{id}/badges', 'UserController@showBadges')->name('users.badges');
Route::get('users/{id}/tags', 'UserController@showTags')->name('users.tags');
Route::patch('users/{id}/tags', 'UserController@changeTags')->name('users.changeTags');
Route::post('resultsUsers', 'UserController@search')->name('searchUser');

Route::get('users', 'UserController@showUsers')->name('users.page');

//Tags
Route::get('tags', 'TagController@show')->name('tags');
Route::get('tags/new', 'TagController@createForm')->name('tags.addForm');
Route::post('tags/new', 'TagController@create')->name('tags.add');
Route::get('tags/delete', 'TagController@deleteForm')->name('tags.deleteForm');
Route::post('tags/delete', 'TagController@delete')->name('tags.delete');

//Comments
Route::get('posts/{postid}/comments/new', 'CommentController@showCreateForm')->name('addComment');
Route::post('posts/{postid}/comments/new', 'CommentController@postComment')->name('comments.addComment');
Route::get('comments/{commentid}/edit', 'CommentController@showEditForm')->name('comments.edit');
Route::patch('comments/{commentid}/edit', 'CommentController@update')->name('comment.update');

//Posts
Route::get('posts/questions/new', 'PostController@showAddQuestionForm')->name('addQuestion');
Route::post('posts/questions/new', 'PostController@postQuestion')->name('posts.addQuestion');
Route::get('posts/answers/new', 'PostController@showAddAnswerForm')->name('addAnswer');
Route::post('posts/answers/new', 'PostController@postAnswer')->name('posts.addAnswer');
Route::get('posts/{id}/edit',  'PostController@showEditForm')->name('posts.edit');
Route::patch('posts/{id}/edit',  'PostController@update')->name('posts.update');
Route::get('posts/{id}/comments', 'PostController@showComments')->name('posts.comments');
Route::post('resultsPosts', 'PostController@search')->name('searchPost');
Route::get('posts/topquestions', 'PostController@showTopQuestions')->name('posts.top');
Route::get('posts/{id}', 'PostController@show')->name('posts.postPage'); //tem de ficar no fim

// API
Route::delete('api/posts/{id}', 'PostController@delete');
Route::delete('api/users/{id}', 'UserController@delete');
Route::delete('api/comments/{id}', 'CommentController@delete');
Route::put('api/star/{userid}/{postid}', 'StarController@create');
Route::delete('api/star/{userid}/{postid}', 'StarController@delete');
Route::put('api/posts/{id}/correct', 'PostController@correctness');


// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Static
Route::view('aboutus', 'pages.about')->name('about');
Route::post('contacts', 'ContactController@create');
Route::view('contacts', 'pages.contacts')->name('contacts');
Route::view('faq', 'pages.faq')->name('faq');
