<?php

namespace Tests\Unit\Jobs;

use App\Jobs\PrepareAudioFileForTranscription;
use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use mikehaertl\shellcommand\Command;
use PHPUnit_Framework_MockObject_MockObject;
use Tests\TestCase;

class PrepareAudioFileForTranscriptionTest extends TestCase
{
    /**
     * @var string
     */
    private $filename = 'filename';

    /**
     * @var PrepareAudioFileForTranscription
     */
    private $SUT;

    /**
     * @var Dispatcher|PHPUnit_Framework_MockObject_MockObject
     */
    private $commandDispatcher;

    /**
     * @var Command|PHPUnit_Framework_MockObject_MockObject
     */
    private $shellCommand;

    /**
     * @var FilesystemManager|PHPUnit_Framework_MockObject_MockObject
     */
    private $fileSystemManager;

    /**
     * @var Filesystem|PHPUnit_Framework_MockObject_MockObject
     */
    private $fileSystem;

    protected function setUp()
    {
        parent::setUp();

        $this->fileSystem = $this->getMockForConcreteClass(Filesystem::class);

        $this->commandDispatcher = $this->getMockForConcreteClass(Dispatcher::class);

        $this->shellCommand = $this->getMockForConcreteClass(Command::class);

        $this->fileSystemManager = $this->getMockForConcreteClass(FilesystemManager::class);

        $this->fileSystemManager
            ->method($this->methodName([$this->fileSystemManager, 'disk']))
            ->willReturn($this->fileSystem);

        $this->shellCommand
            ->method($this->methodName([$this->shellCommand, 'addArg']))
            ->willReturnSelf();

        $this->SUT = new PrepareAudioFileForTranscription($this->filename);
    }

    public function test_that_the_command_converts_a_file_to_a_flac_file_using_ffmpeg()
    {
        $this->fileSystem
            ->method($this->methodName([$this->fileSystem, 'exists']))
            ->willReturn(false);

        $this->shellCommand
            ->expects($this->once())
            ->method($this->methodName([$this->shellCommand, 'setCommand']))
            ->with('ffmpeg')
            ->willReturnSelf();

        $this->shellCommand
            ->expects($this->once())
            ->method($this->methodName([$this->shellCommand, 'execute']))
            ->willReturn(true);

        $this->SUT->handle($this->commandDispatcher, $this->shellCommand, $this->fileSystemManager);
    }

    public function test_that_the_command_does_not_convert_a_file_if_the_file_has_already_been_Converted()
    {
        $this->fileSystem
            ->method($this->methodName([$this->fileSystem, 'exists']))
            ->willReturn(true);

        $this->shellCommand
            ->expects($this->never())
            ->method($this->methodName([$this->shellCommand, 'setCommand']))
            ->with('ffmpeg')
            ->willReturnSelf();

        $this->shellCommand
            ->expects($this->never())
            ->method($this->methodName([$this->shellCommand, 'execute']))
            ->willReturn(true);

        $this->SUT->handle($this->commandDispatcher, $this->shellCommand, $this->fileSystemManager);
    }

    public function test_that_the_command_dispatches_the_transcribe_audio_file_command()
    {
        $this->shellCommand
            ->method($this->methodName([$this->shellCommand, 'setCommand']))
            ->willReturnSelf();
        $this->shellCommand
            ->method($this->methodName([$this->shellCommand, 'addArg']))
            ->willReturnSelf();

        $this->commandDispatcher
            ->expects($this->once())
            ->method($this->methodName([$this->commandDispatcher, 'dispatch']));

        $this->SUT->handle($this->commandDispatcher, $this->shellCommand, $this->fileSystemManager);
    }
}
