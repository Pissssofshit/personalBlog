<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class CfgPayWay extends Model
{
	protected $connection = "pop";
	protected $table = "cfg_pay_way";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}