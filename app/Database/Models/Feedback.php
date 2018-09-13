<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	protected $connection = "pop";
	protected $table = "feedback";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}