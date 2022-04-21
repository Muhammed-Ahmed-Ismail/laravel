<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
      //  dd($this->id);
        return [
            'title'=>['required',
                Rule::unique('posts')->ignore($this->id),
                'max:20'],
            'description'=>['required'],
            'writer_id'=>['required','exists:users,id']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'title.unique'=>'There is already post with the same name',
            'title.max' => 'Title cannot exceed 20 letters',
            'description.required' => 'A description is required',
            'writer_id.exists'=>'choose a valid user'
        ];
    }
}
