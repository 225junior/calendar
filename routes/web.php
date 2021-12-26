<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\FullCalendarController@index');
Route::POST('calendar/delete', 'App\Http\Controllers\FullCalendarController@delete');
Route::post('action','App\Http\Controllers\FullCalendarController@action');
