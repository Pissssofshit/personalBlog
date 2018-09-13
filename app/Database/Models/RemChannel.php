<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemChannel extends Model
{
	protected $connection = "pop";
	protected $table = "rem_channel";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "channel_id";
	
}