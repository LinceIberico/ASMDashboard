<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'admin',
            'email' => 'admin@test.es',
            'password' => '$2y$10$YQBgGnFqoNGkTR9Bi9hDAe1uFq.zLCOT2bMHjiWN/hLg/mvwYMtaG',
        ]);

        $role1 = Role::create(['name' => 'super']);
        $role2 = Role::create(['name' => 'admin']);
        $role3 = Role::create(['name' => 'cliente']);
        $role4 = Role::create(['name' => 'empleado']);

        // Permission::create(['name' => 'universal']);
        // $role = Role::find(1);
        // $role->givePermissionTo('universal');

        $user = User::find(1);
        $user->assignRole($role1);
        // $user->givePermissionTo('universal');
    }
}
