<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->truncate();

        $role = new Role();
        $role->name = 'Dev';
        $role->slug = 'dev';
        $role->save();

        $role = new Role();
        $role->name = 'Admin';
        $role->slug = 'admin';
        $role->save();


        $role = new Role();
        $role->name = 'User';
        $role->slug = 'user';
        $role->save();
       

    }
}
