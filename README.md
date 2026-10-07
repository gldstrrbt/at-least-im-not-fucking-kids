# AtLeastImNotFuckingKids.com

Recovered source for an August 2025 satirical microsite / merch experiment.

The site presents a random user-submitted confession and appends the deliberately absurd moral-floor punchline used by the project title. Visitors could submit their own short confession; a PHP endpoint normalized and filtered submissions before appending accepted entries to a local text file. The page also linked to the project's Shopify store and social accounts and included Google Analytics event tracking.

## Stack

- PHP
- Vanilla JavaScript
- HTML/CSS
- Flat-file storage (`sins.txt`)
- Google Analytics event tracking

## Files

- `index.php` — page UI, random confession display, submission form, moderation pre-checks, analytics events, shop/social links.
- `submit_sin.php` — server-side normalization, offensive-content filtering, validation, and flat-file persistence.
- `favicons/site.webmanifest` — surviving text manifest from the original favicon set.

## Recovered-source cleanup

This archive keeps the original behavior and tone while removing obvious packaging debris:

- Removed a placeholder `landing.html` generated during an earlier export.
- Removed a second complete copy of the page that had been pasted into `index.php` inside an HTML comment.
- Made the `sins.txt` and submission endpoint paths self-contained.
- Added an empty-dataset guard so a fresh checkout does not throw a JavaScript error before any submissions exist.
- Kept the original Google Analytics measurement ID because it is a public site identifier, not a secret.
- User submissions (`sins.txt`) are excluded from version control.
- Large binary merch/product images and favicon image files from the recovered ZIP are not duplicated in this code archive. The HTML retains their expected `assets/` / `favicons/` paths as a record of the original layout.

## Historical note

This repository is an archive of a satirical web project. The user-submission flow contains explicit moderation logic because the site's premise invited people to submit text publicly. The filtering code is preserved as implementation history, not as endorsement of the terms it blocks.

No production user submissions or private analytics data are included.