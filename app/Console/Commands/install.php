<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        if(substr(PHP_VERSION, 0,3) < 7.2){
            $this->warn("php version is less than 7.2");
            if ($this->confirm('Do you want to continue? [y|N]')== false) {
                exit;
            }
        }
        exec('npm -v', $foo, $exitCode);

        if ($exitCode !== 0) {
            $this->warn("Error: NPM is not installed, please install it, if you want to modify the vuejs component");
        }

        $this->line( "install 'Onboarding flow' application:");
        $this->info(' Source of data:'. getenv("DATA_DRIVER"));
        $this->line( "You can change the source of data in the .env file, the valid values are 'csv' and 'database' ");

        // check database exist
        if(getenv("DATA_DRIVER")== DATABASE_SOURCE){
            if(!$this->checkDBConnection()){
                $this->error("Error: db is not connected, please check the setting in .env file");
                exit;
            }

            //migration
            Artisan::call('migrate');
            $this->info('migration was done');
            if ($this->confirm('Would you like to insert some fake data in db? [y|N]')) {
               //seeding
               Artisan::call('db:seed --class=MemberTableSeeder');
                $this->info('the fake data was inserted');
            }
        }

       // exec('npm  install');

       // $this->info("installing node_modules:");

        $this->info("Laravel development is accessible on port 8080:");
        Artisan::call('serve --port=8080');
        $this->line(Artisan::output());
        $this->info("Onboarding application installed successfully. server : 127.0.0.1:8080");
    }


    private function checkDBConnection(){
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {

           return false;
        }
        return true;
    }
}
