<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
	protected $connection = "xdwsy";
	protected $table = "user_point";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}