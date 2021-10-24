<?php

namespace App\Console\Commands;

use App\Jobs\LogUrlJob;
use App\Models\UrlModel;
use Illuminate\Console\Command;
use App\Models\LogUrlModel;

class LogUrlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:logUrlCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instancia a LogUrlJob e executa o log da urln';

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
        LogUrlJob::dispatch(new LogUrlModel, UrlModel::get());
        return Command::SUCCESS;
    }
}
