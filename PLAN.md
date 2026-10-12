# Core plan

- [x] Publish Composer package and split repository.
- [x] Implement time values and typed read-only views of Timeline, Stack, Track, Clip, Gap and ExternalReference.
- [x] Preserve original imported JSON for exact export and retain unknown nodes.
- [ ] Expand schema validation and immutable construction helpers.
- [ ] Add fixtures for nested compositions, transitions and additional reference schemas.
- [ ] Add upstream-oracle CI for mixed-rate time calculations and schema compatibility.

The core contains only OTIO structure/classes. Viewer work belongs to otio-bundle;
product and retrieval plans belong to the consuming application.
