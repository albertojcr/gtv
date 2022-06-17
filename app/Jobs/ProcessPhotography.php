<?php

namespace App\Jobs;

use App\Models\Photography;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPhotography implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 3;

    protected $photography;

    public function __construct(Photography $photography)
    {
        $this->photography = $photography;
    }

    public function handle()
    {
        //
    }
}
