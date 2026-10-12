# Survos OTIO

Small, framework-independent PHP classes for OpenTimelineIO documents and time values.
Requires PHP 8.5+. This is a supported subset, not the official OTIO implementation.

```php
use Survos\Otio\Timeline;

$timeline = Timeline::fromJson(file_get_contents('story.otio'));
foreach ($timeline->tracks()->children() as $track) {
    foreach ($track->children() as $item) {
        echo $item->name();
    }
}
file_put_contents('copy.otio', $timeline->toJson());
```

## Current API

RationalTime, TimeRange, Timeline, Stack, Track, Clip (schema 1 and 2), Gap and
ExternalReference. Unknown schemas use a generic Node. Imported timelines retain
the original JSON for exact `toJson()` export; typed views are read-only.
Constructed documents accept source arrays and JSON-serializable time values.
This is not yet a full mutable OTIO object graph or comprehensive schema validator.

The library owns document structure, traversal and time values only. It contains
no story product, retrieval, AI, Symfony, React or playback projection. The
[OTIO bundle](https://github.com/survos/otio-bundle) owns Remotion conversion and
browser playback. Applications own their catalogs, story selection and media URLs.

Install from Packagist with `composer require survos/otio:dev-main`.
During development, use mono/link to connect a consumer to this source tree.

See [architecture](docs/architecture.md) and [remaining work](PLAN.md).
MIT; see LICENSE. Tests use PHPUnit; `composer install && vendor/bin/phpunit`.
