<?php

use Illuminate\Support\Facades\Route;

Route::prefix('form-builder/')->as('form_builder.')->middleware(['auth','admin'])->group(function () {
    Route::get('form-builder/translation','FormBuilderTranslationController@translation')->name('builder.translation');
    Route::post('form-builder/translation/save','FormBuilderTranslationController@store')->name('builder.translation.store');
    Route::resource('forms', 'FormBuilderController')->only(['index','show']);
    Route::get('/builder/{id}', 'FormBuilderController@builder')->name('builder');
    Route::post('/builder', 'FormBuilderController@builderUpdate')->name('builder.update')->middleware('prohibited_demo_mode');

});
