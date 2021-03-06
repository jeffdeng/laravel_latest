<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', ['as' => 'h','uses' => 'HomeController@index']);//'middleware' => 'auth',
Route::get('/mail/{id}',  'HomeController@sendReminderEmail');
//Route::get('/verify',  '\Api\Repositories\VerifierController@verify');

// Route::controllers([  
//     'auth' => 'Auth\AuthController',
//     'password' => 'Auth\PasswordController',
// ]);


// Route::get('test', ['middleware' => 'oauth', function() {
// 	//    echo "oauth 认证成功 user id: " . Authorizer::getResourceOwnerId();
// 	echo App\User::find(Authorizer::getResourceOwnerId());
// }]);

// Route::get('test2', function() {
// 		//    echo "oauth 认证成功 user id: " . Authorizer::getResourceOwnerId();
// 		echo Request::header('Authorization');
// });


Route::post('oauth/access_token', function() {
	return Response::json(Authorizer::issueAccessToken());
});

$api = app('api.router');
 $api->version('v1',['middleware' => 'oauth'], function ($api) {
	$api->get('users/{id}', 'Api\V1\UserController@show');
	$api->post('users/register', 'Api\V1\UserController@register');
});
 
$api->version('v1', function ($api) {
 		$api->post('users/register', 'Api\V1\UserController@register');
});
 	
 
//  	$api->group(['protected' => true],function($api){
//  		//需要保护的路由
//  		$api->get('user/{id}', 'Api\V1\UserController@show');
 	
//  	});

 	
 	Route::post('/access_token', function (Request $request)  {
 	
 		try {
 	
 			$response = Authorizer::issueAccessToken();
 			return new Response(
 					json_encode($response),
 					200,
 					[
 							'Content-type'  =>  'application/json',
 							'Cache-Control' =>  'no-store',
 							'Pragma'        =>  'no-store'
 					]
 			);
 	
 		} catch (OAuthException $e) {
 	
 			return new Response(
 					json_encode([
 							'error'     =>  $e->errorType,
 							'message'   =>  $e->getMessage()
 					]),
 					$e->httpStatusCode,
 					$e->getHttpHeaders()
 			);
 	
 		}
 	
 	});			

///

$api->version('v1', ['middleware' => 'api.auth'], function ($api) {
	$api->get('user', ['scopes' => 'read_user_data', function () {
		// Only access tokens with the "read_user_data" scope will be given access.
	}]);
});
//中间件加参数模式
// Route::put('post/{id}', ['middleware' => 'role:editor,delete', function ($id) {

// }]);




