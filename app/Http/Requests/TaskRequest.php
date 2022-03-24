<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class TaskRequest extends FormRequest
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
            'subject'=>'required|string',
            'description'=>'required|string',
            'start_date'=> 'required|date_format:Y-m-d',
            'due_date'=> 'required|date_format:Y-m-d|after_or_equal:start_date',
            'status'=>['required',Rule::in(['New','Complete','Incomplete'])],
            'priority'=> ['required', Rule::in(['High', 'Medium', 'Low'])],
            'notes'=>'present|array',
            'notes.*.subject'=>'filled|string',
            'notes.*.attachment.*' => 'present|file' ,
            'notes.*.note' => 'required_with:notes.*.subject|string'     
        ];
    }

    public function messages(){
        return [
            'priority.in'=>"Priority can be 'Low','Medium' or 'High'.",
            'status.in' => "Status can be 'New','Incomplete' or 'Complete'.",
        ];
    }


    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */

    function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
