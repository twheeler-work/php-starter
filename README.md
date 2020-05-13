# Getting started

1. Set your site data in info.php.

2. Add your accessible pages to the src/views directory

   - Router only allows page request to pages in views
   - Source folder can be changed in info.php

3. Add page content to src/views/pages

   - Add extension .pages.php to all content pages

# Structure

## ROOT

Basic project setup files are stored here.

- index.php

  - Sets up route and project for single page site

- info.php

  - Set site specific information
  - > Accessed by _\$site_ variable

- links.php
  - Sets project links
  - > Accessed by _\$links_ variable

## Public

Store all public accessible content here.

- CSS

  - All styles are loaded through core.css

- Images
- JS

  - Include any custom js here

## SRC

All private content is stored here.

- API
  Backend code directory

- Config

  - Backend project setup code
  - Store all sensitive data here
  - Includes database connection file

- Models
  Project class modules are stored here

  - Email
  - Route (project router)
  - Update
  - Update entries on call

- Views

Rendered content is stored here.

All valid routes are established in this folder (EXCEPT for components & pages).

- Components
  Main site components are stored here.
  EX: footer, header...

  - Common
    Place reusable components here.

- Pages
  All page specific content is rendered here.

  - View file and page file must have same name (View use example below)
  - All page data is prefixed with .page.php

  ### Basic Use:

        views

        - thankyou.php (accessible page)

        - pages
            - thankyou.page.php (page content)

## Vendor

All vendor required files are stored here.

### Libraries

- AWS (texting)
- phpmailer (emails)
- thingengineer (db library shortcode)

## Happy building!
