<?php

use Illuminate\Database\Seeder;
use App\Models\MessageBoard\Type;

class MessageTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = ['Anúncio', 'Férias', 'Desligamento', 'Outros'];

        foreach ($list as $item) {
            Type::create(['name' => $item]);
        }
    }
}
