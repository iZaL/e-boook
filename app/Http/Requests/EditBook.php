<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditBook extends Request
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
        return [
            'title_en'    => 'required|min:5',
            'title_ar'    => 'required|min:5',
            'category_id' => 'required',
            'body'        => 'required|min:10',
            'price'       => 'required|numeric|max:500',
            'cover_ar'    => 'mimes:jpeg,bmp,png',
            'cover_en'    => 'mimes:jpeg,bmp,png',
            'type'        => 'required'
        ];
    }
}
