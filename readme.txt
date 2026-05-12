WordPress Theme

**Version:** 1.0.0  
**Requires:** WordPress 5.2+ | PHP 7.4+ | Advanced Custom Fields (Free or Pro)

A modern, fully-featured WordPress theme with custom post types for Services and Properties, Bootstrap 5 integration, and advanced ACF field groups.

## Features

✅ **Custom Post Types**
- Services (with categories)
- Properties (with types)

✅ **Advanced Custom Fields (ACF)**
- Services: Price, Duration, Icon, Features, CTA Button
- Properties: Price, Address, Specs, Gallery, Amenities, Agent Info

✅ **Bootstrap 5**
- CDN integration
- Responsive grid system
- Pre-built components (cards, alerts, buttons)

✅ **Responsive Templates**
- Single & Archive templates for Services & Properties
- Mobile-friendly design
- Bootstrap grid system

✅ **ACF Helper Functions**
- 20+ template functions for easy field display
- Automatic formatting
- Simplified template code

## Installation

### 1. Upload Theme
- Extract `growmodo.zip`
- Upload to `/wp-content/themes/`
- Activate in WordPress Admin → Appearance → Themes

### 2. Install Required Plugin
**Advanced Custom Fields (ACF)**
- Go to WordPress Admin → Plugins → Add New
- Search for "Advanced Custom Fields by Elliot Condon"
- Install and activate the free version (or Pro)

### 3. Enable ACF JSON Sync (Recommended)
- With ACF activated, field groups will auto-sync from `acf-json/` folder
- Fields appear automatically when editing Services/Properties
- Optional: Visit ACF field group UI to verify, no manual setup needed

### 4. Flush Rewrite Rules
- Go to Settings → Permalinks
- Click "Save Changes" (no need to modify anything)
- This activates custom post type URLs

## File Structure

```
growmodo/
├── style.css                          # Theme header & styles
├── functions.php                      # ACF registration + theme setup
├── acf-helpers.php                    # Template helper functions
├── header.php                         # Header template
├── footer.php                         # Footer template
├── sidebar.php                        # Sidebar
├── index.php                          # Default template
├── single.php                         # Single post template
├── page.php                           # Page template
├── single-services.php                # Single service template
├── archive-services.php               # Services listing template
├── single-properties.php              # Single property template
├── archive-properties.php             # Properties listing template
├── acf-json/                          # ACF field group exports
│   ├── group_services_details.json    # Services field group
│   └── group_properties_details.json  # Properties field group
├── ACF_FIELDS_GUIDE.md               # Complete ACF field documentation
├── SETUP_GUIDE.md                    # Initial setup guide
└── README_GROWMODO.md                # This file
```

## Quick Start

### Creating a Service

1. WordPress Admin → Services → Add New
2. Fill in title and description
3. Scroll down → "Service Details" section
4. Fill in:
   - Service Description
   - Service Price (e.g., "$99.00")
   - Duration/Timeline
   - Service Icon/Image
   - CTA Button Text & Link
   - Service Features (add via repeater)
5. Publish

### Creating a Property

1. WordPress Admin → Properties → Add New
2. Fill in title and description
3. Scroll down → "Property Details" section
4. Fill in:
   - Property Price
   - Price Display Label (optional)
   - Status (Available, Pending, Sold, Rented)
   - Full Address
   - City, State, Zip
   - Bedrooms, Bathrooms, Square Footage
   - Property Gallery (drag-drop images)
   - Property Features/Amenities
   - Agent Contact Info
5. Publish

## Template Usage

### Using ACF Helper Functions

Display data in templates using helper functions from `acf-helpers.php`:

```php
<!-- Service Price -->
<?php echo esc_html( blankslate_get_service_price() ); ?>

<!-- Property Gallery -->
<?php blankslate_the_property_gallery(); ?>

<!-- Agent Contact Card -->
<?php blankslate_the_agent_contact_card(); ?>
```

See `ACF_FIELDS_GUIDE.md` for complete function reference and examples.

### Direct ACF Usage

You can also use ACF functions directly:

```php
<?php
$price = get_field( 'property_price' );
echo 'Price: $' . number_format( $price );
?>
```

## ACF Field Groups

### Services Field Group
- Service Description (Textarea)
- Service Price (Text)
- Duration/Timeline (Text)
- Service Icon/Image (Image)
- CTA Button Text (Text)
- CTA Button Link (Link)
- Service Features (Repeater)

### Properties Field Group
- Property Price (Number)
- Price Display Label (Text)
- Status (Select)
- Full Address (Textarea)
- City, State, Zip (Text fields)
- Bedrooms, Bathrooms, Sqft (Numbers)
- Lot Size (Text)
- Year Built (Number)
- Property Gallery (Gallery)
- Property Features/Amenities (Repeater)
- Agent Name, Email, Phone, Link

