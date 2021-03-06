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
Route::post('/opportunities/save', 'OpportunityController@saveOpportunity')->name('opportunity.save');
Route::post('/opportunities/save-task', 'OpportunityController@saveTask')->name('opportunity.save.task');
Route::delete('/opportunities/remove-org-chart', 'OpportunityController@removeOrgChart')->name('opportunity.remove.org-chart');
Route::post('/opportunities/save-org-chart', 'OpportunityController@saveOrgChart')->name('opportunity.save.org-chart');
Route::post('/opportunities/upload-orgcharts', 'OpportunityController@uploadOrgcharts')->name('opportunity.upload.orgcharts');
Route::get('/opportunities/download-orgcharts/{id}', 'OpportunityController@downloadOrgcharts')->name('opportunity.download.orgcharts');
Route::post('/opportunities/save-jpp-soe', 'OpportunityController@saveJppSoe')->name('opportunity.save.jpp-soe');
Route::delete('/opportunities/remove-jpp-soe', 'OpportunityController@removeJppSoe')->name('opportunity.remove.jpp-soe');
Route::get('/opportunities/download-jppsoes/{id}', 'OpportunityController@downloadJppSoes')->name('opportunity.download.jppsoes');

Route::get('/scripts', 'ScriptController@getScripts')->name('scripts');
Route::delete('/scripts/remove/script-main/{id}', 'ScriptController@removeScriptMain')->name('scripts.remove.main');
Route::post('/scripts/save-script', 'ScriptController@saveScriptMain')->name('scripts.store.main');

Route::get('/emails', 'EmailController@getEmails')->name('emails');
Route::delete('/emails/remove/email-main/{id}', 'EmailController@removeEmailMain')->name('emails.remove.main');
Route::post('/emails/save-email', 'EmailController@saveEmailMain')->name('emails.store.main');

Route::get('/skills', 'SkillController@getSkills')->name('skills');
Route::post('/skills/save-skill-main', 'SkillController@saveSkillMain')->name('skills.store.main');
Route::delete('/skills/remove/skill-main/{id}', 'SkillController@removeSkillMain')->name('skills.remove.main');
Route::post('/skills/save-assessment', 'SkillController@saveAssessment')->name('skills.store.assessment');

Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings/store/general', 'SettingsController@storeGeneralSettings')->name('settings.store.general');
Route::post('/settings/store/tasks', 'SettingsController@storeTasksSettings')->name('settings.store.tasks');
Route::post('/settings/store/opportunities-input-fields', 'SettingsController@storeOppIFsSettings')->name('settings.store.opp.ifs');
Route::post('/settings/store/opportunities-sales-stage', 'SettingsController@storeOppSalesStageSettings')->name('settings.store.opp.salesstage');
Route::delete('/settings/remove/opportunities-sales-stage', 'SettingsController@removeOppSalesStageSettings')->name('settings.remove.opp.salesstage');
Route::put('/settings/update/opportunities-sales-stage', 'SettingsController@updateOppSalesStageSettings')->name('settings.update.opp.salesstage');
Route::post('/settings/store/opportunities-task-event', 'SettingsController@storeOppTaskEventSettings')->name('settings.store.opp.taskevent');
Route::delete('/settings/remove/opportunities-task-event', 'SettingsController@removeOppTaskEventSettings')->name('settings.remove.opp.taskevent');
Route::put('/settings/update/opportunities-task-event', 'SettingsController@updateOppTaskEventSettings')->name('settings.update.opp.taskevent');
Route::post('/settings/store/opportunities-ownership', 'SettingsController@storeOppOwnershipSettings')->name('settings.store.opp.ownership');
Route::post('/settings/store/opportunities-tooltip', 'SettingsController@storeOppTooltipSettings')->name('settings.store.opp.tooltip');
Route::post('/settings/store/script-main', 'SettingsController@storeScriptSettings')->name('settings.store.script.main');
Route::post('/settings/store/email-main', 'SettingsController@storeEmailSettings')->name('settings.store.email.main');
Route::post('/settings/store/skill-main', 'SettingsController@storeSkillMainSettings')->name('settings.store.skill.main');
Route::post('/settings/store/skill-startat', 'SettingsController@storeSkillStartAtSettings')->name('settings.store.skill.startat');
Route::post('/settings/store/skill-acmt', 'SettingsController@storeSkillACMTSettings')->name('settings.store.skill.acmt');
Route::get('/settings/remove/current-user', 'SettingsController@removeCurrentUser')->name('settings.remove.user.current');
Route::put('/settings/store/password', 'SettingsController@storePassword')->name('settings.store.password');

Route::get('/users', 'UserController@index')->middleware('can:manage-user')->name('users');
Route::put('/users/update', 'UserController@updateUserAccount')->middleware('can:manage-user')->name('user.update');
Route::put('/users/remove', 'UserController@removeUserAccount')->middleware('can:manage-user')->name('user.remove');
