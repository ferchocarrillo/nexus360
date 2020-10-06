<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

     /*

 $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50','regex:/^[a-z]{2,20}\.[a-z0-9]{2,20}$/i',  'unique:users'],
            'national_id' => ['required','string','unique:users'],
            'roles' => ['nullable','numeric'],
            'email' => ['required', 'string', 'email', 'max:255','regex:/(\W|^)[\w.\-]{2,25}@(ncri|contactpoint360)\.com(\W|$)/' , 'unique:users'],
            'password' => ['required', 'min:8'],
        ],$customMessages);

     */
    public function rules()
    {
        return [
        
            // 'username' => ['required', 'string', 'max:50', 'unique:users','regex:/^[a-z]{2,20}\.[a-z0-9]{2,20}$/i'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users','regex:/(\W|^)[\w.\-]{2,25}@(ncri|contactpoint360)\.com(\W|$)/'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'username' => ['required', 'string', 'max:50','regex:/^[a-z]{2,20}\.[a-z0-9]{2,20}$/i', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null) ],
            // 'email' => ['required', 'string', 'email', 'max:255','regex:/(\W|^)[\w.\-]{2,25}@(ncri|contactpoint360)\.com(\W|$)/' , Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)],
            'name' => ['required', 'string', 'max:255'],
            'national_id' => ['required','string',Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null) ],
            'username' => ['required', 'string', 'max:50','regex:/^[a-z ñ]{2,20}\.[a-z0-9]{2,20}$/i', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null) ],
            'email' => ['required', 'string', 'email', 'max:255','regex:/(\W|^)[\w.\-]{2,25}@(ncri|contactpoint360)\.com(\W|$)/' , Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)],
            'password' => [ $this->route()->user ? 'required_with:password_confirmation' : 'required', 'nullable', 'min:8', 'confirmed'],

        ];
    }


}
