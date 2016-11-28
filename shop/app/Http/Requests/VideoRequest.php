<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VideoRequest extends Request
{
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

        $rules = [
            'offer-title' => 'required|max:50',
            'offer-description' => "required|max:100",
        ];

        if($this->get('order-video-upload') != ""){
            $rules['order-video-upload'] = 'required';
        }

        if($this->get('order-photos') != ""){
            $rules['order-photos'] = 'required';
        }



        return $rules;
    }
}
