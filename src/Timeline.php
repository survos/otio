<?php

declare(strict_types=1);

namespace Survos\Otio;

final class Timeline extends Node
{
    private ?string $originalJson = null;

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        if (!is_array($data) || ($data['OTIO_SCHEMA'] ?? null) !== 'Timeline.1') {
            throw new \InvalidArgumentException('Expected Timeline.1.');
        }
        $timeline = new self($data);
        $timeline->originalJson = $json;

        return $timeline;
    }

    public function tracks(): Stack
    {
        $stack = Node::fromArray($this->data['tracks'] ?? []);
        if (!$stack instanceof Stack) {
            throw new \InvalidArgumentException('Timeline tracks must be a Stack.1.');
        }

        return $stack;
    }

    public function toJson(): string
    {
        return $this->originalJson ?? json_encode($this, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
