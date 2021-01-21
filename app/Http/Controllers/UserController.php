<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Imports\UsersImport;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:users.create')->only(['store','create']);
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only(['update','edit']);
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.destroy')->only('destroy');
        $this->middleware('can:users.upload')->only(['upload','uploadStore']);
    }

    public function uploadStore(Request $request){
        Excel::import(new UsersImport, request()->file('uploadUsers'));

        return redirect()->route('users')
        ->with('info', 'Users upload successfully');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $arr = [];
            $arr["data"] = User::with(['roles','masterfile2'=>function($query){
                $query->orderBy('joining_date','DESC');
            }])->get();
            return $arr;
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $users = User::whereDoesntHave('roles', function($query){
            $query->where('roles.name','Agent');
        })->pluck('name','id')->toArray();

        return view('users.create', compact('roles','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->merge([
            'username' => Str::lower($request->username),
            'password' => Hash::make($request->password)
        ])->all());

        //update Roles
        $user->roles()->sync($request->get('roles'));

        return redirect('users')->with('info', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        $users = User::pluck('name','id')->toArray() ;
        return view('users.edit', compact('user', 'roles','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        //update User
        $hasPassword = $request->password;

        $user->update(
            $request->merge(['password' => Hash::make($request->password)])
                ->except([$hasPassword ? '' : 'password'])
        );

        //update Roles
        $user->roles()->sync($request->get('roles'));



        return redirect()->route('users.edit', $user->id)
            ->with('info', 'User saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('info', 'Successfully removed');
    }
}
