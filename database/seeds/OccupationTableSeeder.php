<?php

use Illuminate\Database\Seeder;
use App\Models\Department\Occupation;

class OccupationTableSeeder extends Seeder
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
            'name' => 'Assistente Administrativo',
            'department_id' => 1,
          ],
          [
            'name' => 'Coordenador',
            'department_id' => 1,
          ],
          [
            'name' => 'Coordenador',
            'department_id' => 2,
          ],
          [
            'name' => 'Estagiário',
            'department_id' => 3,
          ],
          [
            'name' => 'Entregador',
            'department_id' => 4,
          ],
          [
            'name' => 'Assistente de Sistemas',
            'department_id' => 5,
          ],
          [
            'name' => 'Suporte SOC',
            'department_id' => 5,
          ],
          [
            'name' => 'Coordenador',
            'department_id' => 5,
          ],
          [
            'name' => 'Instrutor',
            'department_id' => 7,
          ]
        ];

        foreach ($itens as $key => $item) {
            Occupation::create([
              'name' => $item['name'],
              'department_id' => $item['department_id'],
            ]);
        }

    }
}
