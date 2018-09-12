<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginLog extends Model
{
	protected $connection = "xdwsy";
	protected $table = "user_login_log";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}