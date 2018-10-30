<?php

namespace Tests\Unit\Events;

use App\Events\AudioTranscribed;
use Illuminate\Broadcasting\Channel;
use Tests\TestCase;

class AudioTranscribedTest extends TestCase
{
    /**
     * @var array
     */
    private $transcribedText = [
        'line 1',
        'line 2'
    ];

    /**
     * @var string
     */
    private $channelName = 'filename.mp3';

    /**
     * @var AudioTranscribed
     */
    private $SUT;


    public function test_that_the_broadcast_on_method_returns_a_new_channel()
    {
        $this->SUT = new AudioTranscribed($this->channelName, $this->transcribedText);

        $this->assertEquals(new Channel($this->channelName), $this->SUT->broadcastOn());
    }

    public function test_that_the_broadcast_with_method_returns_the_transcribed_text()
    {
        $this->SUT = new AudioTranscribed($this->channelName, $this->transcribedText);

        $this->assertEquals($this->transcribedText, $this->SUT->broadcastWith());
    }
}