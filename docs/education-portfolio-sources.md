# Education portfolio content sources

Prepared 7 October 2026. These notes support maintenance of `projects.html` and
`learnable.html`; they are not additional product claims.

## Ownership and selection

The company owner confirmed in this chat that the projects in the Codex project
history were delivered by SCHELPS. The selected portfolio focuses on education:
LearnAble, the OWUTECH portal, OWUTECH Connected Campus, CRSM school operations,
Ogun State student data capture, Eminent Kids, ICSS and the Edu-First-Honour CBT
centre application. Non-education projects were omitted from this selection.

## LearnAble

Content was checked against the local Learnable project:

- `admin/nav.html`: school profile, staff, learners, classes, subjects,
  allocations, terms, calendar, scores, result settings, affective records,
  reports, promotions, fees, discounts, payments, expenses, inventory and learning.
- `docs/SCHOOL_WORKFLOWS.md`: fee catalogue and assignments, discounts, expense
  register, stock movements, score entry and lesson resources.
- `docs/CBT_MODULE.md` and `docs/registry-admin.md`: question bank/import,
  assessment schedules, timed attempts, marking, moderation, published results,
  authorised score transfer and the Registry Admin role.
- `docs/school-website.md`: public landing page populated from school profile,
  optional website content and a separately configured WhatsApp contact.
- `classes/ReportService.php`: term and cumulative academic reports.
- `learn/view/include/navlearner.php`: learner resources, bills, transaction
  history and published results.

The finance content does not promise a bank integration or a full accounting
ledger. The page does not promise a current parent account module. No subscriber
counts, prices, learning-outcome improvements or production guarantees were
inferred from the source. The diagram is a workflow overview, not a screenshot.

## Other source-backed project descriptions

- **OWUTECH portal:** Course project's `docs/result-reliability.md`,
  `docs/portal-login-fees-promotion.md` and
  `docs/semester-wallet-progression.md`, plus this chat's school deployment context.
  Features describe the application scope, not a certification of every live module.
- **Eminent Kids:** Eminent project's public `index.php` and page inventory:
  programme pages, admissions/enquiry, gallery, events and contact.
- **ICSS:** ICSS project's `index.html`: professional training, membership,
  examinations, registration and conference information.
- **Edu-First-Honour CBT centre:** FXCBT project's `index.php`, `track.php` and
  manager service/request/transaction pages. Describe service operations, not a
  separate examination engine.

## Owner-provided engagement descriptions

The owner supplied the following scope in the accessible ChatGPT conversation
named **Create Cashflow Dashboard**:

- Managed OWUTECH campus connectivity, fibre distribution, a point-to-point
  extension and portal-based payment collection.
- Development and management of the school operations portal for Christ the
  Redeemers School Management, the board responsible for RCCG schools.
- Annual student data capture supporting CASS recording and WASSCE registration
  in allocated Ogun State Ministry of Education zones.

Those cards stay within the supplied scope. The portfolio does not publish
private investment figures, internal records, credentials or student information.

## Full website redesign and release

The owner subsequently requested that the entire website use the new design.
All eight public pages now share the green/cream design, accessible navigation,
company footer, product and project links, and policy routes:

- `index.html`: company homepage, service areas, LearnAble, Connected Campus,
  company introduction, the three existing attributed client reviews and enquiry form.
- `about.html`: company story, existing vision/mission/purpose and education engagements.
- `services.html`: four business areas plus existing development, automation,
  ICT training and digital communication capabilities.
- `products.html`: LearnAble, Examinify, ScoresReport, School Bookshop Software
  and SCHELPS Teachinn. No unsupported features or product pricing were added.
- `projects.html` and `learnable.html`: portfolio and source-backed product details.
- `contact.html`: labelled enquiry form, original email/phone/address and map.
- `policies.html`: the original three policy texts moved from modals into linked
  sections; their wording and effective date were retained.

Legacy homepage anchors (`home`, `about`, `services`, `portfolio`, `clients`,
`contact`) are retained. The original Beamer product configuration remains on
the homepage. The old animation and gallery dependencies are no longer loaded
by the redesigned public pages, but their asset files remain in the repository.

