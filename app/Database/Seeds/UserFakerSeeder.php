<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserFakerSeeder extends Seeder
{
    public function run()
    {
        
        $userModel = new \App\Models\UserModel();

        $faker = \Faker\Factory::create();
        $fakerPtBr = \Faker\Factory::create('pt_BR');;

        $qntUsers = 1000;
        $usersPush = [];



        for($i = 0; $i < $qntUsers; $i++){
            array_push($usersPush, [
                'name' => $faker->unique()->name,
                'email' => $faker->unique()->email,
                'phoneNumber' => $fakerPtBr->landlineNumber(false),
                'password_hash' => '123456',
                'active' => $faker->numberBetween(0, 1),
            ]);
        }

        // echo '<pre>';
        // print_r($usersPush);
        // exit;

        $userModel->skipValidation(true)
                  ->protect(false)
                  ->insertBatch($usersPush);

        echo "$qntUsers usuários semeados com sucessos!";
    }
}
