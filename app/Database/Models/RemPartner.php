<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class RemPartner extends Model
{
	protected $connection = "pop";
	protected $table = "rem_partner";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "partner_id";
	
}