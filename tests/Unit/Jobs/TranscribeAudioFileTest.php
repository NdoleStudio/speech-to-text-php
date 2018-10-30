<?php

namespace Tests\Unit\Jobs;

use App\Configurations\IbmWatsonConfiguration;
use App\Jobs\ProcessTranscribedText;
use App\Jobs\TranscribeAudioFile;
use GuzzleHttp\Client;
use Illuminate\Bus\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Response;
use PHPUnit_Framework_MockObject_MockObject;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Tests\TestCase;
use Tests\Traits\InteractsWithIbmWatsonApi;

class TranscribeAudioFileTest extends TestCase
{
    use InteractsWithIbmWatsonApi;

    /**
     * @var string
     */
    private $oldFilename = 'filename.mp3';

    /**
     * @var string
     */
    private $newFilename = 'new_filename.flac';

    /**
     * @var IbmWatsonConfiguration|PHPUnit_Framework_MockObject_MockObject
     */
    private $ibmWatsonConfiguration;

    /**
     * @var Client|PHPUnit_Framework_MockObject_MockObject
     */
    private $httpClient;

    /**
     * @var FilesystemManager|PHPUnit_Framework_MockObject_MockObject
     */
    private $fileSystemManager;

    /**
     * @var Filesystem|PHPUnit_Framework_MockObject_MockObject
     */
    private $filesystem;

    /**
     * @var Dispatcher|PHPUnit_Framework_MockObject_MockObject
     */
    private $commandDispatcher;

    /**
     * @var StreamInterface
     */
    private $streamInterface;

    /**
     * @var Response
     */
    private $httpMessage;

    /**
     * @var TranscribeAudioFile
     */
    private $SUT;

    protected function setUp()
    {
        parent::setUp();

        $this->filesystem = $this->getMockForConcreteClass(Filesystem::class);

        $this->streamInterface = $this->getMockForConcreteClass(StreamInterface::class);
        $this->streamInterface
            ->method($this->methodName([$this->streamInterface, 'getContents']))
            ->willReturn($this->getDummyApiResponse());

        $this->httpMessage = $this->getMockForConcreteClass(MessageInterface::class);
        $this->httpMessage
            ->method($this->methodName([$this->httpMessage, 'getBody']))
            ->willReturn($this->streamInterface);

        $this->ibmWatsonConfiguration = $this->getMockForConcreteClass(IbmWatsonConfiguration::class);

        $this->httpClient = $this->getMockForConcreteClass(Client::class);

        $this->fileSystemManager = $this->getMockForConcreteClass(FilesystemManager::class);
        $this->fileSystemManager
            ->method($this->methodName([$this->fileSystemManager, 'disk']))
            ->willReturn($this->filesystem);

        $this->commandDispatcher = $this->getMockForConcreteClass(Dispatcher::class);

        $this->SUT = new TranscribeAudioFile($this->oldFilename, $this->newFilename);
    }

    public function test_that_the_command_transcribes_a_file_using_the_ibm_watson_configuration()
    {
        $this->httpClient
            ->expects($this->once())
            ->method($this->methodName([$this->httpClient, 'request']))
            ->willReturn($this->httpMessage);

        $this->SUT->handle(
            $this->ibmWatsonConfiguration,
            $this->httpClient,
            $this->fileSystemManager,
            $this->commandDispatcher
        );
    }

    public function test_that_the_command_calls_the_process_transcribed_text_command_with_the_correct_output()
    {
        $this->httpClient
            ->method($this->methodName([$this->httpClient, 'request']))
            ->willReturn($this->httpMessage);

        $this->commandDispatcher
            ->expects($this->once())
            ->method($this->methodName([$this->commandDispatcher, 'dispatch']))
            ->with(new ProcessTranscribedText($this->getDummyTranscribedTextFromApiResponse(), $this->oldFilename));

        $this->SUT->handle(
            $this->ibmWatsonConfiguration,
            $this->httpClient,
            $this->fileSystemManager,
            $this->commandDispatcher
        );
    }
}
