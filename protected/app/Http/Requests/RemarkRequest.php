<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RemarkRequest extends Request
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
            'bscrnc' => 'required',
            'cell' => 'required',
            'area' => 'required',
            'kpi' => 'required',
            'kategori' => 'required',
            'date_ex' => 'required|date|date_format:"y-m-d"',
            'date_close' => 'required|date|date_format:"y-m-d"',
            'remark' => 'required',
            'status' => 'required',
            'created_by' => 'required',
            'update_by' => 'required'
        ];
    }
}
