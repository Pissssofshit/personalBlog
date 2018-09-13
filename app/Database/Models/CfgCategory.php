<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class CfgCategory extends Model
{
	protected $connection = "pop";
	protected $table = "cfg_category";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "category_id";
	
}