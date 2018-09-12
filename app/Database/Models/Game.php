<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	protected $connection = "xdwsy";
	protected $table = "game";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}