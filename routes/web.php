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
    return view('admin.home');
});



Route::get('/country', function () {
    return view('admin.country');
});
Route::post('/addcountry',[App\Http\Controllers\CountryController::class, 'store'])->name('countrystore');
Route::any('/country_datable',[App\Http\Controllers\CountryController::class, 'country_datable'])->name('country_datable');
Route::get('/countrylist',[App\Http\Controllers\CountryController::class, 'show'])->name('countryListMain');
Route::post('/delcountry',[App\Http\Controllers\CountryController::class, 'destroy'])->name('del_country');
Route::post('/update_status',[App\Http\Controllers\CountryController::class, 'status_update'])->name('status_country');
Route::post('/country_dell_all',[App\Http\Controllers\CountryController::class, 'del_all'])->name('del_all');
Route::any('/edit_country/{id}',[App\Http\Controllers\CountryController::class, 'edit'])->name('edit_country');
Route::any('/upd_country',[App\Http\Controllers\CountryController::class, 'update'])->name('upd_country');

Route::get('/createstate',[App\Http\Controllers\StateController::class, 'create']);
Route::post('/addstate',[App\Http\Controllers\StateController::class, 'store'])->name('statestore');
Route::get('/statelist',[App\Http\Controllers\StateController::class, 'show'])->name('stateListMain');
Route::get('/state_datable',[App\Http\Controllers\StateController::class, 'state_datable'])->name('state_datable');
Route::post('/delstate',[App\Http\Controllers\StateController::class, 'destroy'])->name('del_state');
Route::post('/status_update',[App\Http\Controllers\StateController::class, 'status_update'])->name('state_status');
Route::post('/sate_del_all',[App\Http\Controllers\StateController::class, 'del_all'])->name('state_del_all');
Route::any('/edit_state/{id}',[App\Http\Controllers\StateController::class, 'edit'])->name('edit_state');
Route::any('/upd_state',[App\Http\Controllers\StateController::class, 'update'])->name('upd_state');


Route::get('/createarea',[App\Http\Controllers\AreaController::class, 'create']);
Route::post('/addarea',[App\Http\Controllers\AreaController::class, 'store'])->name('areastore');
Route::get('/arealist',[App\Http\Controllers\AreaController::class, 'show'])->name('areaListMain');
Route::get('/area_datable',[App\Http\Controllers\AreaController::class, 'area_datable'])->name('area_datable');
Route::any('/stateurl',[App\Http\Controllers\AreaController::class, 'stateshow'])->name('state_show');
Route::post('/del_area',[App\Http\Controllers\AreaController::class, 'destroy'])->name('del_area');
Route::post('/area_status_update',[App\Http\Controllers\AreaController::class, 'status_update'])->name('area_status');
Route::post('/area_del_all',[App\Http\Controllers\AreaController::class, 'del_all'])->name('area_del_all');
Route::any('/edit_area/{id}',[App\Http\Controllers\AreaController::class, 'edit'])->name('edit_area');
Route::any('/upd_area',[App\Http\Controllers\AreaController::class, 'update'])->name('upd_area');
Route::post('/upd_state_show',[App\Http\Controllers\AreaController::class, 'upd_state_show'])->name('upd_state_show');


/*Route::get('/createstreat',[App\Http\Controllers\StreatController::class, 'create']);
Route::post('/addstreat',[App\Http\Controllers\StreatController::class, 'store'])->name('streatstore');
Route::get('/streatlist',[App\Http\Controllers\StreatController::class, 'show']);
Route::any('/areaurl',[App\Http\Controllers\StreatController::class, 'areashow'])->name('area_show');
Route::any('/del_streat',[App\Http\Controllers\StreatController::class, 'destroy'])->name('del_streat');*/