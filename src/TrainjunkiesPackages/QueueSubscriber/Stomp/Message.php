<?php

namespace TrainjunkiesPackages\QueueSubscriber\Stomp;

use Stomp\Transport\Frame;

class Message implements MessageInterface
{
    /**
     * @var Frame
     */
    protected $frame;

    public function __construct(Frame $frame)
    {
        $this->frame = $frame;
    }

    /**
     * @return string|false
     */
    public function getBody()
    {
        return $this->frame->getBody();
    }

    public function getHeaders(): array
    {
        return $this->frame->getHeaders();
    }
}
