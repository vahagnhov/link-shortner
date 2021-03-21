<?php

namespace App\Jobs;

use App\Models\ShortenLink;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class IncrementVisitsCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $code;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 30;
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 20;

    /**
     * Create a new job instance.
     *
     * @param $code
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ShortenLink::where('code', $this->code)
            ->update([
                'visits' => DB::raw('visits+1'),
            ]);
    }
}
