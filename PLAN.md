# Implementation plan

## Current state

- [x] Establish package boundaries and document actual Harvest/ZM/Fotostory constraints.
- [x] Review Remotion prompt-to-video as a composition/orchestration reference.
- [x] Create Composer metadata, MIT license, PSR-4 directories and canonical docs.
- [x] Add split registration alongside the new package files (must be committed together).
- [ ] Implement runtime behavior. No parsing, playback or source retrieval is implemented yet.

## Publication prerequisite — before otio-demo

- [ ] Publish the core and thin bundle scaffolds to `survos/otio` and `survos/otio-bundle` through mono's split workflow.
- [ ] Verify public repository contents and Composer metadata on both default branches.
- [ ] User registers both packages on Packagist; no demo starts before this step.

Publishing the design/scaffold repositories is distinct from releasing working playback. Keep their development status explicit and do not create a stable version tag yet.

## 1. First vertical slice: one fixture, correct timing

Choose and pin an official OTIO release/schema and a tiny upstream-generated fixture containing a trimmed clip, a gap and a second clip. Record generation command, expected timing and license/provenance. Add only the DTOs and parsing/traversal needed for this fixture: RationalTime, TimeRange, Timeline, Stack, Track, Clip, Gap and media references.

Acceptance: read/write preserves unknown fields and metadata; source trims remain separate from destination intervals; gap advances time; half-open output boundaries match the upstream oracle. Unsupported retiming produces a diagnostic rather than normal-speed playback. Include a malformed-input case. Add PHPUnit and its configuration with these real semantic tests, not an empty passing test suite. Verify PSR-4 autoload and Composer installation locally.

## 2. Projection and source contracts

Define versioned, URL-free playback projection and application resolver contracts. Add missing-media diagnostics and source/rendition invalidation. Verify mixed rates, nested ranges, layering and audio ownership. Keep all retrieval and network I/O outside the library. Transition support waits for source-handle fixtures.

In parallel with design, inventory appropriate platform sources and their actual APIs using [source-retrieval.md](docs/source-retrieval.md). Record unsupported capabilities explicitly; a repository name is not a working connector.

## 3. One playable sample

Create the thin kit-based `survos/otio-bundle` and the Tabler demo. Host a localized React/Remotion player through Twig and AssetMapper. Use a small real image/audio/video fixture and verify scrubbing into trims and animations in a browser. Add bundle split registration with its files. Do not create an entire gallery before one sample works.

## 4. Prompt → evidence → story → OTIO

Implement application-owned source discovery, querying, hydration, deduplication and evidence manifests. Cover all relevant eligible sources, with explicit unavailable/partial/skipped outcomes. Compile a typed story plan using resolved source IDs; reject invented IDs and unsupported facts. Demonstrate a small cross-source story and inspect its evidence alongside playback. Use frozen source responses for repeatable tests.

## 5. Shared story integration and broader samples

Resolve the missing ZM media/transcript API before a Vox-backed sample. Use one existing Harvest LOC item/set, then expand the gallery. Verify source identities, source/destination transcript timing, rights, attribution, expired URLs and duplicate-audio handling. Add transitions only after upstream handle tests pass.

## 6. Reconstruction and publication readiness

Inventory Scabble School sources before attempting matching/reconstruction. Keep confidence and missing coverage explicit. Complete supported-feature matrix, packaging/CI, clean install checks and tested/untested list before considering release. GitHub split publication of the scaffolds is the immediate prerequisite; Packagist registration belongs to the user. No deployment or rendering service is part of this scaffold.

## Decisions

- OTIO is canonical editorial interchange; Remotion's template JSON is an adapter reference.
- All appropriate platform sources must be considered; no LOC-only or current-page-only retrieval default.
- Core is dependency-free apart from PHP; platform services own retrieval, generation and storage.
- New PHP package baseline is ^8.5, consistent with current sibling libraries and Fotostory.
- Full upstream handoff requirements are retained across docs; no finished capability is implied by this plan.
