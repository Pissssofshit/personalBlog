<?php 
Route::group(['namespace'=>'Autophp', 'prefix'=>'autophp'], function(){
	Route::get('/', 'IndexController@index');
	Route::get('/welcome', 'IndexController@welcome');
	
	Route::get('/user/export', 'UserController@export');
	Route::resource('/user', 'UserController');
	Route::get('/third_user/export', 'ThirdUserController@export');
	Route::resource('/third_user', 'ThirdUserController');
	Route::get('/game_user/export', 'GameUserController@export');
	Route::resource('/game_user', 'GameUserController');
	Route::get('/user_login_log/export', 'UserLoginLogController@export');
	Route::resource('/user_login_log', 'UserLoginLogController');
	Route::get('/game_entity/export', 'GameEntityController@export');
	Route::resource('/game_entity', 'GameEntityController');
	Route::get('/game/export', 'GameController@export');
	Route::resource('/game', 'GameController');
	Route::get('/game_config_switch/export', 'GameConfigSwitchController@export');
	Route::resource('/game_config_switch', 'GameConfigSwitchController');
	Route::get('/order/export', 'OrderController@export');
	Route::resource('/order', 'OrderController');
	Route::get('/user_point/export', 'UserPointController@export');
	Route::resource('/user_point', 'UserPointController');
	Route::get('/user_point_log/export', 'UserPointLogController@export');
	Route::resource('/user_point_log', 'UserPointLogController');
	Route::get('/order_log/export', 'OrderLogController@export');
	Route::resource('/order_log', 'OrderLogController');
	Route::get('/user_virtual_point/export', 'UserVirtualPointController@export');
	Route::resource('/user_virtual_point', 'UserVirtualPointController');
	Route::get('/user_virtual_point_log/export', 'UserVirtualPointLogController@export');
	Route::resource('/user_virtual_point_log', 'UserVirtualPointLogController');
	Route::get('/power_user/export', 'PowerUserController@export');
	Route::resource('/power_user', 'PowerUserController');
	Route::get('/power_role/export', 'PowerRoleController@export');
	Route::resource('/power_role', 'PowerRoleController');
});