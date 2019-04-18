<?php

use Illuminate\Database\Seeder;
use App\Models\Documents\Type;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
          [
            'name' => 'Admissional',
            'price' => 6.00,
          ],
          [
            'name' => 'Periódico',
            'price' => 5.00,
          ],
          [
            'name' => 'Demissional',
            'price' => 10.00,
          ],
          [
            'name' => 'Nota Fiscal',
            'price' => 0.00,
          ],
          [
            'name' => 'Outros',
            'price' => 1.00,
          ],
        ];

        foreach ($list as $item) {
            Type::create([
              'name' => $item['name'],
              'price' => $item['price'],
            ]);
        }
    }
}
