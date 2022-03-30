<?php

namespace App\Http\Requests\BugList;

use Illuminate\Foundation\Http\FormRequest;

class AddBugListRequest extends FormRequest
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
            'summary' => 'required|string|max:50',
            'description' => 'required|string|max:50'
        ];
    }
}
