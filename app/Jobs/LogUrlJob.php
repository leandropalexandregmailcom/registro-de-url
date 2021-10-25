<?php

namespace App\Jobs;

use Exception;
use App\Models\UrlModel;
use App\Models\LogUrlModel;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class LogUrlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach(UrlModel::get() as $url)
        {
            try{

                $data = Http::get("$url->url");

                LogUrlModel::create(["id_url" => $url->id_url,
                    "data"          => mb_substr($data->__toString(), 0, 5000),
                    "status_code"   => $data->status(),
                    "date"          => $data->header('Date')
                ]);

            }catch(Exception $e)
            {
                continue;
            }

        }
    }
}
