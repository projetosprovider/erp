<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = ['Departamento Contábil', 'Departamento Pessoal', 'Financeiro', 'Expedição', 'Tecnologia da Informação', 'Arquivo', 'Treinamentos', 'Operacional', 'Diretoria'];

        foreach ($itens as $item) {
            $departamento = new Department();
            $departamento->name = $item;
            $departamento->user_id = 1;
            $departamento->Save();
        }
    }
}
