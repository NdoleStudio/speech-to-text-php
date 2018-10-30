<?php

namespace App\Jobs;

use App\Events\AudioTranscribed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTranscribedText implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $transcribedText;

    /**
     * @var string
     */
    private $oldFilename;

    /**
     * Create a new job instance.
     *
     * @param array  $transcribedText
     * @param string $oldFilename
     */
    public function __construct(array $transcribedText, string $oldFilename)
    {
        $this->transcribedText = $transcribedText;
        $this->oldFilename = $oldFilename;
    }

    /**
     * Execute the job.
     *
     * @param Dispatcher $eventDispatcher
     */
    public function handle(Dispatcher $eventDispatcher)
    {
        $eventDispatcher->dispatch(new AudioTranscribed($this->oldFilename, $this->transcribedText));
    }
}
