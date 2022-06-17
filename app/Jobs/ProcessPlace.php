<?php

namespace App\Jobs;

use App\Models\Place;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPlace implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 3;

    protected $place;

    public function __construct(Place $place)
    {
        $this->place = $place;
    }

    public function handle()
    {
        //
    }
}
