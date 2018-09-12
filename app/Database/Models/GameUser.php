<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
	protected $connection = "xdwsy";
	protected $table = "game_user";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}