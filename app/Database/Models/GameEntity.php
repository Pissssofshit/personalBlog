<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class GameEntity extends Model
{
	protected $connection = "xdwsy";
	protected $table = "game_entity";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}