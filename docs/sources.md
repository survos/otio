# Evidence and references

## 6. Sources and watch links

Original research checkpoint: 2026-10-11. This revision checks local architecture/conventions and the upstream OTIO time API/Remotion Player docs; the remaining inherited external asset, licensing, and deployment claims must be reverified before implementation. Follow current official docs and pin implemented versions. Distinguish source links from candidate assets requiring inspection.

### OpenTimelineIO

- Project: https://opentimeline.io/
- Official source, examples, and test fixtures: https://github.com/AcademySoftwareFoundation/OpenTimelineIO
- Documentation and schema API: https://opentimelineio.readthedocs.io/en/latest/
- Architecture: https://opentimelineio.readthedocs.io/en/latest/tutorials/architecture.html
- Timing: https://opentimelineio.readthedocs.io/en/latest/tutorials/time-ranges.html
- Timeline structure: https://opentimelineio.readthedocs.io/en/latest/tutorials/timeline-structure.html
- Adapter discovery: https://opentimelineio.readthedocs.io/en/latest/tutorials/adapters.html

Check documentation navigation if individual tutorial paths move. The official Python/C++ implementation is the semantic reference. Investigate existing PHP and JavaScript OTIO implementations before duplicating work; record maintenance/license/feature findings.

### Remotion

- Player: https://www.remotion.dev/docs/player
- Media: https://www.remotion.dev/docs/media
- Editor Starter: https://www.remotion.dev/docs/editor-starter
- Editor Starter tracks/items/assets model: https://www.remotion.dev/docs/editor-starter/tracks-items-assets
- Demo, including a populated announcement-video project: https://www.remotion.dev/docs/editor-starter/demo
- Live editor: https://editor-starter.remotion.dev/
- Starter templates: https://www.remotion.dev/templates
- Showcase: https://www.remotion.dev/showcase
- License/pricing: https://www.remotion.dev/license

Use the official demo page's **Edit announcement video** link to inspect a populated composition without downloading a movie. It is a stronger example than the empty editor. Check Starter-specific license terms before copying code. Player licensing and paid Editor Starter licensing are separate questions.

### Netflix Open Content

- User-provided source: https://sites.google.com/netflix.com/opencontent/home?pli=1&authuser=0#h.fzfk5hndrb9w
- Clean source URL: https://sites.google.com/netflix.com/opencontent/home
- Asset bucket/browser: http://download.opencontent.netflix.com/
- The official page provides title-specific asset links and watch links. It lists CC BY 4.0 for its open content; retain title-specific notices and credit requirements.

The inspected page lists media/master assets for the titles above, but does **not establish that their downloadable collections contain OTIO editorial timelines**. Inspect listings first. Never manufacture a timeline and present it as the film's recovered original edit.

### YouTube and streaming inspiration

- Scabble School finished film, supplied by user: https://www.youtube.com/watch?v=Mqf__VBUbr4
- Remotion Editor Starter introduction video (linked from official documentation): https://www.youtube.com/watch?v=KwMMm1n3giU
- Remotion official YouTube channel (linked from official documentation): https://www.youtube.com/@remotion_dev
- Netflix reference films: use the official Open Content page's **Watch … on Netflix** links. Do not invent YouTube IDs for Meridian or Sparks; no official YouTube upload was confirmed in this research checkpoint.

Codex should expand this bibliography with verified direct YouTube video links, durations, source ownership, and an indication of whether each item is only a rendered example or has a corresponding editable timeline. Watching rendered examples should require no large local downloads.

### Archival data

- LOC API: https://www.loc.gov/apis/
- LOC JSON/YAML documentation: https://www.loc.gov/apis/json-and-yaml/
- YouTube caption download permissions: https://developers.google.com/youtube/v3/docs/captions/download
- Tabler: https://tabler.io/ and https://github.com/tabler/tabler

## Local evidence to reread before implementation

Paths below are relative to `~/sites` (Fotostory files were checked in the current task worktree):

- `showcase/{AGENTS,CLAUDE,CONVENTIONS,HANDOFF,PLAN,README}.md`; `mono/bu/{AGENTS,CLAUDE}.md` — platform rules, historical work and current bundle conventions.
- `fotostory/composer.json`, `README.md`, `docs/harvest-sync.md`, `docs/vox-local.md` — actual versions, identities, sync and the missing Vox media API.
- `fotostory/src/Service/VoxCatalog.php`, `src/EventListener/HarvestSyncedListener.php`, `src/Entity/{FolioProfile,TenantFolio}.php` — current catalog/presentation boundaries.
- `harvest/src/Service/DatasetMediaRegistrar.php`, `src/Service/TimecodedTranscriptParser.php`, `src/Transcript/TranscriptSegment.php` — registration identity, inferred timing and checksum-based segment provenance.
