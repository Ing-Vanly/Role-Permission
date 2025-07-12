<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        //Employee
        $employee = User::create([
            'name' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $employeeRole = Role::firstOrCreate(['name' => 'Employee']);
        $employee->assignRole($employeeRole);

        //User
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $userRole = Role::firstOrCreate(['name' => 'User']);
        $user->assignRole($userRole);
    }
}
