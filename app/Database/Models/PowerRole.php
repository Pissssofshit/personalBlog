<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class PowerRole extends Model
{
	protected $connection = "pop";
	protected $table = "power_role";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "power_role_id";
	
}