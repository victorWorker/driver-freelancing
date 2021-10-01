<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShipment extends FormRequest
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
            'userid' => ['nullable', 'numeric'],
            'name' => ['nullable', 'min:4'],
            'email' => ['nullable', 'email'],
            'password' => ['nullable', 'min:5'],
            'phone' => ['nullable', 'min:5'],
            'title' => ['required', 'min:3'],
            'transport' => ['required'],
            'collection' => ['required'],
            'delivery' => ['required'],
            'geometry' => ['required'],
            'distance' => ['required'],
            'image' => ['nullable'],
            'description' => ['required', 'min:15'],
        ];
    }
}
