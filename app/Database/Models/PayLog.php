<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class PayLog extends Model
{
	protected $connection = "pop";
	protected $table = "pay_log";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}