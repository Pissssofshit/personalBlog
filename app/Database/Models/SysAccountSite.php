<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class SysAccountSite extends Model
{
	protected $connection = "pop";
	protected $table = "sys_account_site";
	public $timestamps = false;
	//public $incrementing = false;
	public $primaryKey = "id";
	
}