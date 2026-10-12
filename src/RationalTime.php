<?php

declare(strict_types=1);

namespace Survos\Otio;

final readonly class RationalTime implements \JsonSerializable
{
    public function __construct(public float $value, public float $rate)
    {
        if (!is_finite($value) || !is_finite($rate) || $rate <= 0) {
            throw new \InvalidArgumentException('Time requires a finite value and positive finite rate.');
        }
    }

    public static function fromArray(array $data): self
    {
        if (($data['OTIO_SCHEMA'] ?? null) !== 'RationalTime.1' || !is_numeric($data['value'] ?? null) || !is_numeric($data['rate'] ?? null)) {
            throw new \InvalidArgumentException('Expected RationalTime.1 with value and rate.');
        }
        return new self((float) $data['value'], (float) $data['rate']);
    }

    public function seconds(): float { return $this->value / $this->rate; }
    public function rescaledTo(float $rate): self { return new self($this->seconds() * $rate, $rate); }
    public function jsonSerialize(): array { return ['OTIO_SCHEMA' => 'RationalTime.1', 'value' => $this->value, 'rate' => $this->rate]; }
}
