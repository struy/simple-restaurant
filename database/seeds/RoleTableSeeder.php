<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $role_cook = new Role();
        $role_cook->name = 'cook';
        $role_cook->description = 'A Cook User';
        $role_cook->save();

        $role_waiter = new Role();
        $role_waiter->name = 'waiter';
        $role_waiter->description = 'A Waiter User';
        $role_waiter->save();

        $role_waiter = new Role();
        $role_waiter->name = 'new';
        $role_waiter->description = 'A New User';
        $role_waiter->save();

    }
}

