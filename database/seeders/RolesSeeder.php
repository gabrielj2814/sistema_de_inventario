<?php

namespace Database\Seeders;

use App\Repository\RoleRespository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     function __construct(
        protected RoleRespository $roleRespository
     ){}


    public function run(): void
    {
        //

        $roles=[
            // "Administrator",
            "Web-Master",
            "Web-Super-Admin",
            "Web-Team-default-Member",
            // cliente
            "Customer",
            "Customer-Premium",
            "Employee",
            "Employee-administrador",
        ];

        foreach($roles as $role){
            if(!$this->roleRespository->consultRoleForName($role)){
                $this->roleRespository->registrar(["name"=>$role]);
            }
        }


    }
}
