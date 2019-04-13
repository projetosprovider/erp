<?php

use Illuminate\Database\Seeder;
use App\Models\MapperStatus;

class MapperStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = ['Pendente', 'Em Andamento', 'Cancelado', 'Finalizado'];

        foreach($itens as  $item) {
            $status = new MapperStatus();
            $status->name = $item;
            $status->save();
        }
    }
}
