<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\Models\Client', 50)
        ->create()
        ->each(function ($client) {
            $client->addresses()->save(factory(App\Models\Client\Address::class)->make());
            $client->employees()->save(factory(App\Models\Client\Employee::class)->make());
            $client->employees()->save(factory(App\Models\Client\Employee::class)->make());
            $client->employees()->save(factory(App\Models\Client\Employee::class)->make());
        });;
    }
}
