# Document and time model

The core models OTIO structure independently of any renderer or application.
RationalTime is `value / rate` seconds; rescaling retains the instant.
TimeRange has a nonnegative duration and an exclusive end. Tracks contain
sequential children; stacks contain layers. The current model exposes those
relationships without flattening or assigning playback semantics.

Node preserves its source fields, including unknown schemas and metadata.
Timeline::fromJson retains the exact original JSON; Timeline::toJson returns it
unchanged. Constructed timelines serialize their supplied source arrays.
Typed access validates the fields it needs; this is not complete schema validation.

The caller should use toJson for document export. Generic json_encode on an
imported Node array does not promise byte preservation or empty-object fidelity.
There are no mutators; a richer immutable builder and complete object-preserving
serialization are future work.

Playback conversion, supported-effect policy, dimensions, media resolution and
renderer extensions belong to adapters such as survos/otio-bundle. Source discovery,
bookmarks, exhibits, story prompts and generated narration belong to applications.
