<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $connection = "xdwsy";
	protected $table = "user";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}