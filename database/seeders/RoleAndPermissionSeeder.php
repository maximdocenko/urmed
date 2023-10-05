<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $this->user->assignRole('Admin');

        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        $medic = Role::create(['name' => 'expert']);
    }
}
