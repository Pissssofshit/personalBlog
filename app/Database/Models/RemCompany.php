<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemCompany extends Model
{
	protected $connection = "pop";
	protected $table = "rem_company";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}