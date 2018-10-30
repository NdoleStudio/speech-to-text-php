<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AudioTranscribed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array
     */
    private $transcribedText;

    /**
     * @var string
     */
    private $channelName;

    /**
     * Create a new event instance.
     *
     * @param string $channelName
     * @param array  $transcribedText
     */
    public function __construct(string $channelName, array $transcribedText)
    {
        $this->transcribedText = $transcribedText;
        $this->channelName = $channelName;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn() : Channel
    {
        return new Channel($this->channelName);
    }

    /**
     * @return array
     */
    public function broadcastWith() : array
    {
        return $this->transcribedText;
    }
}
