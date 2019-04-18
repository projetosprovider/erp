<?php

use App\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use App\Models\RoleDefaultPermissions;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        if (Role::where('name', '=', 'Administrador')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin',
                'level'       => 5,
            ]);

            //$adminRole->syncPermissions(Permission::pluck('id'));

            foreach (Permission::all() as $key => $permission) {
                RoleDefaultPermissions::create([
                  'role_id' => $adminRole->id,
                  'permission_id' => $permission->id
                ]);
            }

        }

        if (Role::where('name', '=', 'Usuario')->first() === null) {
            $userRole = Role::create([
                'name'        => 'User',
                'slug'        => 'User',
                'description' => 'Acesso de User',
                'level'       => 1,
            ]);
        }

        if (Role::where('name', '=', 'Unverified')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Unverified',
                'slug'        => 'Unverified',
                'description' => 'Acesso de Unverified',
                'level'       => 0,
            ]);
        }

    }
}
