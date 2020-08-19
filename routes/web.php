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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('home');
});


Route::get('home', 'HomeController@index')->name('home');

// Route::get('login', function(){
//     return view('auth.login');
// });

Route::get('signup', 'AuthController@index');

Route::middleware(['auth'])->group(function () {

    Route::get('guidelines', 'GuidelinesController@index')->name('guidelines');
    Route::get('guidelines/list', 'GuidelinesController@viewGuidelinesList')->name('view-guidelines-list');
    Route::get('guidelines/add/{department_id}', 'GuidelinesController@viewAddGuidelines')->name('view-add-guidelines');
    Route::get('guidelines/edit/{department_id}', 'GuidelinesController@viewEditGuideline')->name('view-edit-guidelines');
    Route::post('guidelines/add', 'GuidelinesController@addGuideline')->name('add-guideline-action');
    Route::post('guidelines/edit', 'GuidelinesController@editGuideline')->name('edit-guideline-action');

    Route::get('colleges/{id}', 'CollegeController@index')->name('college');

    Route::get('departments/{id}', 'DepartmentController@index')->name('department');

    Route::get('projects/{project_id}', 'ProjectController@index')->name('view-project');
    Route::get('project/add', 'ProjectController@addProjectView')->name('add-project');
    Route::post('project/add', 'ProjectController@addProject')->name('add-project-action');
    Route::get('project/edit', 'ProjectController@editProjectView')->name('edit-project');
    Route::post('project/edit', 'ProjectController@editProject')->name('edit-project-action');
    Route::get('projects-submission', 'ProjectController@viewProjectSubmission')->name('project-submission');
    Route::get('projects/change-status/{project_id}/status/{new_status}/{feedback?}', 'ProjectController@changeProjectStatus')->name('project-change-status');

    Route::post('user/profile/edit', 'UserController@editProfile')->name('edit-profile');
    Route::get('user/profile', 'UserController@viewProfile')->name('user-profile');
    Route::get('user/access', 'UserController@vewChangeUserType')->name('change-user-type');
    Route::get('user/change-access/type/{user_type}/user/{user_id}', 'UserController@changeUserType')->name('change-user-type-action');

    Route::get('search/result', 'SearchController@showSearchResult')->name('search-result');
    Route::any('search', 'SearchController@search')->name('search');

});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
