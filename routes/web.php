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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', function() {
  return redirect()->route('home');
});

Route::get('/admin', function() {
  return redirect()->route('home');
});

Route::prefix('admin')->middleware('auth')->group(function () {

  # Tasks
  Route::get('tasks', 'TaskController@index')->name('tasks');
  Route::get('board', 'TaskController@showBoard')->name('board');
  Route::get('task/{id}', 'TaskController@show')->name('task');
  Route::get('task/create/form', 'TaskController@create')->name('task_create');
  Route::get('task/{id}/edit', 'TaskController@edit')->name('task_edit');
  Route::get('task/calendar/list', 'TaskController@calendar')->name('task_calendar');
  Route::get('task/to-json', 'TaskController@getTasks')->name('tasks_json');
  Route::get('task/{id}/start', 'TaskController@startTask')->name('task_initiate');
  Route::get('task/{id}/finish', 'TaskController@finish')->name('task_finish');

  Route::post('task/store', 'TaskController@store')->name('task_store');
  Route::post('task/{id}/update', 'TaskController@update')->name('task_update');
  Route::post('task/{id}/pause', 'TaskController@pause')->name('task_pause');
  Route::post('task/{id}/start', 'TaskController@unPause')->name('task_start');

  Route::post('task/message/store', 'TaskMessagesController@store')->name('task_message_store');
  Route::post('task/{id}/delay', 'TaskController@delay')->name('task_delay');

  # Departments
  Route::get('departments', 'DepartmentsController@index')->name('departments');
  Route::get('department/{id}', 'DepartmentsController@show')->name('department');
  Route::get('department/create/form', 'DepartmentsController@create')->name('department_create');
  Route::get('department/{id}/edit', 'DepartmentsController@edit')->name('department_edit');
  Route::post('department/create/store', 'DepartmentsController@store')->name('department_store');
  Route::post('department/{id}/update', 'DepartmentsController@update')->name('department_update');

  # Processes
  Route::get('processes', 'ProcessesController@index')->name('processes');
  Route::get('processes-models', 'ProcessesController@indexModels')->name('processes_models');
  Route::get('process/{id}', 'ProcessesController@show')->name('process');
  Route::get('process/create/form', 'ProcessesController@create')->name('process_create');
  Route::get('process/{id}/edit', 'ProcessesController@edit')->name('process_edit');
  Route::get('process/{id}/copy/clients', 'ProcessesController@copyClients')->name('process_copy_clients');
  Route::get('process/{id}/tojson', 'ProcessesController@toJson')->name('process_to_json');
  Route::post('process/create/store', 'ProcessesController@store')->name('processes_store');
  Route::post('process/copy', 'ProcessesController@copy')->name('process_copy');
  Route::post('process/{id}/update', 'ProcessesController@update')->name('process_update');
/*
  Route::get('clients', 'ClientController@index')->name('clients');
  Route::get('client/create/form', 'ClientController@create')->name('client_create');
  Route::get('client/{id}/edit', 'ClientController@edit')->name('client_edit');
  Route::post('client/create/store', 'ClientController@store')->name('client_store');
  Route::post('client/{id}/update', 'ClientController@update')->name('client_update');
*/
  Route::resource('clients', 'ClientController');
  Route::resource('employees', 'EmployeesController');

  Route::get('subprocesses', 'SubProcessesController@index')->name('subprocesses');
  Route::get('subprocess/{id}', 'SubProcessesController@show')->name('subprocess');
  Route::get('subprocesses/form/create', 'SubProcessesController@create')->name('sub_process_create');
  Route::post('subprocesses/create/store', 'SubProcessesController@store')->name('sub_process_store');
  Route::get('subprocesses/{id}/edit', 'SubProcessesController@edit')->name('sub_process_edit');
  Route::post('subprocesses/{id}/update', 'SubProcessesController@update')->name('sub_process_update');

  Route::get('user/{id}/avatar', 'UsersController@editAvatar')->name('user_avatar');
  Route::get('users/create/form', 'UsersController@create')->name('user_create');
  Route::get('user/{id}/avatar/{avatar}/upload', 'UsersController@uploadAvatar')->name('user_upload_avatar');
  Route::post('users/create/store', 'UsersController@store')->name('user_store');
  Route::post('user/{id}/update', 'UsersController@update')->name('user_update');
  Route::post('user/{id}/update/configs', 'UsersController@updateConfigs')->name('user_update_configurations');
  Route::post('user/{id}/update/password', 'UsersController@updatePassword')->name('user_update_password');
  Route::post('user/{id}/update/password/first-access', 'UsersController@updatePasswordFirstAccess')->name('user_update_password_home');
  Route::get('boards', 'BoardController@index')->name('boards');
  Route::get('mappings', 'MapperController@index')->name('mappings');
  Route::get('mapping/{id}/edit', 'MapperController@edit')->name('mapping_edit');
  Route::get('mapping/{id}', 'MapperController@show')->name('mapping');
  Route::get('mapping/create/form', 'MapperController@create')->name('mapping_create');
  Route::get('mapping/{id}/tasks', 'MapperController@taskToDo')->name('mapping_tasks_to_do');
  Route::post('mapping/store', 'MapperController@store')->name('mapping_store');
  Route::get('mapping/{id}/add-task', 'MapperController@addTask')->name('mapping_tasks');
  Route::post('mapping/{id}/add-task-store', 'MapperController@addTaskStore')->name('mapping_tasks_store');
  Route::get('mapping/{id}/task/{task}/remove', 'MapperController@removeTaskStore')->name('mapper_remove_task');
  Route::post('mapping/{id}/start', 'MapperController@start')->name('mapping_start');

  Route::resource('users', 'UsersController');

  Route::get('users', 'UsersController@index')->name('users');
  Route::get('profile', 'UsersController@show')->name('user');

  Route::resource('documents', 'DocumentsController');
  Route::resource('delivery-order', 'DeliveryOrderController');

  Route::get('delivery-order/{id}/print/tags', 'DeliveryOrderController@printTags')->name('print_tags');

  Route::resource('message-board', 'MessageBoardController');
  Route::resource('message-types', 'MessageTypesController');

  Route::resource('roles', 'RolesController');
  Route::resource('permissions', 'PermissionsController');

  Route::resource('occupations', 'OccupationController');
  Route::resource('types', 'DocumentTypesController');

  Route::resource('courses', 'CoursesController');
  Route::resource('students', 'StudentsController');
  Route::resource('teams', 'TeamsController');

  Route::get('clients/addresses/search', 'ClientController@addresses')->name('client_addresses_search');
  Route::get('clients/{id}/addresses', 'AddressesController@show')->name('client_addresses');
  Route::get('clients/{id}/addresses/create', 'AddressesController@create')->name('client_addresses_create');
  Route::post('clients/{id}/addresses', 'AddressesController@store')->name('client_addresses_store');
  Route::delete('clients/{id}/addresses/destroy', 'AddressesController@destroy')->name('client_address_destroy');
  Route::get('clients/{id}/addresses/{address}/edit', 'AddressesController@edit')->name('client_addresses_edit');
  Route::put('clients/{id}/addresses/{address}/update', 'AddressesController@update')->name('client_addresses_update');

  Route::get('clients/{id}/employees', 'EmployeesController@show')->name('client_employees');
  Route::get('clients/{id}/employees/create', 'EmployeesController@create')->name('client_employee_create');
  Route::post('clients/{id}/employees', 'EmployeesController@store')->name('client_employee_store');
  Route::delete('clients/{id}/employees/destroy', 'EmployeesController@destroy')->name('client_employee_destroy');
  Route::get('clients/{id}/employees/{employee}/edit', 'EmployeesController@edit')->name('client_employee_edit');
  Route::put('clients/{id}/employees/{employee}/update', 'EmployeesController@update')->name('client_employee_update');

  Route::get('delivery-order/conference/documents', 'DeliveryOrderController@conference')->name('delivery_order_conference');

  Route::get('/department/occupations/search', 'OccupationController@search')->name('occupation_search');

  Route::get('cep', 'UtilController@cep')->name('cep');
  Route::get('departments/search/users', 'UtilController@usersByDepartment')->name('departments_users_search');

  Route::get('users/search', 'UsersController@search')->name('user_search');

  Route::get('user/{id}/permissions', 'UsersController@permissions')->name('user_permissions');

  Route::post('user/{id}/permissions/{permission}/revoke', 'UsersController@revoke')->name('user_permissions_revoke');
  Route::post('user/{id}/permissions/{permission}/grant', 'UsersController@grant')->name('user_permissions_grant');

  Route::get('/image/external', 'UtilController@image')->name('image');



});

  Route::get('delivery-order/{id}/start-delivery', 'DeliveryOrderController@start')->name('start_delivery');
