<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UpdateAdminData extends Data{


    function __construct(
        public int $id,
        public string $name,
        public string $last_name
    ){}

}


?>
