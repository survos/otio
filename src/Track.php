<?php

declare(strict_types=1);

namespace Survos\Otio;

final class Track extends Node
{
    public function kind(): string
    {
        return (string) ($this->data['kind'] ?? 'Video');
    }
}
