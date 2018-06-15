<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
          'title' => ['required','Max:255',Rule::unique('events')->ignore($this->event->id)],
          'content' => 'required',
          'date_start' => 'required|date|after_or_equal:today',
          'date_end' => 'required|date|after_or_equal:date_start',
          'time_start' => 'required|date_format:H:i',
          'time_end' => 'required|date_format:H:i|after:time_start',
          'image' => 'image',
          'tags' => ['Regex:/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/']
        ];
    }
}
