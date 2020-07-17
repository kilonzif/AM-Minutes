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


Route::get('locale/{locale}', function ($locale){
    \App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});


Route::get('/php', function () {
    dd( phpinfo());
});
Route::redirect('/', '/login', 301);


Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home','HomeController@index')->name('home');

Route::prefix('minutes')->name('minutes.')->group(function () {
    Route::get('/', 'MinutesController@index')->name('index');
    Route::get('/new', 'MinutesController@createMeeting')->name('new');
    Route::get('/view/{id}', 'MinutesController@viewMeeting')->name('view');
    Route::post('/save', 'MinutesController@saveMinute')->name('save');
    Route::get('/edit/{id}', 'MinutesController@editMinute')->name('edit');
    Route::POST('/update', 'MinutesController@updateMinute')->name('update');
    Route::get('/delete/{id}', 'MinutesController@deleteMinute')->name('delete');


    Route::get('/search','MinutesController@searchMinutes')->name('search');
    Route::get('/filter','MinutesController@filterMinutes')->name('filter');
    Route::get('/filter_minutes','MinutesController@filterResultsMinutes')->name('filter_minutes');
    Route::post('/add_filter','MinutesController@add_filter')->name('add_filter');
    Route::get('/export_pdf/{id}','MinutesController@export_pdf')->name('export_pdf');
});


Route::prefix('user-management')->name('user-management.')->group(function () {
    //Users Routes
    Route::get('users', 'UserController@index')->name('users');
    Route::get('create_user', 'UserController@createUser')->name('create_user');
    Route::post('save_user', 'UserController@saveUser')->name('save_user');
    Route::get('edit_user', 'UserController@editUser')->name('edit_user');
    Route::post('update_user', 'UserController@updateUser')->name('update_user');
    Route::get('delete_user/{id}', 'UserController@deleteUser')->name('delete_user');
    Route::get('user_profile/{id}', 'UserController@userProfile')->name('user_profile');


});