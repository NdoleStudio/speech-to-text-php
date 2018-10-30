<?php

namespace Tests\Unit\Jobs;

use App\Events\AudioTranscribed;
use App\Jobs\ProcessTranscribedText;
use Illuminate\Events\Dispatcher;
use PHPUnit_Framework_MockObject_MockObject;
use Tests\TestCase;

class ProcessTranscribedTextTest extends TestCase
{
    /**
     * @var array
     */
    private $transcribedText = [
        'line 1',
        'line 2',
    ];

    /**
     * @var string
     */
    private $oldFileName = 'filename.mp3';

    /**
     * @var Dispatcher|PHPUnit_Framework_MockObject_MockObject
     */
    private $eventDispatcher;

    /**
     * @var ProcessTranscribedText
     */
    private $SUT;

    protected function setUp()
    {
        parent::setUp();

        $this->eventDispatcher = $this->getMockForConcreteClass(Dispatcher::class);

        $this->SUT = new ProcessTranscribedText($this->transcribedText, $this->oldFileName);
    }

    public function test_that_the_command_dispatches_the_audio_transcribed_event()
    {
        $this->eventDispatcher
            ->expects($this->once())
            ->method($this->methodName([$this->eventDispatcher, 'dispatch']))
            ->with(new AudioTranscribed($this->oldFileName, $this->transcribedText));

        $this->SUT->handle($this->eventDispatcher);
    }
}
