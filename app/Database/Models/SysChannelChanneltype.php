<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class SysChannelChanneltype extends Model
{
	protected $connection = "pop";
	protected $table = "sys_channel_channeltype";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}