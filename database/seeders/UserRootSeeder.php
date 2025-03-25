<?php

namespace Database\Seeders;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRootSeeder extends Seeder
{

    public function __construct(
        protected UserRepository $userRepository
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
                "last_name" => "uwu",
                "email" => "root@gmail.com",
                "password" => env("DEBUG_PASSWORD_ADMIN")
            ];

            $rootDB=$this->userRepository->registrar($datos);
            $rootDB->assignRole("Web-Master");
        }

    }
}
