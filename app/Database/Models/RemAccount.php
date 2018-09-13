<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemAccount extends Model
{
	protected $connection = "pop";
	protected $table = "rem_account";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "account_id";
	
}