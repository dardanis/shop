<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAdRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules=[
			'name'=>'required',
			'types'=>'required',
			'image'=>'image|png,jpeg,jpg',
			'position'=>'numeric'
		];

		if($this->get('types')==1){
			$rules['product']='required';
		}
		if($this->get('types')==2){
			$rules['image']='required';
			$rules['position']='required';
		}
		return $rules;
	}

	public function attributes(){
		return [
            'name' => 'ad name is required',
            'types'=>'you must choose one type of advertisment',

        ];
	}

}
