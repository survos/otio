<?php

declare(strict_types=1);

namespace Survos\Otio;

/** Immutable source-backed view: unrecognized fields are retained when serialized. */
class Node implements \JsonSerializable
{
    public function __construct(protected readonly array $data)
    {
    }

    public function schema(): string
    {
        return (string) ($this->data['OTIO_SCHEMA'] ?? '');
    }

    public function name(): string
    {
        return (string) ($this->data['name'] ?? '');
    }

    public function metadata(): array
    {
        return (array) ($this->data['metadata'] ?? []);
    }

    public function sourceRange(): ?TimeRange
    {
        return isset($this->data['source_range']) ? TimeRange::fromArray($this->data['source_range']) : null;
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }

    public function children(): array
    {
        return array_map(self::fromArray(...), $this->data['children'] ?? []);
    }

    public static function fromArray(array $data): self
    {
        return match ($data['OTIO_SCHEMA'] ?? '') {
            'Timeline.1' => new Timeline($data),
            'Stack.1' => new Stack($data),
            'Track.1' => new Track($data),
            'Clip.1', 'Clip.2' => new Clip($data),
            'Gap.1' => new Gap($data),
            'ExternalReference.1' => new ExternalReference($data),
            default => new self($data),
        };
    }
}
