<?php

declare(strict_types=1);

namespace Survos\Otio;

final class Clip extends Node
{
    public function mediaReference(): Node
    {
        $ref = 'Clip.1' === $this->schema()
            ? ($this->data['media_reference'] ?? [])
            : ($this->data['media_references'][$this->data['active_media_reference_key'] ?? 'DEFAULT_MEDIA'] ?? []);

        return Node::fromArray($ref);
    }
}
