# Core architecture (proposed)

## Research findings and decisions

Use OpenTimelineIO (OTIO) as the canonical editorial interchange document. `.otio` is JSON with per-object `OTIO_SCHEMA` identifiers and native RationalTime/TimeRange values. Media is referenced externally. Keep OTIO's time model rather than replacing it with a homegrown seconds-only document; convenient seconds-based builders may convert at the boundary.

Remotion Player renders a React composition with input props. It does not automatically interpret arbitrary OTIO or a universal JSON movie schema. Its Editor Starter has tracks/items/assets and persistence, but the official demo explicitly warns its internal video structure may change. Investigate those existing structures and reusable components before writing an adapter, while keeping saved editorial documents independent of that internal model. A small OTIO-to-playback adapter is necessary unless a suitable maintained adapter is found.

Do not assume OTIO fully specifies portable Ken Burns, titles, layout, or effect rendering. Preserve native effects and metadata; define a documented, versioned `survos` metadata profile for preview-specific transforms, gain envelopes, captions, and title cards only where needed. Distinguish standard OTIO fields from Survos extensions and runtime playback projections.

Kdenlive/MLT and FCPXML remain separate formats; Adobe interchange is not a single modern JSON standard. Check current adapter support and fidelity rather than assuming XML has disappeared. Use official OTIO adapters for legacy conversion through an optional Python process integration; do not implement MLT/FCPXML/AAF parsers in PHP in the first release.

## 1. `survos/otio`: standalone library

Namespace: `Survos\Otio`. Composer type `library`. No Symfony, Doctrine, Twig, React, or network dependency in its core.

### Responsibilities

- Read and write a documented subset of OTIO JSON.
- Provide typed DTOs/value objects, traversal, validation, media-reference discovery, timing helpers, and a deterministic playback projection.
- Preserve unrecognized schema versions, fields, effects, and metadata for round trips. Retain the original document separately when necessary; do not claim lossless serialization if fields are discarded.
- Report unsupported playback features with document paths and severity. Strict mode fails instead of silently generating a misleading preview.
- Expose a media resolver interface: canonical asset identifiers and source references remain stable while runtime URLs may expire.
- Offer builders usable by agents and application code. JSON never contains executable PHP/JavaScript expressions.

### Initial model

Implement RationalTime, TimeRange, Timeline, Stack, Track, Clip, Gap, ExternalReference, MissingReference, and Marker. Inspect current upstream schema versions before choosing emitted identifiers. Add Transition support after cuts/gaps/trims work. Preserve nested compositions even before rendering all of them.

Tracks are sequential collections, stacks are layered collections. Gaps advance track time. Clip source ranges trim source media; source time and destination time are different. Timeline global start time is timecode context, not automatically a long empty pre-roll.

OTIO RationalTime stores numeric `value` and `rate`, representing `value / rate` seconds; it is not an arbitrary numerator/denominator JSON type. Preserve supplied values/rates and avoid cumulative rounding. If exact 24000/1001 or 30000/1001 rate intent is tracked internally or in profile metadata, serialize the upstream numeric schema unchanged. See the [upstream time API](https://opentimelineio.readthedocs.io/en/latest/api/python/opentimelineio.opentime.html). Convert absolute boundaries to output frames; derive durations from the difference of rounded boundaries. Specify half-open intervals and end behavior. Cover mixed source rates, trimmed tracks/stacks, and source available ranges.

OTIO transitions have in/out offsets and require source handles; inserting a transition must not naively add its duration to track length. Validate with upstream-generated fixtures. Unsupported retiming must remain visible and must not silently play at normal speed.

### Playback projection

Produce a versioned runtime DTO containing composition dimensions/rate/duration, ordered visual layers, scheduled audio/visual clips, source trims, source IDs, resolved URLs, supported transforms/envelopes, and diagnostics. This is an internal adapter output, not a replacement OTIO interchange format.

Do not choose asset type solely by extension. Use reference metadata or injected catalog information; still-image duration needs an explicit contract. A video can provide picture and sound, so avoid accidentally playing embedded audio twice when a separate audio track refers to the same recording.

### Verification and packaging

Use upstream-generated OTIO fixtures as the semantic oracle. Test import/export preservation, unknown objects, mixed-rate timing, gaps, trims, layering, nested timing, transition handles, missing media, and duplicate-audio prevention. Compare selected results with the official Python library. Publish the supported-feature matrix and known limitations.

Provide composer.json, LICENSE consistent with original code and third-party obligations, README, changelog, example files, tests, and CI. Attribute copied upstream fixtures and retain their license notices. Do not market this PHP subset as the official complete OTIO implementation.
