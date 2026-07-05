# KutkiTech — WordPress Theme

A custom, dependency-free WordPress theme for KutkiTech Pvt. Ltd. Dark, modern IT-company aesthetic with an animated circuit-network hero, scroll reveals, an accordion FAQ, and a working AJAX contact form — no page builder or premium plugin required.

## What's inside

- `style.css` — theme header (required by WordPress)
- `functions.php` — theme setup, enqueueing, includes
- `inc/custom-post-types.php` — Services, Testimonials, Team, Careers, Downloads
- `inc/contact-form.php` — AJAX contact form handler (`wp_mail`, saves a backup copy as a private "Lead" post)
- `inc/default-content.php` — seeds demo content + creates pages + builds the nav menu on first activation
- `inc/customizer.php` — editable contact info & homepage stats (Appearance → Customize)
- `assets/css/main.css`, `assets/js/main.js` — all styling & interactivity, plain CSS/JS (no build step)
- `page-templates/` — About, Services, Our Team, Careers, Downloads, Contact Us
- `front-page.php`, `page.php`, `single.php`, `index.php`, `404.php`, `header.php`, `footer.php`

## Install on XAMPP (local)

1. Install XAMPP, start Apache + MySQL.
2. Download WordPress from wordpress.org, unzip it into `C:\xampp\htdocs\kutkitech` (or `/Applications/XAMPP/htdocs/kutkitech` on macOS).
3. Create a database via `http://localhost/phpmyadmin`.
4. Visit `http://localhost/kutkitech` and complete the WordPress install wizard.
5. Copy this `kutkitech` theme folder into `.../wp-content/themes/`.
6. In wp-admin → Appearance → Themes, activate **KutkiTech**.
7. On activation the theme automatically creates the Home, About, Services, Team, Careers, Downloads and Contact pages, sets Home as the static front page, builds the main menu, and adds sample services/testimonials/jobs — the site is fully populated immediately.

## Install on live WordPress hosting

1. Zip the `kutkitech` folder (the zip's top level must contain `style.css`, `functions.php`, etc. directly).
2. wp-admin → Appearance → Themes → Add New → Upload Theme → choose the zip → Install → Activate.
3. Same auto-seeding described above runs on activation.

## After activating

- **Appearance → Customize** — set phone, email, address, social links, the map location, and the three homepage stat numbers. Two new sections, **Homepage Copy** and **About Page Copy**, hold the hero text, "why choose us" heading, CTA text, and mission/vision/values blurbs — all editable without touching code.
- **Services / Testimonials / Our Team / Careers / Downloads / FAQs / Values & Perks / Timeline / Why Choose Us / Industries** (left admin menu) — every repeating block on the site (service cards, the homepage FAQ accordion, the About "Foundation" grid, the Careers "Why KutkiTech" grid, the company timeline, the homepage "why choose us" list, and the Services industries tag cloud) is a custom post type. Add, edit, reorder (via the Order field under Page Attributes), or delete entries from wp-admin — nothing is hardcoded in the templates anymore.
  - **Values & Perks** has a "Show On" dropdown — pick *About Us* or *Careers* to control which page's grid an entry appears in.
- **About Us page content** — the long intro paragraphs at the top of the About page are the actual page content (Pages → About Us → Edit), so they're editable the normal WordPress way.
- **Contact Leads** — every contact form submission is saved here as a private post, in addition to being emailed to the address set in Customizer (falls back to the site admin email). On local XAMPP, outgoing mail usually needs an SMTP plugin (e.g. WP Mail SMTP) since XAMPP doesn't have a mail server configured by default — the Leads log means no submission is lost while you set that up.
- **Job Applications** — CV submissions from the Careers page land here, with the applicant's details and a link to download their CV.
- **Menus** — a "Main Menu" is created automatically; edit it under Appearance → Menus if you add more pages.

## CV / document uploads

- The **Contact Us** page has an optional "Attach CV or Document" field; the **Careers** page has a required CV upload on every job's "Apply Now" form and on the general application form at the bottom of the page.
- Accepted format: **PDF only**, validated both by file extension and by sniffing the actual file content (not just the browser-reported type) — max **512KB**.
- Files are stored outside the Media Library at `wp-content/uploads/kutkitech-files/`, with a `.htaccess` that blocks PHP execution and directory listing in that folder, and randomized filenames to avoid collisions.
- If your host or local PHP config has `upload_max_filesize` or `post_max_size` set below 512KB (rare, but some minimal XAMPP configs use 2M/8M defaults which is fine), large files will be rejected by PHP itself before the theme's own validation runs — the defaults on a standard XAMPP install are comfortably above 512KB so this shouldn't come up.

## Map on Contact Us

The map embed uses Google's keyless embed endpoint (`google.com/maps?...&output=embed`), so it works immediately with no API key or billing account. Change the location in **Appearance → Customize → Company Contact Info → Map Location** — it accepts a plain address or `lat,lng` coordinates.

## Notes

- No jQuery dependency, no build tooling — everything is vanilla PHP/CSS/JS so it runs unmodified on shared hosting or XAMPP.
- Google Fonts (Space Grotesk, Inter, JetBrains Mono) load from Google's CDN; if you need a fully offline/local build, download the font files into `assets/fonts/` and swap the `@font-face` rule into `main.css` in place of the CDN `<link>` in `functions.php`.
- The hero's animated node network respects `prefers-reduced-motion`.
