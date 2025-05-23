<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{

    use SoftDeletes;

    const STATUS_PENDIENTE="Pendiente";
    const STATUS_APROBADO="Aprobado";
    const STATUS_RECHAZADO="Rechazado";
}
