<?php

namespace App;

use Illuminate\Support\Carbon;
use Livewire\Wireable;

class Timer implements Wireable
{
    public const STATUS_RUNNING = 'running';
    public const STATUS_STOPPED = 'stopped';

    public ?Carbon $startTime = null;
    public int $secondsPassed = 0;

    public function __construct(
        ?Carbon $startTime = null
    ) {
        $this->startTime = $startTime;
    }

    public function start(): void
    {
        $this->startTime = now();
    }

    public function stop(): void
    {
        $this->startTime = null;
        $this->secondsPassed = 0;
    }

    public function getSecondsPassed(): int
    {
        if (!$this->startTime) {
            return 0;
        }

        $this->secondsPassed = $this->startTime->diffInSeconds(now());

        return $this->secondsPassed;
    }

    public function getStatus(): string
    {
        return $this->startTime
            ? self::STATUS_RUNNING
            : self::STATUS_STOPPED;
    }

    public function toLivewire(): array
    {
        return [
            'startTime' => $this->startTime,
        ];
    }
 
    public static function fromLivewire($value): static
    {
        return new static($value['startTime']);
    }
}