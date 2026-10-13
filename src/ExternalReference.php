<?php

declare(strict_types=1);

namespace Survos\Otio;

final class ExternalReference extends Node
{
    public function targetUrl(): string
    {
        return (string) ($this->data['target_url'] ?? '');
    }

    public function availableRange(): ?TimeRange
    {
        return isset($this->data['available_range']) ? TimeRange::fromArray($this->data['available_range']) : null;
    }
}
