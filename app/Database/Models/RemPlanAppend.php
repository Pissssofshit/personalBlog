<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemPlanAppend extends Model
{
	protected $connection = "pop";
	protected $table = "rem_plan_append";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "plan_id";
	
}