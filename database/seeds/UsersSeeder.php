<?php

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Center;
use App\Models\Country;
use App\Models\Schedule;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();

        $roleDev = \App\Models\Role::query()->where('slug','dev')->first();
        $roleAdmin = \App\Models\Role::query()->where('slug','admin')->first();
        $roleUser = \App\Models\Role::query()->where('slug','user')->first();

        $user = new User();
        $user->name = 'Dev';
        $user->email = 'dev@alsaedan.com';        
        $user->password = Hash::make('devdev');
        $user->role_id = $roleDev->_id;
        $user->save();

        $user = new User();
        $user->name = 'Admin Admin';
        $user->email = 'admin@alsaedan.com';
        $user->password = Hash::make('adminadmin');
        $user->role_id = $roleAdmin->_id;
        $user->save();
        
        $user = new User();
        $user->name = 'User';
        $user->email = 'user@alsaedan.com';             
        $user->password = Hash::make('useruser');
        $user->role_id = $roleUser->_id;
        $user->save();
        

    }
}
