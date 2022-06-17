<?php

namespace App\Jobs;

use App\Models\ThematicArea;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessThematicArea implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 3;

    protected $thematicArea;

    public function __construct(ThematicArea $thematicArea)
    {
        $this->thematicArea = $thematicArea;
    }

    public function handle()
    {
        //
    }
}
