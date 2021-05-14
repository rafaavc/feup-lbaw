<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Exception;

class recipesFTSRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recipesFTS:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updated recipes_fts_view.';

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
     * @return int
     */
    public function handle()
    {
        try {
            DB::statement('REFRESH MATERIALIZED VIEW recipes_fts_view');
        } catch(Exception $e) {
            exit($e);
        }
        /*$schedule->call(function () {
            DB::raw('REFRESH MATERIALIZED VIEW recipes_fts_view');
        })
            ->timezone('Europe/Portugal')
            ->everyMinute();*/
    }
}
