<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CreatCompanyData extends Data{


    function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $address,
    ){}


}




?>
