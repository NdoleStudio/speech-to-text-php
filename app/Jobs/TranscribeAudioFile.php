<?php

namespace App\Jobs;

use App\Configurations\IbmWatsonConfiguration;
use App\Traits\InteractsWithLocalFileSystem;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Dispatcher;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class TranscribeAudioFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, InteractsWithLocalFileSystem;
    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $oldFilename;

    /**
     * Create a new job instance.
     *
     * @param string $oldFilename
     * @param string $filename
     */
    public function __construct(string $oldFilename, string $filename)
    {
        $this->filename = $filename;
        $this->oldFilename = $oldFilename;
    }

    /**
     * @param IbmWatsonConfiguration $ibmWatsonConfiguration
     * @param Client $httpClient
     * @param Dispatcher $commandDispatcher
     *
     * @throws GuzzleException
     */
    public function handle(
        IbmWatsonConfiguration $ibmWatsonConfiguration,
        Client $httpClient,
        Dispatcher $commandDispatcher
    ) {
        $response = $httpClient->request(
            'POST',
            'https://stream.watsonplatform.net/speech-to-text/api/v1/recognize',
            [
                'auth' => [$ibmWatsonConfiguration->getUsername(), $ibmWatsonConfiguration->getPassword()],
                'headers' => [
                    'Content-Type' => 'audio/flac',
                ],
                'body' => fopen($this->getFilePath($this->filename), 'r')
            ]
        );

        $jsonResult = json_decode(trim($response->getBody()->getContents()));

        $output = array_map(function ($result) {
            return ucfirst(str_replace('%HESITATION','...', $result->alternatives[0]->transcript));
        }, $jsonResult->results);

        $commandDispatcher->dispatch(new ProcessTranscribedText($output, $this->oldFilename));
    }
}
