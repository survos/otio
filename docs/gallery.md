# Gallery and archival integration (planned)

## 3. `~/sites/otio-demo`: Tabler gallery

Create a conventional Symfony application consuming both packages. Use the existing Survos Tabler bundle/template if available; otherwise use official Tabler assets and Bootstrap-compatible templates. Include sidebar/navigation, gallery cards, detail pages, player, source information, feature badges, and diagnostics.

Each sample records title, description, OTIO source, upstream revision, media origins/license/attribution, expected features, download size if known, playback readiness, and unsupported items. Separate playable samples from reference-only films. A finished MP4 is not proof that an editable OTIO timeline exists.

### Starter gallery

1. **Archive postcard, 30–45 seconds:** three real still images, deterministic pan/zoom, a caption/title, visual fade, and optional known licensed audio. More useful than a color/name demo, but small enough to understand. Label it as Survos-authored OTIO.
2. **Interview excerpt, 20–30 seconds:** two source trims, an image laid over continuing speech, a brief gap, and concurrent low-volume music if a suitable asset exists.
3. **Mixed-rate cut list:** source trimming and gap timing using small browser-decodable video assets from an official test-media collection.
4. **Transition/marker example:** upstream OTIO fixture, with relinked media only where legitimate; show handles/markers and explain any unsupported feature.
5. **Netflix reference shelf:** metadata and watch/source links for Meridian, Sparks, Sol Levante, Nocturne, and Cosmos Laundromat. Only mark playable when an actual timeline and browser-compatible media mapping exist.

Import small upstream fixture files after inspecting their paths, license, and pinned revision. Do not pretend upstream unit-test documents include playable media. Provide a repeatable sample-import command with a manifest, checksums, source URLs, and explicit diagnostics. Import must be idempotent and must not rewrite user edits without an explicit option.

Stream browser-compatible media where CORS and byte-range behavior work. Do not download multi-gigabyte masters, image sequences, or entire S3 prefixes. Missing remote media should produce an informative state. YouTube watch URLs are reference links, not `<video>` sources; do not feed them to Remotion as media URLs. For HDR/ProRes/EXR samples, record that proxies are required instead of silently assuming browser support.

## 4. Later: Harvest/LOC and the shared Fotostory/Voxstory application

Once the small gallery passes playback checks, select a small existing Harvest LOC folio/set and build a streaming archival exhibit: Civil War, Black voices, oral history, or another collection. Inspect individual item rights statements and audiovisual delivery URLs. Use Harvest for any missing acquisition/normalization work and ZM for the story-facing API. Reuse existing image proxies, storage/media services, transcript data, and identifiers; verify an actual browser-playable delivery URL for each selected item.

The subsequent reconstruction exercise is the Scabble School documentary:

https://www.youtube.com/watch?v=Mqf__VBUbr4

Do not assume the Scabble School source corpus or its timed transcripts are already available in Fotostory. Inventory candidate photographs/interviews in Harvest and the published folios, verify their stable identities and permissions, and verify that ZM exposes the media/transcript fields needed by Voxstory. Record missing source coverage explicitly before adding entities or attempting reconstruction. Acquire the finished film's captions if available; otherwise derive a transcript from an authorized accessible recording. The official YouTube caption-download API requires edit permission; do not assume it downloads arbitrary public captions.

Match finished-film speech to raw transcripts using candidate retrieval plus lexical local sequence alignment, followed by forced alignment or waveform checks where needed. Preserve original transcripts. Allow shortened pauses, cuts, reordered passages, and competing sources. Build measured confidence from evidence, not an LLM's self-rating.

Recover original source in/out times and film destination times separately. Analyze shot boundaries and frames to distinguish interviews, photos, titles, and footage. Match photos using crop-tolerant features/registration; estimate pan/zoom from matched frames. Music-dominant sections may be photo montages, but this is a hypothesis to test.

Use original source recordings. Clearly mark verified, matched, inferred, substituted, and unresolved decisions in namespaced metadata. Preserve missing music as unresolved. Report speech/photo/music coverage separately from correctness and manually verify a representative sample. Generate canonical OTIO plus a playback projection and reconstruction report.

## 5. Milestones and acceptance

1. Reconnaissance using showcase/mono conventions and the current Harvest → folio → ZM → shared story boundary; schema/version choice, licensing review, package skeletons and same-commit split registration.
2. Library reads official fixtures, preserves unsupported data, and computes supported timing correctly.
3. Bundle commands/services work; Twig-hosted React player plays one real image/audio/video sample.
4. Tabler gallery imports several small samples; cuts, trims, gaps, layering, concurrent audio, pan/zoom, and scrubbing work.
5. Add transition support only with correct OTIO handle semantics and documented media limitations.
6. Verify/implement the ZM media/transcript API contract using one existing Harvest item; add one LOC-backed exhibit through that boundary. Then integrate the shared Fotostory/Voxstory player and inventory Scabble sources. Film reconstruction remains separate work with a source-coverage gate.

Validate Composer metadata and actual package installation, run library semantic tests, Symfony container/Twig lint, frontend typecheck/build, and browser checks. Check seeking forward/backward into trimmed media and halfway into animations, buffering recovery, end behavior, unavailable URLs, and audio duplication. Do not claim working playback from a successful build alone.

Deliver packages ready for review/publication, demo startup instructions, supported-feature matrix, sample manifest, source bibliography, and a candid tested/untested list. Commit according to repository policy. Publish the two GitHub scaffolds as the prerequisite; leave Packagist registration to the user. Do not deploy or alter unrelated packages.
