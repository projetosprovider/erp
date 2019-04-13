<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;
use App\Models\Module;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = Module::all();

        foreach ($modules as $key => $module) {

          $slugView = 'view.' . str_slug($module->name);
          $slugCreate = 'create.' . str_slug($module->name);
          $slugEdit = 'edit.' . str_slug($module->name);
          $slugDelete = 'delete.' . str_slug($module->name);

          if (Permission::where('slug', '=', $slugView)->first() === null) {
              Permission::create([
                  'name'        => 'Visualizar ' . $module->name,
                  'slug'        => $slugView,
                  'description' => 'Pode Visualizar ' . $module->name,
                  'model'       => '',
                  'module_id'   => $module->id,
              ]);
          }

          if(in_array($module->name, [
            'Painel Principal',
            'Gestão de Entregas',
            'Gestão de Processos',
            'Administrativo',
            'Treinamentos'
          ])) {
            continue;
          }

          if (Permission::where('slug', '=', $slugCreate)->first() === null) {
              Permission::create([
                  'name'        => 'Criar ' . $module->name,
                  'slug'        =>  $slugCreate,
                  'description' => 'Pode Adicionar ' . $module->name,
                  'model'       => '',
                  'module_id'   => $module->id,
              ]);
          }

          if (Permission::where('slug', '=', $slugEdit)->first() === null) {
              Permission::create([
                  'name'        => 'Editar ' . $module->name,
                  'slug'        => $slugEdit,
                  'description' => 'Pode Editar ' . $module->name,
                  'model'       => '',
                  'module_id'   => $module->id,
              ]);
          }

          if (Permission::where('slug', '=', $slugDelete)->first() === null) {
              Permission::create([
                  'name'        => 'Deletar ' . $module->name,
                  'slug'        => $slugDelete,
                  'description' => 'Pode Deletar ' . $module->name,
                  'model'       => '',
                  'module_id'   => $module->id,
              ]);
          }

        }

    }
}
