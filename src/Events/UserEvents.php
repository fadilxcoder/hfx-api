<?php

namespace App\Events;

use Evenement\EventEmitter;

class UserEvents
{
    private $emitter;

    private const LIMIT = 10;

    public function __construct(EventEmitter $emitter)
    {
        $this->emitter = $emitter;
        $this->getUserByRange();
    }

    public function getUserByRange()
    {
        $this->emitter->on('user.display', function(array $users) {
            header("X-User-total: " . count($users));
        });
    }
}