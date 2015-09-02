<?php

namespace Tsny\Http\Requests;

use Tsny\Http\Requests\Request;

class CreateStudentRequest extends Request
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
            'student.first_name' => 'required',
            'student.last_name' => 'required',
            'student.email' => 'email',
            'student.primary_school' => 'required',
            'student.schools' => 'required'
        ];
    }
}
