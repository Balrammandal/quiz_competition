<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Basic Roll

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->save();

        //Add User With Role

        $Admin = New App\User();
        $Admin->name = "Admin";
        $Admin->email = "admin@gmail.com";
        $Admin->phone = "1234567890";
        $Admin->address = "Durgapur";
        $Admin->password = bcrypt("123456");
        $Admin->latitude = '10.1010';
        $Admin->longitude = '12.1010';
        $Admin->status = 'Active';
        $Admin->user_type = 'Admin';
        $Admin->save();
        $Admin->assignRole(['admin']);
    }
}
