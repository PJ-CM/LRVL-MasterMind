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

//Route::get('/', function () {
//    return view('index')->with([
//        'title' => 'Bienvenid@oooo',
//    ]);
//});
Route::get('/', 'MastermindController@index')
    ->name('mastermind_index');
Route::post('/nueva-partida', 'MastermindController@nuevaPartida')
    ->name('mastermind_nueva_partida');
Route::get('/otra-partida', 'MastermindController@otraPartida')
    ->name('mastermind_otra_partida');
/*Route::post('/jugar', 'MastermindController@jugar')
    ->name('mastermind_jugar');
Route::get('/jugar/{accion}', 'MastermindController@jugar')
    ->name('mastermind_jugar');*//**/
Route::match(['get', 'post'], '/jugar/{accion?}', 'MastermindController@jugar')
    ->name('mastermind_jugar');

/*
//PRUEBAS-Varias :: INI
Route::get('/prueba', function () {
    return view('prueba')->with([
        'title' => 'Bienvenid@oooo',
        'title_head' => 'Bienvenid@oooo',
    ]);
});
Route::get('/prueba-clave4', function () {
    return view('prueba-clave4')->with([
        'title' => 'Bienvenid@oooo',
        'title_head' => 'Bienvenid@oooo',
        'hojas_css' => ['estilos', 'estilos-tablero-clave-4'],
    ]);
});
Route::get('/prueba-clave5', function () {
    return view('prueba-clave5')->with([
        'title' => 'Bienvenid@oooo',
        'title_head' => 'Bienvenid@oooo',
        'hojas_css' => ['estilos', 'estilos-tablero-clave-5'],
    ]);
});
//PRUEBAS-Varias :: FIN
*/
