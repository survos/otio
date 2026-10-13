<?php

declare(strict_types=1);

namespace Survos\Otio\Tests;

use PHPUnit\Framework\TestCase;
use Survos\Otio\Node;
use Survos\Otio\RationalTime;
use Survos\Otio\Timeline;
use Survos\Otio\TimeRange;

final class TimelineTest extends TestCase
{
    public function testUnknownObjectsAndEmptyMapsSurviveExactExport(): void
    {
        $json = '{"OTIO_SCHEMA":"Timeline.1","metadata":{},"tracks":{"OTIO_SCHEMA":"Stack.1","children":[{"OTIO_SCHEMA":"Future.9","custom":{"empty":{}},"metadata":{}}]}}';
        $timeline = Timeline::fromJson($json);
        self::assertSame('Future.9', $timeline->tracks()->children()[0]->schema());
        self::assertSame($json, $timeline->toJson());
        self::assertSame([], (new Node(['metadata' => (object) []]))->metadata());
    }

    public function testMixedRatesAndExclusiveEnd(): void
    {
        $range = new TimeRange(new RationalTime(48, 24), new RationalTime(60, 30));
        self::assertSame(4.0, $range->endExclusive()->seconds());
        self::assertSame(120.0, $range->endExclusive()->rescaledTo(30)->value);
        self::assertEqualsWithDelta(1.001, (new RationalTime(24, 24000 / 1001))->seconds(), 1e-12);
    }

    public function testInvalidRateIsRejected(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new RationalTime(1, 0);
    }
}
