<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class UserPointLog extends Model
{
	protected $connection = "xdwsy";
	protected $table = "user_point_log";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}