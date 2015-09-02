<?php

namespace Tsny\Http\Requests;

use Tsny\Http\Requests\Request;

class CreateSkillRequest extends Request
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
            'skill' => 'required',
            'skill.name' => 'required',
            'skill.current' => 'required|boolean',
            'skill.proficiency' => 'required|integer',
        ];
    }
}
