<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class CfgSubsistSign extends Model
{
	protected $connection = "pop";
	protected $table = "cfg_subsist_sign";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "subsist_day";
	
}