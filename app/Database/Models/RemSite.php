<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemSite extends Model
{
	protected $connection = "pop";
	protected $table = "rem_site";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "site_id";
	
}