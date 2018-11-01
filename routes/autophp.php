<?php 
Route::group(['namespace'=>'Autophp', 'prefix'=>'autophp'], function(){
	Route::get('/index', 'IndexController@index');
	Route::get('/welcome', 'IndexController@welcome');
	
	Route::get('/', function(){return redirect('/autophp/index');});
	
	Route::get('/h5_cp_game/export', 'H5CpGameController@export');
	Route::resource('/h5_cp_game', 'H5CpGameController');

	Route::get('/h5_gm_pt_appid_relation/export', 'H5GmPtAppidRelationController@export');
	Route::resource('/h5_gm_pt_appid_relation', 'H5GmPtAppidRelationController');

	Route::get('/h5_gm_pt_relation/export', 'H5GmPtRelationController@export');
	Route::resource('/h5_gm_pt_relation', 'H5GmPtRelationController');

	Route::get('/h5_yun_active/export', 'H5YunActiveController@export');
	Route::resource('/h5_yun_active', 'H5YunActiveController');

	Route::get('/h5_yun_login_log/export', 'H5YunLoginLogController@export');
	Route::resource('/h5_yun_login_log', 'H5YunLoginLogController');

	Route::get('/h5_yun_order/export', 'H5YunOrderController@export');
	Route::resource('/h5_yun_order', 'H5YunOrderController');

	Route::get('/h5_yun_platform/export', 'H5YunPlatformController@export');
	Route::resource('/h5_yun_platform', 'H5YunPlatformController');

	Route::get('/h5_yun_share_log/export', 'H5YunShareLogController@export');
	Route::resource('/h5_yun_share_log', 'H5YunShareLogController');

	Route::get('/h5_yun_user/export', 'H5YunUserController@export');
	Route::resource('/h5_yun_user', 'H5YunUserController');

	Route::get('/h5_yun_user_ad/export', 'H5YunUserAdController@export');
	Route::resource('/h5_yun_user_ad', 'H5YunUserAdController');

	Route::get('/h5_yun_user_log/export', 'H5YunUserLogController@export');
	Route::resource('/h5_yun_user_log', 'H5YunUserLogController');

	Route::get('/h5_yun_user_log/export', 'H5YunUserLogController@export');
	Route::resource('/h5_yun_user_log', 'H5YunUserLogController');

	Route::get('/h5_yun_xcx_user_session/export', 'H5YunXcxUserSessionController@export');
	Route::resource('/h5_yun_xcx_user_session', 'H5YunXcxUserSessionController');

	Route::get('/power_user/export', 'PowerUserController@export');
	Route::resource('/power_user', 'PowerUserController');

	Route::get('/power_role/export', 'PowerRoleController@export');
	Route::resource('/power_role', 'PowerRoleController');

});