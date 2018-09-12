<?php
namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller {
	public function __construct() {
        parent::__construct();
	}

	public function index() {
		return view("autophp.common.index");
	}

	public function welcome() {
		return "Welcome to autopp test framework!";
	}
}
