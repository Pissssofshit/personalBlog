<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
	protected $connection = "xdwsy";
	protected $table = "order_log";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}