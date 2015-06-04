<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class CreateBook extends Request
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
            //
            'title_en' => 'required|min:5',
            'title_ar' => 'required|min:5',
            'category_id' => 'required',
            'body'     => 'required|min:10'
        ];
    }
}
