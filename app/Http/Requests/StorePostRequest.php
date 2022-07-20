<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        // $rules = [
        //     'en.title' => 'required',
        //     'en.description' => 'required',
        // ];
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = 'required|string';
            $rules[$locale . '.description'] = 'required|string';
        }

        return $rules;
    }
}
