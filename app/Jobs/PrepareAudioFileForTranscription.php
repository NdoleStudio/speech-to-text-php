<?php

namespace App\Jobs;

use App\Traits\InteractsWithLocalFileSystem;
use Illuminate\Bus\Dispatcher;
use Illuminate\Bus\Queueable;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use mikehaertl\shellcommand\Command;

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
     * @param Command $shellCommand
     * @param FilesystemManager $filesystemManager
     */
    public function handle(Dispatcher $commandDispatcher, Command $shellCommand, FilesystemManager $filesystemManager)
    {
        $newFilename = $this->convertAudioFileToCorrectFormat($filesystemManager, $shellCommand);

        $commandDispatcher->dispatch(new TranscribeAudioFile($this->fileName, $newFilename));
    }


    /**
     * @param FilesystemManager $filesystemManager
     * @param Command $shellCommand
     *
     * @return string
     */
    public function convertAudioFileToCorrectFormat(FilesystemManager $filesystemManager, Command $shellCommand): string
    {
        $filePath = $this->getFilePath($this->fileName);
        $newFileName = 'new_' . pathinfo($this->fileName, PATHINFO_FILENAME) . '.flac';
        $newFilePath = $this->getFilePath($newFileName);

        if(!$filesystemManager->exists($newFilePath)) {
            $shellCommand->setCommand('ffmpeg')
                ->addArg('-i', $filePath)
                ->addArg('-ac', 1, false)
                ->addArg('-ar', 16000, false)
                ->addArg(   "'{$newFilePath}'")
                ->execute();

            Log::info($shellCommand->getExecCommand());
            
        }

        return $newFileName;

    }
}
