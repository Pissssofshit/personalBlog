<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class DayPlanCost extends Model
{
	protected $connection = "pop";
	protected $table = "day_plan_cost";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}