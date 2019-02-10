<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('api')->group(function(){
    Route::resource(
     'journals',
     'JournalController',
     ['only'=>['index', 'store', 'show', 'update', 'destroy']]
   );
});

Route::prefix('api')->group(function(){
    Route::resource(
     'accounts',
     'AccountController',
     ['only'=>['index', 'store', 'show', 'update', 'destroy']]
   );
});

Route::prefix('api')->group(function(){
    Route::resource(
     'reports',
     'ReportController',
     ['only'=>['index', 'store', 'show', 'update', 'destroy']]
   );
});

Route::prefix('api')->group(function(){
    Route::resource(
     'amounts',
     'AmountController',
     ['only'=>['index', 'store', 'show', 'update', 'destroy']]
   );
});

