<?php

use Illuminate\Database\Seeder;
use App\Models\Frequency;

class FrequencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $frequency = new Frequency();
          $frequency->id = 1;
          $frequency->name = 'Exporadicamente';
          $frequency->save();

          $frequency = new Frequency();
          $frequency->id = 2;
          $frequency->name = 'Diariamente';
          $frequency->save();

          $frequency = new Frequency();
          $frequency->id = 3;
          $frequency->name = 'Semanalmente';
          $frequency->save();

          $frequency = new Frequency();
          $frequency->id = 4;
          $frequency->name = 'Mensalmente';
          $frequency->save();
    }
}
