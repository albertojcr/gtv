<?php

namespace App\Jobs;

use App\Models\VideoItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVideoItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 3;

    protected $videoItem;

    public function __construct(VideoItem $videoItem)
    {
        $this->videoItem = $videoItem;
    }

    public function handle()
    {
        //
    }
}
