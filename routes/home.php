<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/4
 * Time: 10:19
 */

Route::group(['prefix' => '/', 'namespace' => 'Home'], function() {

    Route::group(['prefix' => 'user'], function () {
        Route::get('/home/id', 'UserController@index');
    });

});