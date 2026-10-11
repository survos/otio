# Prompt-to-story source retrieval (proposed)

The prompt workflow must obtain evidence from **all appropriate platform sources**, not just the active Fotostory page, one LOC collection, or the language model's memory. Appropriate means relevant to the request, authorized for the user, and capable of providing the required evidence or media. It does not mean downloading every collection or forcing unrelated material into a story.

## Discover the sources first

Before implementing connectors, inventory current provider/dataset registrations, folio-set selectors, search services, published APIs, and existing source adapters. Read the owning components' canonical documentation and verify an actual request/response. Produce a capability matrix with owner, endpoint/service, supported filters, pagination, media/transcript availability, identity scheme, access rules, and readiness.

Start with these responsibilities, extending the inventory wherever the platform has relevant material:

| Source family | What to retrieve | Integration boundary |
| --- | --- | --- |
| Harvest provider/dataset catalog and folio-set membership | Candidate collections, scope, provenance, revisions | Existing catalog/change-feed and provider adapters; Harvest owns new ingestion |
| Published folio records through ZM | Descriptions, dates, people, places, source links and supported media fields | Published APIs; missing fields become an API task |
| Fotostory photo discovery | Relevant photographs and collection context | Existing search/catalog services; hydrate selected hits from authoritative records |
| Voxstory/oral-history collections | Original recording excerpts, speakers and timed transcript passages | ZM media/transcript API when available; currently a documented gap |
| Document/newspaper/OCR collections, when present | Historical evidence, page images and quoted text | Inspect existing owning apps and published services; no assumed endpoint |
| Registered media/storage/IIIF/image services | Original identity, browser renditions, dimensions, rights and credits | Existing registry/resolvers; runtime URLs are not identities |
| Existing enrichment/translation/transcription services | Supported derived claims, translated text, transcript revisions | Preserve original evidence and derivation; verify current availability |
| User-selected records/bookmarks/uploads, when supported | Explicit anchors and scoped private material | Authorized application interfaces, with original source identity retained |

LOC is one provider, not the source universe. Discover other providers from actual registrations instead of freezing a provider list in the prompt. Treat different views of the same folio/media as one evidence source, not independent corroboration. External retrieval should reuse the owning provider integration and the request's scope.

## Workflow

1. Parse the request into subject, named entities, time/place, language, audience, target duration/aspect ratio, desired media and source constraints. Preserve explicit selections as anchors; they need not limit broader relevant discovery unless requested.
2. Select every relevant eligible source using the capability inventory. Query lexical/entity/date/place filters and available semantic search. Respect access scope before retrieval and before showing excerpts to a model.
3. Hydrate promising hits through authoritative APIs. Retrieve transcript passages with source ranges, document excerpts with page references, and playable media metadata. Search snippets alone are not sufficient evidence.
4. Deduplicate using canonical folio/row/media identity. Rank for relevance, evidence quality and usable media; retain conflicting accounts and explain unresolved differences. Do not equate multiple search hits with corroboration.
5. Persist an evidence manifest: request and normalized filters, source/adapter versions, queries, timestamps, pagination/limits, retrieved IDs/revisions, excerpts/ranges, rights, selected/rejected decisions and reasons. Report each relevant source as searched, empty, unavailable, partial, or excluded with a reason. A failed API is not “no results.” Bounded retrieval must disclose its limits.
6. Build a typed story plan whose scenes reference evidence IDs and chosen asset IDs/source ranges. Ground factual narration in those references; distinguish quotation from synthesis, inference and uncertainty. Missing evidence becomes a visible gap, not a fabricated photo, quote, date or clip ID.
7. Compile that plan into canonical OTIO using the library's builders. Keep citations, source IDs, transcript revisions and generation provenance in versioned Survos metadata or an associated manifest. Resolve playable URLs separately and display scene-level sources/credits beside the player.

Existing recordings and photographs take priority. Optional generated narration/illustration must be labeled and recorded with its inputs/provider/version; it is not archival evidence. Do not automatically synthesize a substitute when source retrieval fails. Record actual output durations/alignment before scheduling generated audio.

## Responsibilities and acceptance

Application services own discovery, credentials, network calls, search and AI orchestration. The OTIO core accepts resolved, typed inputs. The Symfony bundle wires interfaces without requiring Harvest, ZM or a model provider for a generic player.

Prove the flow with a frozen cross-source fixture: a prompt selects a photograph and a timed interview excerpt, plus a relevant document if available. Verify every eligible source is accounted for, duplicate records collapse, unauthorized results stay excluded, outages stay visible, selected claims have citations, fabricated IDs are rejected, and transcript ranges survive into OTIO. Keep a separate live smoke check for actual API/media availability. This fixture proves integration behavior, not that all production connectors are implemented.