## Bootstrap 5 Integration

The theme includes Bootstrap 5.3.0 via CDN:

- **CSS:** `https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css`
- **JS:** `https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js`

Use Bootstrap classes in templates:

```php
<div class="container">
  <div class="row">
    <div class="col-md-6"><!-- Content --></div>
    <div class="col-md-6"><!-- Content --></div>
  </div>
</div>
```

[Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/)

## Customization

### Modifying Templates

Edit template files to match your design:
- `single-services.php` — Individual service page
- `archive-services.php` — Services listing
- `single-properties.php` — Individual property page
- `archive-properties.php` — Properties listing

### Adding Custom Styles

Add custom CSS at the end of `style.css`:

```css
/* Custom Service Card Styling */
.service-card {
  border-radius: 8px;
  transition: transform 0.2s;
}

.service-card:hover {
  transform: translateY(-5px);
}
```

### Extending ACF Fields

To add more fields to Services or Properties:
1. Edit `functions.php`
2. Find the ACF field group registration function
3. Add new field arrays to the `fields` array
4. Update `acf-helpers.php` if needed with new helper functions

## Troubleshooting

**ACF Fields not showing?**
- Ensure ACF plugin is activated
- Clear cache (if using caching plugin)
- Reload the post edit page

**Custom post types not appearing?**
- Go to Settings → Permalinks → Save Changes
- Check that functions.php is loaded without errors

**Bootstrap not styling?**
- Verify `bootstrap-css` and `bootstrap-js` load in page source
- Check browser console for JS errors

**ACF JSON not syncing?**
- Verify `acf-json/` folder exists and is writable
- Check ACF settings: ACF → Settings → ACF JSON
- Ensure folder permissions are 755

## Documentation

- **ACF_FIELDS_GUIDE.md** — Complete field documentation with examples
- **SETUP_GUIDE.md** — Initial setup instructions
- [Bootstrap 5 Docs](https://getbootstrap.com/)
- [ACF Documentation](https://www.advancedcustomfields.com/)
- [WordPress Theme Development](https://developer.wordpress.org/themes/)

## Support

For issues or questions:
1. Check the ACF_FIELDS_GUIDE.md
2. Review template examples in single-services.php and single-properties.php
3. Check Advanced Custom Fields plugin documentation
4. Review WordPress theme development docs

## Version History

**1.0.0** (May 2026)
- Initial release
- Services post type with ACF fields
- Properties post type with ACF fields
- Bootstrap 5 integration
- Template helper functions
- ACF JSON exports

## License

GNU General Public License v3 or Later
[https://www.gnu.org/licenses/gpl.html](https://www.gnu.org/licenses/gpl.html)


=== BlankSlate ===

Contributors: webguyio
Donate link: https://opencollective.com/blankslate
Theme link: https://opencollective.com/blankslate
Tags: accessibility-ready, one-column, two-columns, custom-menu, featured-images, microformats, sticky-post, threaded-comments, translation-ready
Requires at least: 5.2
Tested up to: 6.8
Stable tag: trunk
License: GNU General Public License v3 or Later
License URI: https://www.gnu.org/licenses/gpl.html

== Description ==

YOU MAY DELETE THIS FILE AND ANY OTHER FILE(S) BEFORE STARTING YOUR PROJECT

BlankSlate is the definitive WordPress boilerplate starter theme. I've carefully constructed the most clean and minimalist theme possible for designers and developers to use as a base to build websites for clients or to build completely custom themes from scratch. Clean, simple, unstyled, semi-minified, unformatted, and valid code, SEO-friendly, jQuery-enabled, no programmer comments, standardized and as white label as possible, and most importantly, the CSS is reset for cross-browser-compatability, with no intrusive visual CSS styles added whatsoever. A perfect skeleton theme. For support and suggestions, go to: https://github.com/webguyio/blankslate/issues. Thank you.

If you're creating your own theme or client project, open up all files and do a "Find and Replace All" on the word "blankslate" with your own project name.

Learn about more ways to use BlankSlate and precautions to take at: https://blankslate.me/.

=== License ===

In its unchanged and original state:

BlankSlate WordPress Theme 2011-2026
BlankSlate is distributed under the terms of the GNU GPL

The BlankSlate theme package and all files contained within are distributed under the terms of the GNU GPL v3 or Later (https://www.gnu.org/licenses/gpl.html).

Once you've significantly changed the theme to build your own unique project, either for yourself or for a client under a different theme name (as is encouraged), you're entirely welcome to copyright and license that project as you see fit.
