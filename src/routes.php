<?php
Route::group(['middleware' => ['web']], function () {
    Route::get("comment/{id?}", "Hosein\Comments\Controllers\CommentsController@index");
    Route::get("commentLike/{id}", "Hosein\Comments\Controllers\CommentsController@commentLike");
    Route::get("commentDislike/{id}", "Hosein\Comments\Controllers\CommentsController@commentDislike");
    Route::post("createMessage/{id?}", "Hosein\Comments\Controllers\CommentsController@createMessage");

});
