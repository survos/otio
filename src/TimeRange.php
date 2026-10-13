<?php

declare(strict_types=1);

namespace Survos\Otio;

final readonly class TimeRange implements \JsonSerializable
{
    public function __construct(public RationalTime $startTime, public RationalTime $duration)
    {
        if ($duration->value < 0) {
            throw new \InvalidArgumentException('Duration cannot be negative.');
        }
    }

    public static function fromArray(array $data): self
    {
        if (($data['OTIO_SCHEMA'] ?? null) !== 'TimeRange.1') {
            throw new \InvalidArgumentException('Expected TimeRange.1.');
        }

        return new self(RationalTime::fromArray($data['start_time'] ?? []), RationalTime::fromArray($data['duration'] ?? []));
    }

    public function endExclusive(): RationalTime
    {
        return new RationalTime(($this->startTime->seconds() + $this->duration->seconds()) * $this->startTime->rate, $this->startTime->rate);
    }

    public function jsonSerialize(): array
    {
        return ['OTIO_SCHEMA' => 'TimeRange.1', 'start_time' => $this->startTime, 'duration' => $this->duration];
    }
}
