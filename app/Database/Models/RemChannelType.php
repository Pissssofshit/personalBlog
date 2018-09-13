<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemChannelType extends Model
{
	protected $connection = "pop";
	protected $table = "rem_channel_type";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}