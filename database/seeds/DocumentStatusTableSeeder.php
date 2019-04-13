<?php

use Illuminate\Database\Seeder;
use App\Models\Documents\Status;

class DocumentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = ['Pendente', 'Ordem Entrega Gerada', 'Com o Entregador', 'Em Transito', 'Entregue', 'Cancelado', 'Danificado', 'Recusado'];

        foreach ($itens as $key => $item) {
            Status::create(['name' => $item]);
        }
    }
}
