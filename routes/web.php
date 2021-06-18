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
Route::get('/', 'TasksController@getTasks')->name('home');

// Route::match(['get','post'], 
//             '/tasks', 
//             ['as' => 'tasks', 'uses' => 'HomeController@tasks']
// );
Route::get('/tasks', 'TasksController@getTasks')->name('tasks');
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
Route::post('/scripts/save-script', 'ScriptController@saveScriptMain')->name('scripts.store.main');

Route::get('/emails', 'EmailController@getEmails')->name('emails');
Route::delete('/emails/remove/email-main/{id}', 'EmailController@removeEmailMain')->name('emails.remove.main');
Route::post('/emails/save-email', 'EmailController@saveEmailMain')->name('emails.store.main');

Route::get('/skills', 'SkillController@getSkills')->name('skills');
Route::post('/skills/save-skill-main', 'SkillController@saveSkillMain')->name('skills.store.main');
Route::delete('/skills/remove/skill-main/{id}', 'SkillController@removeSkillMain')->name('skills.remove.main');

Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings/store/general', 'SettingsController@storeGeneralSettings')->name('settings.store.general');
Route::post('/settings/store/tasks', 'SettingsController@storeTasksSettings')->name('settings.store.tasks');
Route::post('/settings/store/script-main', 'SettingsController@storeScriptSettings')->name('settings.store.script.main');
Route::post('/settings/store/email-main', 'SettingsController@storeEmailSettings')->name('settings.store.email.main');
Route::post('/settings/store/skill-main', 'SettingsController@storeSkillMainSettings')->name('settings.store.skill.main');
