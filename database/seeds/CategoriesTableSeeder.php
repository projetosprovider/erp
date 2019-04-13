<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = ['Documentos','Social','Anúncios','Eventos','Cliente'];

        foreach ($itens as $key => $item) {
            Category::create(['name' => $item]);
        }
    }
}
