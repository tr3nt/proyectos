<?php

namespace App\Jobs;

use App\Mail\ProjectUpdated;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * params
     */
    private $title;
    private $public;

    /**
     * Create a new job instance.
     */
    public function __construct($title, $public)
    {
        $this->title = $title;
        $this->public = $public;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to('esaim.najera@gmail.com')
            ->send(new ProjectUpdated($this->title, $this->public));
    }
}
