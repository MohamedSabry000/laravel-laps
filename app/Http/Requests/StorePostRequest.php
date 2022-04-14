<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        // dd($this->post());
        return [
            'title' => 'required|unique:posts,title,'.$this->post()['id'].'|min:3',
            'description' => 'required|min:10',
            'post_creator' => 'required|exists:users,id',
        ];
    }
}
