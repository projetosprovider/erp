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
            'name' => 'Cargo A',
            'department_id' => 1,
          ],
          [
            'name' => 'Cargo B',
            'department_id' => 1,
          ],
          [
            'name' => 'Cargo C',
            'department_id' => 2,
          ],
          [
            'name' => 'Cargo D',
            'department_id' => 3,
          ],
          [
            'name' => 'Entregador',
            'department_id' => 5,
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
