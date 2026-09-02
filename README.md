# Enterprise Content Hub

A custom WordPress theme for publishing articles and categorized resources.

## Requirements

- WordPress 6.9 or later
- PHP 8.0 or later recommended
- Advanced Custom Fields

## Features

- ACF-powered homepage
- Custom Resource post type
- Resource Topic and Resource Type taxonomies
- Featured resources
- AJAX blog and resource filtering
- AJAX pagination
- Search and custom content templates
- Responsive navigation and layouts

## Installation

1. Upload the theme through **Appearance → Themes → Add New → Upload Theme**.
2. Install and activate Advanced Custom Fields.
3. Activate Enterprise Content Hub.
4. Open **ACF → Field Groups** and sync the available field groups.


## ACF Local JSON

ACF field-group definitions are stored in acf-json. Commit these JSON files with the theme. After deployment, sync them from **ACF → Field Groups**.

The theme uses home page with ACF fields

## Responsive CSS

Desktop styles are in assets/css/main.css. Responsive overrides are in assets/css/responsive.css and use only:

css
@media (max-width: 991px)
@media (max-width: 767px)


## JavaScript

- theme.js — navigation and back-to-top behavior
- main.js — Blog filtering and pagination
- resource-filter.js — Resource filtering and pagination

## Production checklist

- Enable HTTPS.
- Keep WordPress and ACF updated.
- Set DISALLOW_FILE_EDIT to true in wp-config.php.
- Keep WP_DEBUG disabled on the public site.
- Do not commit credentials or wp-config.php.
- Test navigation, search, filters, pagination, and responsive layouts after deployment.

## Version

Current release: 1.0.0