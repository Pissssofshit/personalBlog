<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class UserVirtualPointLog extends Model
{
	protected $connection = "xdwsy";
	protected $table = "user_virtual_point_log";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}