<?php

use App\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;

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
                'name'        => 'Administrador',
                'slug'        => 'admin',
                'description' => 'Administrador',
                'level'       => 5,
            ]);

            //$adminRole->syncPermissions(Permission::pluck('id'));
        }

        if (Role::where('name', '=', 'Gerente')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Gerente',
                'slug'        => 'manager',
                'description' => 'Acesso Gerente',
                'level'       => 3,
            ]);
        }

        if (Role::where('name', '=', 'Usuario')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Usuario',
                'slug'        => 'user',
                'description' => 'Acesso de Usuario',
                'level'       => 1,
            ]);
        }

    }
}
