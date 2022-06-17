<?php

namespace App\Jobs;

use App\Models\PointOfInterest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPointOfInterest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 3;

    protected $pointOfInterest;

    public function __construct(PointOfInterest $pointOfInterest)
    {
        $this->pointOfInterest = $pointOfInterest;
    }

    public function handle()
    {
        //
    }
}
