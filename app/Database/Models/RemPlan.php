<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemPlan extends Model
{
	protected $connection = "pop";
	protected $table = "rem_plan";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "plan_id";
	
}