<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/', 'SettingsController@index')->name('home');
Route::get('/', 'HomeController@tasks')->name('home');

// Route::match(['get','post'], 
//             '/tasks', 
//             ['as' => 'tasks', 'uses' => 'HomeController@tasks']
// );
Route::get('/tasks', 'HomeController@tasks')->name('tasks');
Route::post('/tasks/add', 'TasksController@addTask')->name('tasks.add');
Route::post('/tasks/save', 'TasksController@saveTask')->name('tasks.save');

Route::get('/outbound', 'HomeController@outbound')->name('outbound');
Route::get('/opportunities', 'HomeController@opportunities')->name('opportunities');
Route::get('/scripts', 'HomeController@scripts')->name('scripts');
Route::get('/emails', 'HomeController@emails')->name('emails');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::get('/resources', 'HomeController@resources')->name('resources');
Route::get('/skills', 'HomeController@skills')->name('skills');
Route::get('/analytics', 'HomeController@analytics')->name('analytics');

Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings/store', 'SettingsController@store')->name('settings.store');
