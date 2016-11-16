<?php namespace App\Http\Controllers;

use Input;
use Session;
use Redirect; 
use LaravelGettext;
class LanguageController extends Controller {
	public function chooser(){
		//Session::set('locale',Input::get('locale'));

		$test=echo _('Translated string');

		LaravelGettext::setLocale('en_US');
		return Redirect::back();
	}


}