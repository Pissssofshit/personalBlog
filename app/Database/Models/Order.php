<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $connection = "xdwsy";
	protected $table = "order";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}