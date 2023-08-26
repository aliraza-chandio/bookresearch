<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers;

Route::get('/', function () {
    return redirect('/login');
});
Route::resource('books', BookController::class);
Route::resource('types', TypeController::class);
//Route::post('/users/delete', 'App\Http\Controllers\UserController@delete')->name('delete');

// Route::resource('books', MasterNativeController::class);
// Route::resource('masters', MasterController::class);
// Route::resource('product_natives', ProductNativeController::class);
// Route::resource('product_masters', ProductMasterController::c`lass);
// Route::resource('product_relateds', ProductRelatedController::class);
// Route::resource('users', UserController::class);
// Route::get('/scholar-form/view', 'App\Http\Controllers\UserController@scholarFormView')->name('scholarFormView');
// Route::get('/scholar-form/view/{id}', 'App\Http\Controllers\UserController@scholarFormSingle')->name('scholarFormSingle');

// Route::post('/users/delete', 'App\Http\Controllers\UserController@delete')->name('delete');

// Route::delete('/scholars/delete/{id}', 'App\Http\Controllers\UserController@scholarDestroy')->name('scholars.destroy');

Route::get('/dashboard', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');
Auth::routes();

// Route::get('/get-table-type-by-type-id', 'App\Http\Controllers\AjaxController@getTableTypes');
// Route::get('/get-parent-by-table-type', 'App\Http\Controllers\AjaxController@getParents');
// Route::get('/get-types', 'App\Http\Controllers\AjaxController@getTypes');
// Route::get('/share-scholars', 'App\Http\Controllers\ProductController@getScholars');
// Route::post('/share-scholars-ajax', 'App\Http\Controllers\AjaxController@getScholarsAjax');

Route::get('/change-password', 'App\Http\Controllers\Auth\LoginController@changePassword')->name('change-password');
Route::post('/change-password/store', 'App\Http\Controllers\Auth\LoginController@changePasswordStore')->name('change-password.update');
Route::get('/profile', 'App\Http\Controllers\Auth\LoginController@profile')->name('profile');
Route::post('/profile/update', 'App\Http\Controllers\Auth\LoginController@profileUpdate')->name('profile.update');
