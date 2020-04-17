<?php

namespace App\Jobs;

use App\Lot;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class FinishLotJob implements ShouldQueue
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
        $isTrue = true;
        while ($isTrue) {
            Lot::finish();
            sleep(10); // если в таблице jobs больше одной задачи, цикл заканчивается.
            if (count(DB::select('select * from jobs')) > 1) $isTrue = false;
        }
    }
}
