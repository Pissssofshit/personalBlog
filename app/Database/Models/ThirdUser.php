<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdUser extends Model
{
	protected $connection = "xdwsy";
	protected $table = "third_user";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}