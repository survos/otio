# Survos OTIO

A planned standalone PHP library for a documented subset of OpenTimelineIO: editorial documents, reliable timing, media references, and deterministic playback projections.

**Status: design and Composer scaffold only.** No parser, public API, player, or automated semantic tests are implemented yet. This package is not the official OTIO implementation and is not ready for a release. PHP 8.5+ matches current sibling library conventions.

The first implementation will read one upstream-generated cut/gap/trim fixture, preserve unsupported data, and verify timing against the official OTIO library. Start with [PLAN.md](PLAN.md).

## Product direction

A user describes a story. The application discovers and queries all relevant, authorized platform sources; selects evidenced facts, photographs, documents and recording excerpts; builds a sourced story plan; and compiles it to OTIO for browser playback. Real collection material comes first. Generated narration or illustrations are optional, labeled additions.

Retrieval and AI orchestration belong to the application/integration layer. This core has no Symfony, Doctrine, network, model-provider, or React dependency. Harvest handles acquisition/normalization, ZM serves records/media, and the shared Fotostory/Voxstory application owns presentation and story logic. A thin Symfony UX bundle and Remotion adapter follow once core semantics work.

## Documentation

- [Plan and first acceptance test](PLAN.md)
- [Core architecture and supported-subset design](docs/architecture.md)
- [Prompt-to-story source retrieval](docs/source-retrieval.md)
- [Remotion prompt-to-video reference](docs/remotion.md)
- [Harvest, ZM and Fotostory boundaries](docs/platform-integration.md)
- [Symfony bundle and player integration](docs/symfony-bundle.md)
- [Gallery and reconstruction milestones](docs/gallery.md)
- [Platform development conventions](docs/conventions.md)
- [Sources and local evidence](docs/sources.md)

These documents are the canonical development plan. The Downloads handoff is a historical/export copy. Proposed types and examples are design targets, not callable APIs.

## Local checks

```bash
cd ~/sites/mono/lib/otio
composer validate --strict
```

Use the platform's existing monolink workflow when connecting a consumer. No Packagist install command is advertised until the split repository and release exist. The package files and `lib/otio` split registration must land in the same commit.

## License

MIT for this package's original work; see [LICENSE](LICENSE). Upstream fixtures and any reused frontend code retain their own notices and terms.
