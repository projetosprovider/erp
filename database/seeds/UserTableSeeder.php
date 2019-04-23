<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\People;

use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();
        $permissions = Permission::pluck('id');

        $faker = Faker\Factory::create();

        // Seed test admin
        $seededAdminEmail = 'cesar.sousa@provider-es.com.br';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {

            $name = 'Cesar Augusto Sousa';

            $avatar = \Avatar::create($name)->toBase64();

            $person = People::create([
              'name' => 'Cesar Sousa',
              'department_id'=> 1,
              'occupation_id'=> 1,
              'birthday' => $faker->dateTimeThisCentury->format('Y-m-d'),
              'cpf' => '12345678987'
            ]);

            $user = User::create([
              'nick'                           => 'cesar.sousa',
              'email'                          => $seededAdminEmail,
              'password'                       => Hash::make('123123'),
              'avatar' => $avatar,
              'do_task' => false,
              'person_id' => $person->id,
              'email_verified_at' => now(),
              'login_soc' => 'cesar.sousa',
              'password_soc' => 'cesar1507',
              'id_soc' => '6662',
              'api_token' => str_random(60)

            ]);

            //$user->api_token = $user->createToken('Provider')->accessToken;

            //$user->profile()->save($profile);
            $user->attachRole($adminRole);

            if($adminRole->id == 1) {
                $user->syncPermissions($permissions);
            }

            $user->save();
        }

        $users = "
            adinuza.lopes@provider-es.com.br,
            aeliton.silva@provider-es.com.br,
            andre.tavares@provider-es.com.br,
            vinycius.alves@provider-es.com.br, ";

        $users = explode(',', $users);

        foreach ($users as $key => $userEmail) {

          $faker = Faker\Factory::create();

          $userMail = User::where('email', '=', trim($userEmail))->first();
          if ($userMail === null) {

              $uName = str_replace(['@provider-es.com.br', '.'], ['', ' '], trim($userEmail));
              $login= str_replace(['@provider-es.com.br', ' '], ['', '.'], trim($userEmail));
              $uName = ucwords($uName);

              $name = $uName;

              echo 'creating user '. $name . PHP_EOL;

              $avatar = \Avatar::create($name)->toBase64();

              $person = People::create([
                'name' => $name,
                'birthday' => $faker->dateTimeThisCentury,
                'department_id'=> 1,
                'occupation_id'=> 1,
                'cpf' => $faker->postcode
              ]);

              $user = User::create([
                'nick'                           => str_slug($name),
                'email'                          => trim($userEmail),
                'password'                       => Hash::make('123123'),
                'avatar' => $avatar,
                'do_task' => true,
                'person_id' => $person->id,
                'email_verified_at' => now(),
                'login_soc' => $login,
                'password_soc' => $login,
                'id_soc' => '6662',
                'api_token' => str_random(60)

              ]);

              //$user->api_token = $user->createToken('Provider')->accessToken;

              //$user->profile()->save(new Profile());
              $user->attachRole($adminRole);

              if($adminRole->id == 1) {
                  $user->syncPermissions($permissions);
              }

              $user->save();
          }
          // code...
        }

    }
}
