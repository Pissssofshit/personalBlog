<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemGame extends Model
{
	protected $connection = "pop";
	protected $table = "rem_game";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "game_id";
	
}