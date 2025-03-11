<?php

namespace Database\Seeders;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRootSeeder extends Seeder
{

    public function __construct(
        protected UserRepository $UserRepository,
    ){}
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $user=User::where("name","=","root")->get()->first();
        if(!$user){
            $datos=[
                "id" => "",
                "name" => "root",
                "email" => "root@gmail.com",
                "password" => env("DEBUG_PASSWORD_ADMIN")
            ];

            $rootDB=$this->UserRepository->registrar($datos);
            $datos["id"]=$rootDB->id;
            $this->UserRepository->actualizarClave($datos);
        }

    }
}
