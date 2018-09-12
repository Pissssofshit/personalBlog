<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelCallback extends Model
{
	protected $connection = "pop";
	protected $table = "channel_callback";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}