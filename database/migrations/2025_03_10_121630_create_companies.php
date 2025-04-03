<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("name",255);
            $table->string("email",255)->unique();
            $table->string("phone",15)->unique();
            $table->string("address",255)->nullable();
            $table->enum("status",[
                Company::STATUS_PENDIENTE,
                Company::STATUS_APROBADO,
                Company::STATUS_RECHAZADO,
            ])->default(Company::STATUS_PENDIENTE);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
