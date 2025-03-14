<?php

namespace Database\Seeders;

use App\Repository\CompanyRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{

    public function __construct(
        protected CompanyRepository $companyRepository
    ){}


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $companies=[
            [
                "name" => "kadokawa",
                "email" => "kadokawa@gmail.com",
                "phone" => "11111111111",
                "address" => "dirección",
            ],
            [
                "name" => "ufotable",
                "email" => "ufotable@gmail.com",
                "phone" => "22222222222",
                "address" => "dirección",
            ],
            [
                "name" => "wit",
                "email" => "wit@gmail.com",
                "phone" => "33333333333",
                "address" => "dirección",
            ],
            [
                "name" => "hoyoverse",
                "email" => "hoyoverse@gmail.com",
                "phone" => "44444444444",
                "address" => "dirección",
            ],
        ];

        foreach ($companies as $key => $company) {
            $this->companyRepository->registrar($company);
        }

    }
}
