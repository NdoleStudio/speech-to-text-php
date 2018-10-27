<?php

namespace App\Jobs;

use App\Traits\InteractsWithLocalFileSystem;
use Illuminate\Bus\Dispatcher;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PrepareAudioFileForTranscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, InteractsWithLocalFileSystem;

    /**
     * @var string
     */
    private $fileName;

    /**
     * Create a new job instance.
     *
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @param Dispatcher $commandDispatcher
     * @return void
     */
    public function handle(Dispatcher $commandDispatcher)
    {
        $newFilename = $this->convertAudioFileToCorrectFormat();

        $commandDispatcher->dispatch(new TranscribeAudioFile($this->fileName, $newFilename));
    }


    /**
     * @return string
     */
    public function convertAudioFileToCorrectFormat(): string
    {
        $filePath = $this->getFilePath($this->fileName);
        $newFileName = 'new_' . pathinfo($this->fileName, PATHINFO_FILENAME) . '.flac';
        $newFilePath = $this->getFilePath($newFileName);

        if(!file_exists($newFilePath)) {
            shell_exec('ffmpeg -i '
                . '"'
                . $filePath
                . '"'
                . ' -ac 1 -ar 16000 '
                . '"'
                . $newFilePath
                . '"'
                . ' > /dev/null 2>&1'
            );
        }

        return $newFileName;

    }
}
