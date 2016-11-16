<?php namespace App\Http\Controllers;

use Input;
use Session;
use Redirect;
class LanguageController extends Controller {
	public function chooser(){
		Session::set('locale',Input::get('locale'));
		return Redirect::back();
	}


}