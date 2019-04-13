<?php

use Illuminate\Database\Seeder;
use App\Models\DeliveryOrder\Status;

class DeliveryOrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = ['Pendente', 'Em Transito', 'Entregue', 'Cancelada', 'Documento Perdido', 'Documento Danificado', 'Tentar denovo', 'Entrega Recusada'];

        foreach ($itens as $key => $item) {
            Status::create(['name' => $item]);
        }
    }
}
