<?php

Route::prefix('importwidget')->middleware('auth')->group(function() {
    Route::get('/update', 'ImportWidgetController@update')->name('importwidget.update');
    Route::get('/report/{file_name}', 'ImportWidgetController@report')->name('importwidget.report');

    Route::post('/upload', 'ImportWidgetController@upload')->name('importwidget.upload');
    Route::post('/start', 'ImportWidgetController@start')->name('importwidget.start');    
});
