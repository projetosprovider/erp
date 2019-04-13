<?php

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [
          [
            'name' => 'Módulos',
            'slug' => str_slug('Modulos'),
            'description' => 'Módulos',
            'parent' => null,
          ],
          [
            'name' => 'Painel Principal',
            'slug' => str_slug('Painel Principal'),
            'description' => 'Painel Principal',
            'parent' => str_slug('Modulos'),
          ],
          [
            'name' => 'Gestão de Entregas',
            'slug' => str_slug('Gestao de Entregas'),
            'description' => 'Gestão de Entregas',
            'parent' => str_slug('Modulos'),
          ],
          [
            'name' => 'Gestão de Processos',
            'slug' => str_slug('Gestao de Processos'),
            'description' => 'Gestão de Processos',
            'parent' => str_slug('Modulos'),
          ],
          [
            'name' => 'Treinamentos',
            'slug' => str_slug('Gestao de Treinamentos'),
            'description' => 'Gestão de Treinamentos',
            'parent' => str_slug('Modulos'),
          ],
          [
            'name' => 'Mural de Recados',
            'slug' => str_slug('Mural de Recados'),
            'description' => 'Mural de Recados',
            'parent' => str_slug('Modulos'),
          ],
          [
            'name' => 'Administrativo',
            'slug' => str_slug('Administrativo'),
            'description' => 'Administrativo',
            'parent' => str_slug('Modulos'),
          ],
          [
            'name' => 'Clientes',
            'slug' => str_slug('Clientes'),
            'description' => 'Clientes',
            'parent' => str_slug('Modulos'),
          ],
          [
            'name' => 'Cliente Endereços',
            'slug' => str_slug('Enderecos'),
            'description' => 'Cliente Enderecos',
            'parent' => str_slug('Clientes'),
          ],

          [
            'name' => 'Documentos',
            'slug' => str_slug('Documentos'),
            'description' => 'Documentos',
            'parent' => str_slug('Gestao de Entregas'),
          ],
          [
            'name' => 'Ordem Entrega',
            'slug' => str_slug('Ordem Entrega'),
            'description' => 'Ordem Entrega',
            'parent' => str_slug('Gestao de Entregas'),
          ],

          [
            'name' => 'Board',
            'slug' => str_slug('Board'),
            'description' => 'Board',
            'parent' => str_slug('Gestao de Processos'),
          ],
          [
            'name' => 'Mapeamentos',
            'slug' => str_slug('Mapeamentos'),
            'description' => 'Mapeamentos',
            'parent' => str_slug('Gestao de Processos'),
          ],
          [
            'name' => 'Processos',
            'slug' => str_slug('Processos'),
            'description' => 'Processos',
            'parent' => str_slug('Gestao de Processos'),
          ],
          [
            'name' => 'Tarefas',
            'slug' => str_slug('Tarefas'),
            'description' => 'Tarefas',
            'parent' => str_slug('Gestao de Processos'),
          ],

          [
            'name' => 'Cursos',
            'slug' => str_slug('Cursos'),
            'description' => 'Cursos',
            'parent' => str_slug('Gestao de Treinamentos'),
          ],
          [
            'name' => 'Alunos',
            'slug' => str_slug('Alunos'),
            'description' => 'Alunos',
            'parent' => str_slug('Gestao de Treinamentos'),
          ],

          [
            'name' => 'Turmas',
            'slug' => str_slug('Turmas'),
            'description' => 'Turmas',
            'parent' => str_slug('Gestao de Treinamentos'),
          ],
          [
            'name' => 'Agenda',
            'slug' => str_slug('Agenda'),
            'description' => 'Agenda',
            'parent' => str_slug('Gestao de Treinamentos'),
          ],


          [
            'name' => 'Mural',
            'slug' => str_slug('Mural'),
            'description' => 'Mural',
            'parent' => str_slug('Mural de Recados'),
          ],

          [
            'name' => 'Tipos de Recados',
            'slug' => str_slug('Tipos de Recados'),
            'description' => 'Tipos de Recados',
            'parent' => str_slug('Mural de Recados'),
          ],

          [
            'name' => 'Departamentos',
            'slug' => str_slug('Departamentos'),
            'description' => 'Departamentos',
            'parent' => str_slug('Administrativo'),
          ],
          [
            'name' => 'Cargos',
            'slug' => str_slug('Cargos'),
            'description' => 'Cargos',
            'parent' => str_slug('Administrativo'),
          ],
          [
            'name' => 'Usuarios',
            'slug' => str_slug('Usuarios'),
            'description' => 'Usuarios',
            'parent' => str_slug('Administrativo'),
          ],

          [
            'name' => 'Privilégios',
            'slug' => str_slug('Privilegios'),
            'description' => 'Privilégios',
            'parent' => str_slug('Administrativo'),
          ],

          [
            'name' => 'Permissões',
            'slug' => str_slug('Permissoes'),
            'description' => 'Permissões',
            'parent' => str_slug('Administrativo'),
          ],

          [
            'name' => 'Calendário',
            'slug' => str_slug('Calendario'),
            'description' => 'Calendário',
            'parent' => str_slug('Modulos'),
          ],
        ];

        foreach ($itens as $key => $value) {

            if($value['parent']) {
                $module = Module::where('slug', $value['parent'])->get()->first();
                $value['parent'] = $module->id;
            }

            Module::create($value);
        }
    }
}
