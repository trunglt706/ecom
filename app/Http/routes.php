<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    /*
    |--------------------------------------------------------------------------
    | Backend
    |--------------------------------------------------------------------------
    |
    */
    Route::group([ 'prefix' => config('data.ROUTE_PREFIX_ADMIN') ], function(){
        Route::any('{paths?}', "Com\System\SystemController@pathHandle")->where('paths', '([A-Za-z0-9\-\/]+)');
    });

    /*
    |--------------------------------------------------------------------------
    | Frontend
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => config('data.ROUTE_PREFIX_SITE')], function(){
        $routes = App\Com\System\Route::get('site');
        foreach ($routes as $route){
            Route::controller($route->alias, "Com\\".($route->extension_name)."\\".$route->ctrl);
        }
        Route::controller('filemanager', "Com\\FileManager\\FileManagerController");
    });
    Route::group(['prefix' => '{locale}', 'middleware' => ['locale', 'offline']], function() {
        Route::any('{paths?}', "Com\System\SiteController@pathHandle")->where('paths', '([A-Za-z0-9\-\/]+)');
    });

    Route::get('/', function(){
        $default = \Language::where('default', 1)->value('alias');
        if($default == '') abort (404);
        return redirect($default);
    });

});
