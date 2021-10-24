<?php

namespace App\Jobs;

use App\Models\LogUrlModel;
use App\Models\UrlModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

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
            $data = Http::get("$url->url");

            LogUrlModel::create(["id_url" => $url->id_url,
                "data"          => mb_substr($data->__toString(), 0, 7000),
                "status_code"   => $data->status(),
                "date"          => $data->header('Date')
            ]);
        }
    }
}
