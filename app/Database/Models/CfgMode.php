<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class CfgMode extends Model
{
	protected $connection = "pop";
	protected $table = "cfg_mode";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "mode_id";
	
}