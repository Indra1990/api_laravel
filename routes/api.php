<?php

Route::group(['middleware' => ['api']], function (){
  Route::post('/auth/signup', 'AuthController@signup');
  Route::get('/auth/signin', 'AuthController@getlogin');
  Route::post('/auth/signin', 'AuthController@signin');
  Route::get('/tutorial', 'TutorialController@index');
  Route::get('/tutorial/{id}', 'TutorialController@show');

      Route::group(['middleware' => ['jwt.auth']], function (){
        Route::get('/profile', 'UserController@show');

        // ====tutorial
        Route::post('/tutorial', 'TutorialController@store');
        Route::put('/tutorial/{id}', 'TutorialController@update');
        Route::delete('/tutorial/{id}', 'TutorialController@delete');

        // =====comments
        Route::get('/comments', 'CommentController@index');
        Route::get('/comments/{id}', 'CommentController@show');
        Route::post('/comments/{id}', 'CommentController@store');
        Route::put('/comments/{id}', 'CommentController@update');
        Route::delete('/comments/{id}', 'CommentController@delete');

        // ====notification
        Route::get('/notification', 'NotificationController@index');

        // ====tags
        Route::get('/tag', 'TagController@index');
        Route::post('/tag', 'TagController@store');
        Route::put('/tag/{id}', 'TagController@update');
        Route::delete('/tag/{id}', 'TagController@delete');


      });
});
