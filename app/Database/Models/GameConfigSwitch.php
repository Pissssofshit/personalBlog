<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class GameConfigSwitch extends Model
{
	protected $connection = "xdwsy";
	protected $table = "game_config_switch";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "game_id";
	
}