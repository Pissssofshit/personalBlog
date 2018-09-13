<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class SysPlanMaterial extends Model
{
	protected $connection = "pop";
	protected $table = "sys_plan_material";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}