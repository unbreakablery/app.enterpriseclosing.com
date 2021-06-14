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

Route::get('/outbound', 'OutboundController@getOutbound')->name('outbound');
Route::post('/outbound/save-main', 'OutboundController@saveOutboundMain')->name('outbound.save.main');
Route::post('/outbound/save-person', 'OutboundController@saveOutboundPerson')->name('outbound.save.person');
Route::post('/outbound/remove-main', 'OutboundController@removeOutboundMain')->name('outbound.remove.main');
Route::post('/outbound/remove-person', 'OutboundController@removeOutboundPerson')->name('outbound.remove.person');
Route::get('/outbound/download/{id}', 'OutboundController@downloadPersons')->name('outbound.download.persons');
Route::post('/outbound/upload', 'OutboundController@uploadPersons')->name('outbound.upload.persons');
Route::post('/outbound/save-task', 'OutboundController@saveTask')->name('outbound.save.task');

Route::get('/opportunities', 'OpportunityController@getOpportunities')->name('opportunities');
Route::post('/opportunities/save-main', 'OpportunityController@saveOpportunityMain')->name('opportunity.save.main');
Route::post('/opportunities/update-main', 'OpportunityController@updateOpportunityMain')->name('opportunity.update.main');
Route::post('/opportunities/save-meddpicc', 'OpportunityController@saveOpportunityMeddpicc')->name('opportunity.save.meddpicc');

Route::get('/scripts', 'ScriptController@getScripts')->name('scripts');
Route::delete('/scripts/remove/script-main/{id}', 'ScriptController@removeScriptMain')->name('scripts.remove.main');

Route::get('/emails', 'HomeController@emails')->name('emails');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::get('/resources', 'HomeController@resources')->name('resources');
Route::get('/skills', 'HomeController@skills')->name('skills');
Route::get('/analytics', 'HomeController@analytics')->name('analytics');

Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings/store/general', 'SettingsController@storeGeneralSettings')->name('settings.store.general');
Route::post('/settings/store/tasks', 'SettingsController@storeTasksSettings')->name('settings.store.tasks');
Route::post('/settings/store/script-main', 'SettingsController@storeScriptSettings')->name('settings.store.script.main');
