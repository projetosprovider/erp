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

            ]);

            //$user->profile()->save($profile);
            $user->attachRole($adminRole);

            if($adminRole->id == 1) {
                $user->syncPermissions($permissions);
            }

            $user->save();
        }

        $users = "
            adinuza.lopes@provider-es.com.br,
            administrativo.gerencia@provider-es.com.br,
            administrativo3@provider-es.com.br,
            administrativo@provider-es.com.br,
            aeliton.silva@provider-es.com.br,
            aigline.pereira@provider-es.com.br,
            alice.campos@provider-es.com.br,
            aliny@provider-es.com.br,
            anacarolina@provider-es.com.br,
            andre.tavares@provider-es.com.br,
            ariane.pina@provider-es.com.br,
            arquivo@provider-es.com.br,
            atendimento01@provider-es.com.br,
            atendimento02@provider-es.com.br,
            atendimento03@provider-es.com.br,
            atendimento@provider-es.com.br,
            atendimentocariacica@provider-es.com.br,
            atendimentoserra@provider-es.com.br,
            atendimentovilavelha2@provider-es.com.br,
            autoglass@provider-es.com.br,
            bianca.kaiser@provider-es.com.br,
            carina@provider-es.com.br,
            carlos@provider-es.com.br,
            cesar.sousa@provider-es.com.br,
            cintia.souza@provider-es.com.br,
            coletacariacica@provider-es.com.br,
            coletaserra@provider-es.com.br,
            coletavilavelha2@provider-es.com.br,
            coletavitoria@provider-es.com.br,
            comercial01@provider-es.com.br,
            comercial02@provider-es.com.br,
            coordenacaosms@provider-es.com.br,
            credenciamento01@provider-es.com.br,
            credenciamento02@provider-es.com.br,
            credenciamento03@provider-es.com.br,
            credenciamento04@provider-es.com.br,
            creuza.ribeiro@provider-es.com.br,
            cristinete.silva@provider-es.com.br,
            cyntia.celante@provider-es.com.br,
            daniel.freitas@provider-es.com.br,
            daniele@provider-es.com.br,
            denise.pereira@provider-es.com.br,
            deyvd@provider-es.com.br,
            diegosouza@provider-es.com.br,
            diretoria@provider-es.com.br,
            dpessoal@provider-es.com.br,
            ely.reis@provider-es.com.br,
            emerson.pereira@provider-es.com.br,
            enfermagem.autoglass@provider-es.com.br,
            enfermagem@provider-es.com.br,
            enfermagemdotrabalho@provider-es.com.br,
            erli.junior@provider-es.com.br,
            exames@provider-es.com.br,
            expedicao01@provider-es.com.br,
            expedicao02@provider-es.com.br,
            faturamento.ti@provider-es.com.br,
            faturamento@provider-es.com.br,
            fellipe.freitas@provider-es.com.br,
            fernanda.costalonga@provider-es.com.br,
            fernando.rodrigues@provider-es.com.br,
            financeiro@provider-es.com.br,
            flavia@provider-es.com.br,
            fono1@provider-es.com.br,
            george.silva@provider-es.com.br,
            geovani@provider-es.com.br,
            germana.rodrigues@provider-es.com.br,
            gestaocontratos@provider-es.com.br,
            gizelle.rodrigues@provider-es.com.br,
            gleice@provider-es.com.br,
            gustavo.vieira@provider-es.com.br,
            igor.rocha@provider-es.com.br,
            itamar.nicolini@provider-es.com.br,
            izabel@provider-es.com.br,
            jelia.santos@provider-es.com.br,
            jessica.nogueira@provider-es.com.br,
            jorge.oliveira@provider-es.com.br,
            jose.menon@provider-es.com.br,
            joseth@provider-es.com.br,
            jovem.aprendiz@provider-es.com.br,
            karina.barteli@provider-es.com.br,
            karoline.alves@provider-es.com.br,
            katsciane.rodrigues@provider-es.com.br,
            laboratorio@provider-es.com.br,
            leonardo.araujo@provider-es.com.br,
            liberacao01@provider-es.com.br,
            liberacao02@provider-es.com.br,
            liberacao03@provider-es.com.br,
            liberacao04@provider-es.com.br,
            liberacao05@provider-es.com.br,
            liberacao06@provider-es.com.br,
            luana.melo@provider-es.com.br,
            lucas.santos@provider-es.com.br,
            luciana.rocha@provider-es.com.br,
            luiz.souza@provider-es.com.br,
            marianacoelho@provider-es.com.br,
            marketing@provider-es.com.br,
            mauriciodallorto@provider-es.com.br,
            mayko.bernard@provider-es.com.br,
            nadine.lodi@provider-es.com.br,
            paola.neves@provider-es.com.br,
            paula.albertino@provider-es.com.br,
            paulo.vinicius@provider-es.com.br,
            pericias@provider-es.com.br,
            processos@provider-es.com.br,
            psicologia01@provider-es.com.br,
            psicologia02@provider-es.com.br,
            rebeca@provider-es.com.br,
            renan@provider-es.com.br,
            renato.benedito@provider-es.com.br,
            rh@provider-es.com.br,
            roberto.melo@provider-es.com.br,
            rodrigo.alcides@provider-es.com.br,
            sabrina.vieira@provider-es.com.br,
            samuel.medeiros@provider-es.com.br,
            simone.coelho@provider-es.com.br,
            solange.jesus@provider-es.com.br,
            suelem.vitor@provider-es.com.br,
            suporteti@provider-es.com.br,
            suzanne.paula@provider-es.com.br,
            tecnico10@provider-es.com.br,
            tecnico11@provider-es.com.br,
            tecnico12@provider-es.com.br,
            tecnico14@provider-es.com.br,
            tecnico19@provider-es.com.br,
            tecnico20@provider-es.com.br,
            tecnico21@provider-es.com.br,
            tecnico22@provider-es.com.br,
            tecnico27@provider-es.com.br,
            tecnico28@provider-es.com.br,
            tecnico29@provider-es.com.br,
            tecnico2@provider-es.com.br,
            tecnico30@provider-es.com.br,
            tecnico4@provider-es.com.br,
            tecnico5@provider-es.com.br,
            telefonista@provider-es.com.br,
            treinamentos@provider-es.com.br,
            umap02@provider-es.com.br,
            vinycius.alves@provider-es.com.br,
            vivianeamorim@provider-es.com.br,
            vivyane.oliveira@provider-es.com.br,
            wesley.damasio@provider-es.com.br,
            weslley.lucio@provider-es.com.br";

        $users = explode(',', $users);

        foreach ($users as $key => $userEmail) {

          $faker = Faker\Factory::create();

          $userMail = User::where('email', '=', trim($userEmail))->first();
          if ($userMail === null) {

              $uName = str_replace(['@provider-es.com.br', '.'], ['', ' '], trim($userEmail));
              $login= str_replace(['@provider-es.com.br', ' '], ['', '.'], trim($userEmail));
              $uName = ucwords($uName);

              $name = $uName;

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

              ]);

              //$user->profile()->save(new Profile());
              $user->attachRole($adminRole);
              $user->save();
          }
          // code...
        }

    }
}
