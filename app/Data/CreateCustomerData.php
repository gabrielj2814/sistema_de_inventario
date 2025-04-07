<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CreateCustomerData extends Data{
    public function __construct(
        public string $name,
        public string $last_name,
        public string $email,
        public string $password,
        public string $name_company,
        public string $phone_company,
        public string $email_company,
        public string $address_company,
    ) {
    }

}


?>
