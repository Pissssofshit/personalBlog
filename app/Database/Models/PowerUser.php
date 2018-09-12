<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class PowerUser extends Model
{
	protected $connection = "xdwsy";
	protected $table = "power_user";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "power_user_id";
	
}