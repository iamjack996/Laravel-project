<?php

namespace App\Console\Commands;

use Carbon\carbon;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Storage;
use Session;
use Illuminate\Http\Request;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';  //php artisan backup:database

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take a backup of the entire DB and upload to Local.';

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
        $date = Carbon::now()->format('Y-m-d_h-i');
        // \Log::info($data);
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $host = env('DB_HOST');
        $command = "mysqldump --user={$user} -p{$password} {$database} > backupsql.sql";  //{$date}.sql
        // $command = "mysqldump -h {$host} -u {$user} -p {$password}{$database} > {$date}.sql";
        // $command = "mysqldump -u admin --password={$password} database-{$database} | gzip -7 > bak-sql.zip";
        // $command = "mysqldump --host={$host} --user={$user} --password={$password} --databases {$database} > {$date}.sql";
        $process = new Process($command);
        $process->start();

        // $sqlname = "{$date}.sql";
        $sqlname = "backupsql";

        while($process->isRunning()){
          Storage::disk('local')->put($sqlname.'.sql',file_get_contents($sqlname.'.sql'));
          // $s3 = Storage::disk('s3');
          // $s3->put('gallery-app-db/' . $date . ".sql", file_get_contents("{$date}.sql"));
          // unlink("{$data}.sql");
        }
    }
}
