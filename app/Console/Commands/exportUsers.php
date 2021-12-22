<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class exportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:users';

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
        $exportFile = storage_path().'/export.csv';
        $users = User::all();

        if (file_exists($exportFile)) unlink($exportFile);

        foreach ($users as $user) {
            file_put_contents(
                $exportFile,
                $user->name . "\t" . $user->email . "\t" . $user->role . "\n",
                FILE_APPEND
            );
        }
    }
}
