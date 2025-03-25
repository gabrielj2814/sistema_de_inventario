<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DataDBCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:inicializar-data-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info("Registrando Roles");
        Artisan::call("db:seed --class=RolesSeeder");

        $this->info("Registrando Usuario Root");
        Artisan::call("db:seed --class=UserRootSeeder");

        $this->info("Registrando Companies");
        Artisan::call("db:seed --class=CompanySeeder");

        return Command::SUCCESS;
    }
}
