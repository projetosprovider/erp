<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ConfigurationsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TaskStatusTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(OccupationTableSeeder::class);
        // Role comes before User seeder here.
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);

        $this->call(FrequencyTableSeeder::class);
        $this->call(DocumentStatusTableSeeder::class);

        $this->call(DeliveryOrderStatusesTableSeeder::class);

        $this->call(MapperStatusTableSeeder::class);
        $this->call(ClientsTableSeeder::class);

        $this->call(MessageTypesTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);

        Model::reguard();
    }
}
