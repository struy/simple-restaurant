<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $role_cook = Role::where('name', 'cook')->first();
        $role_waiter = Role::where('name', 'waiter')->first();

        $cook = new User();
        $cook->name = 'Cook Name';
        $cook->email = 'cook@example.com';
        $cook->password = bcrypt('secret');
        $cook->save();
        $cook->roles()->attach($role_cook);

        $waiter = new User();
        $waiter->name = 'Waiter Name';
        $waiter->email = 'waiter@example.com';
        $waiter->password = bcrypt('secret');
        $waiter->save();
        $waiter->roles()->attach($role_waiter);
    }
}