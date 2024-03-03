<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\{
    Admin,
    Settings,
    RoleAdmin,
    PermissionRole,
    Roles,
    User,
    Messages,
    Bookings,
    Properties
};

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin;
        $admin->truncate();
        $admin->username =   'admin';
        $admin->email    =   'admin@boxa.com';
        $admin->password =   bcrypt('password');
        $admin->status =   'Active';
        $admin->save();

        $admin = Admin::first();

        $role_user = new RoleAdmin;
        $role_user->truncate();
        $role_user->admin_id = $admin->id;
        $role_user->role_id  = '1';
        $role_user->save();

        $data = [
            ['permission_id' => 1, 'role_id' => '1'],
            ['permission_id' => 2, 'role_id' => '1'],
            ['permission_id' => 3, 'role_id' => '1'],
            ['permission_id' => 4, 'role_id' => '1'],
            ['permission_id' => 5, 'role_id' => '1'],
            ['permission_id' => 6, 'role_id' => '1'],
            ['permission_id' => 7, 'role_id' => '1'],
            ['permission_id' => 8, 'role_id' => '1'],
            ['permission_id' => 9, 'role_id' => '1'],
            ['permission_id' => 10, 'role_id' => '1'],
            ['permission_id' => 11, 'role_id' => '1'],
            ['permission_id' => 12, 'role_id' => '1'],
            ['permission_id' => 13, 'role_id' => '1'],
            ['permission_id' => 14, 'role_id' => '1'],
            ['permission_id' => 15, 'role_id' => '1'],
            ['permission_id' => 16, 'role_id' => '1'],
            ['permission_id' => 17, 'role_id' => '1'],
            ['permission_id' => 18, 'role_id' => '1'],
            ['permission_id' => 19, 'role_id' => '1'],
            ['permission_id' => 20, 'role_id' => '1'],
            ['permission_id' => 21, 'role_id' => '1'],
            ['permission_id' => 22, 'role_id' => '1'],
            ['permission_id' => 23, 'role_id' => '1'],
            ['permission_id' => 24, 'role_id' => '1'],
            ['permission_id' => 25, 'role_id' => '1'],
            ['permission_id' => 26, 'role_id' => '1'],
            ['permission_id' => 27, 'role_id' => '1'],
            ['permission_id' => 28, 'role_id' => '1'],
            ['permission_id' => 29, 'role_id' => '1'],
            ['permission_id' => 30, 'role_id' => '1'],
            ['permission_id' => 31, 'role_id' => '1'],
            ['permission_id' => 32, 'role_id' => '1'],
            ['permission_id' => 33, 'role_id' => '1'],
            ['permission_id' => 34, 'role_id' => '1'],
            ['permission_id' => 35, 'role_id' => '1'],
            ['permission_id' => 36, 'role_id' => '1'],
            ['permission_id' => 37, 'role_id' => '1'],
            ['permission_id' => 38, 'role_id' => '1'],
            ['permission_id' => 39, 'role_id' => '1'],
            ['permission_id' => 40, 'role_id' => '1'],
            ['permission_id' => 41, 'role_id' => '1'],
            ['permission_id' => 42, 'role_id' => '1'],
            ['permission_id' => 43, 'role_id' => '1'],
        ];

        return PermissionRole::insert($data);
    }
}
