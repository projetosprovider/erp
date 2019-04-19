<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.defaultUserModel')::where('email', '=', 'admin@admin.com')->first() === null) {
            $newUser = config('roles.defaultUserModel')::create([
                'name'     => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.defaultUserModel')::where('email', '=', 'user@user.com')->first() === null) {
            $newUser = config('roles.defaultUserModel')::create([
                'name'     => 'User',
                'email'    => 'user@user.com',
                'password' => bcrypt('password'),
            ]);

            $newUser;
            $newUser->attachRole($userRole);
        }

        /*
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
        weslley.lucio@provider-es.com.br
        */
    }
}
