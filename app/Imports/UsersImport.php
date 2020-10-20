<?php

namespace App\Imports;

use App\Http\Requests\UserRequest;
use App\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = new Request($row);
        $request = $request->merge([
            'username' => Str::lower($request->username),
            'password' => Hash::make($request->password),
            'roles' => [$request->roles]
        ]);
        
        $user = User::create($request->all());
        $user->roles()->sync($request->get('roles'));

        
    }

    public function rules():array 
    {
        return [

                 
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50','regex:/^[a-z ñ]{2,20}\.[a-zñ0-9]{2,20}$/i','unique:users' ],
            'national_id' => ['required','string','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255','regex:/(\W|^)[\w.\-]{2,25}@(ncri|contactpoint360|cp-360)\.com(\W|$)/' , 'unique:users'],
            'roles' => ['nullable','numeric'],
            'password' => ['required', 'min:8'],
        ];
    }
}
