<?php

use App\AgentActivity;
use Illuminate\Database\Seeder;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::create([
            'name'      => 'Admin',
            'slug'      => 'admin',
            'special'   => 'all-access'
        ]);


        // factory(User::class,5)->create();

        $user = User::create([
        'name' => 'Juan Cuellar',
        'username' => 'juan.cuellar',
        'email' => 'juan.cuellar@ncri.com',
        'email_verified_at' => now(),
        'password' => Hash::make('Developer2121!'), // password
        'remember_token' => Str::random(10),
        'national_id' => '1081417578'
        ]);

        $user->roles()->sync($role->id);
        //$user->latestactivity()->sync('1');

    }
}
