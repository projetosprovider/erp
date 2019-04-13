<?php

use Illuminate\Database\Seeder;

class TaskStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_status')->insert(
            [
                'name' => 'Pendente'
            ]
        );

        DB::table('task_status')->insert(
            [
                'name' => 'Em Andamento'
            ]
        );

        DB::table('task_status')->insert(
            [
                'name' => 'Finalizado'
            ]
        );

        DB::table('task_status')->insert(
            [
                'name' => 'Cancelado'
            ]
        );
    }
}