The form continues to POST the original field names to `vendor/contact-mailer.php`
with `X-Requested-With: XMLHttpRequest`. It now handles keyboard/native submission,
required field validation, busy state, duplicate prevention, text-only response
feedback, provider rejection and HTTP failure. Optional phone and selected subject
use fields already supported by the backend. SMTP settings and delivery code were
not changed. Product-specific enquiry links preselect a known product subject.

Deploy all eight root HTML pages, `personal/css/studio.css`,
`personal/js/portfolio-pages.js`, `sitemap.xml` and `robots.txt` together. Existing `vendor/contact-mailer.php`,
PHPMailer files and image assets are still required. No database changes are needed.

## Verification

- All eight pages and shared assets returned HTTP 200 locally.
- 220 local references and anchors passed the static audit; all form controls
  have associated labels, each page has a single main heading, and IDs are unique.
- JavaScript syntax and whitespace checks passed.
- Every page was checked at a 390px browser viewport without horizontal overflow.
- Desktop homepage, Services and Contact layouts were visually inspected.
- Mobile navigation and product-specific enquiry preselection were exercised.
- Project filtering and the portfolio-to-LearnAble link were exercised.
- The actual mailer rejected a deliberately invalid name before any email send.
- A temporary local mailer fixture verified successful feedback/form reset,
  disabled submission while sending, error feedback with input retention, and
  HTTP-failure recovery. That fixture could not send email and was removed.

Actual SMTP/inbox delivery is not verified by these local checks.

## Current technology-studio redesign

The owner rejected the previous editorial direction. The eight public pages now
load one shared stylesheet, `personal/css/studio.css`. The design uses Ubuntu,
charcoal, white and lime, with a new homepage centred on website design, software
engineering and the existing education portfolio. The former premium and baseline
stylesheets are retained as historical assets and are no longer loaded.

The homepage includes a vector sculpture, an expanded visual portfolio, four
capability rows, a LearnAble platform diagram, company experience, existing client
reviews and the enquiry form. Website development has its own section and anchor
on the Services page. Public project descriptions and policies retain their
verified scope; no new client counts, awards or outcome claims were introduced.

The project screenshots in `personal/img/work/` were captured from the local public
Eminent and ICSS website previews. They do not represent authenticated portal data
or establish what is currently published on those clients' domains. The hero asset
`personal/img/digital-sculpture.svg` is native vector artwork. Its gentle CSS motion
is disabled for reduced-motion preferences. Ubuntu is self-hosted in
`personal/fonts/`, alongside its Ubuntu Font Licence; no runtime font-service
request is needed.

Deploy all eight HTML pages, `personal/css/studio.css`, the fonts directory,
`personal/img/digital-sculpture.svg`, both images under `personal/img/work/`, and
`personal/js/portfolio-pages.js`, alongside existing favicon, social-preview,
mailer and PHPMailer assets, robots.txt and sitemap.xml. No database changes or
JavaScript framework installation are needed. These are local changes, not a
production deployment.

Current validation: all eight pages checked at 320px, 390px, 768px and 1440px without
horizontal overflow; 237 local HTML references/anchors checked with no failures,
unique IDs, single H1 per page and associated form labels. The mobile menu and
Escape/focus recovery, website project filter, product enquiry preselection and native scope disclosure were
exercised. Existing enquiry submission logic and SMTP configuration are unchanged;
actual inbox delivery remains unverified.

The three self-hosted WOFF2 fonts total approximately 311KB. All pages, shared
assets and fonts return HTTP 200 locally; the final homepage has no captured
browser console errors. Final screenshots are saved in `docs/previews/` with
the `studio-` prefix.

## Typography update

At the owner’s request, Ubuntu replaces Manrope throughout all eight pages.
Candara and Segoe UI are fallbacks. The regular, medium and bold faces are
self-hosted as WOFF2 assets, with `personal/fonts/UFL-Ubuntu.txt` retained.
Preload links and the stylesheet version were updated together. All eight pages
were rechecked at 320px, 390px and 768px without horizontal overflow; the desktop
homepage was visually reviewed. The design and existing site behaviour are retained.
The Ubuntu desktop preview is `docs/previews/ubuntu-homepage-desktop.jpg`.
