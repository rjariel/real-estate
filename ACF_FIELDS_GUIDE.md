# ACF Fields Guide - Services & Properties

## Overview

ACF (Advanced Custom Fields) field groups have been registered programmatically in `functions.php`. The fields appear automatically when editing Services or Properties posts—**no manual setup needed**.

**Note:** This requires the [Advanced Custom Fields](https://www.advancedcustomfields.com/) plugin to be active.

---

## Services Post Type Fields

### Basic Information
- **Service Description** (Textarea) — Extended details about the service
- **Service Price** (Text) — e.g., "$99.00" or "Starting at $50"
- **Duration/Timeline** (Text) — e.g., "2-3 weeks" or "Same day"
- **Service Icon/Image** (Image) — Visual representation (200x200px recommended)

### Call-to-Action
- **CTA Button Text** (Text) — Button label (default: "Get Started")
- **CTA Button Link** (Link) — Where button points to

### Features
- **Service Features** (Repeater) — Add multiple features with:
  - **Title** — Feature name
  - **Description** — Feature details
  - **Icon** — Dashicon name (e.g., "dashicons-yes")

---

## Properties Post Type Fields

### Pricing & Status
- **Property Price** (Number) — Enter as number (e.g., 350000)
- **Price Display Label** (Text) — Prefix like "Starting from" or "Price reduced"
- **Status** (Select) — Available, Pending, Sold, Rented

### Location
- **Full Address** (Textarea) — Complete property address
- **City** (Text)
- **State/Province** (Text)
- **Zip/Postal Code** (Text)

### Property Specs
- **Bedrooms** (Number)
- **Bathrooms** (Number) — supports .5 increments
- **Square Footage** (Number)
- **Lot Size** (Text) — e.g., "0.5 acres"
- **Year Built** (Number)

### Media & Features
- **Property Gallery** (Gallery) — Upload multiple photos
- **Property Features/Amenities** (Repeater) — List amenities like:
  - Swimming Pool
  - Garage
  - Fireplace
  - Etc.

### Agent/Contact
- **Agent/Contact Name** (Text)
- **Agent Email** (Email)
- **Agent Phone** (Text)
- **Agent Profile Link** (Link)

---

## Template Usage

### Using Helper Functions

Helper functions in `acf-helpers.php` simplify displaying ACF data in templates.

#### Service Examples

```php
<!-- Display Service Price -->
<p><strong><?php echo esc_html( blankslate_get_service_price() ); ?></strong></p>

<!-- Display Service Duration -->
<p>Timeline: <?php echo esc_html( blankslate_get_service_duration() ); ?></p>

<!-- Display Service Description -->
<div><?php echo wp_kses_post( blankslate_get_service_description() ); ?></div>

<!-- Display Service Icon -->
<figure class="service-icon">
  <?php blankslate_the_service_icon(); ?>
</figure>

<!-- Display Service Features -->
<div class="features">
  <?php blankslate_the_service_features(); ?>
</div>

<!-- Display CTA Button -->
<div class="cta-section">
  <?php echo blankslate_get_service_cta_button(); ?>
</div>
```

#### Property Examples

```php
<!-- Display Property Price -->
<h3 class="price"><?php echo esc_html( blankslate_get_property_price() ); ?></h3>

<!-- Display Status Badge -->
<span class="badge bg-info">
  <?php echo esc_html( blankslate_get_property_status() ); ?>
</span>

<!-- Display Address -->
<p><?php echo esc_html( blankslate_get_property_address() ); ?></p>

<!-- Display Specs (Bedrooms, Bathrooms, Sqft) -->
<p class="specs">
  <?php echo esc_html( blankslate_get_property_specs() ); ?>
</p>

<!-- Display Property Gallery -->
<div class="property-gallery">
  <?php blankslate_the_property_gallery(); ?>
</div>

<!-- Display Features/Amenities -->
<div class="amenities">
  <h4>Amenities</h4>
  <?php blankslate_the_property_features(); ?>
</div>

<!-- Display Agent Contact Card -->
<aside class="agent-card">
  <?php blankslate_the_agent_contact_card(); ?>
</aside>
```

### Direct ACF Usage (If No Helper Exists)

```php
<!-- Get any field value directly -->
<?php 
$price = get_field( 'property_price' );
echo 'Price: $' . number_format( $price );
?>

<!-- Loop through repeater field -->
<?php
if ( have_rows( 'service_features' ) ) {
  while ( have_rows( 'service_features' ) ) {
    the_row();
    echo get_sub_field( 'title' );
  }
}
?>
```

---

## Example: Complete Service Template

```php
<?php
// single-services.php
get_header();
?>

<main class="container py-5">
  <article class="row">
    <!-- Sidebar Icon -->
    <aside class="col-md-3">
      <figure class="text-center">
        <?php blankslate_the_service_icon(); ?>
      </figure>
    </aside>

    <!-- Main Content -->
    <div class="col-md-9">
      <h1><?php the_title(); ?></h1>
      
      <p class="lead">
        <?php echo esc_html( blankslate_get_service_description() ); ?>
      </p>

      <div class="row mb-4">
        <div class="col-sm-6">
          <strong>Price:</strong><br>
          <?php echo esc_html( blankslate_get_service_price() ); ?>
        </div>
        <div class="col-sm-6">
          <strong>Timeline:</strong><br>
          <?php echo esc_html( blankslate_get_service_duration() ); ?>
        </div>
      </div>

      <h3>What's Included</h3>
      <?php blankslate_the_service_features(); ?>

      <div class="mt-4">
        <?php echo blankslate_get_service_cta_button(); ?>
      </div>

      <div class="mt-5 pt-5 border-top">
        <?php the_content(); ?>
      </div>
    </div>
  </article>
</main>

<?php get_footer();
```

---

## Example: Complete Property Template

```php
<?php
// single-properties.php
get_header();
?>

<main class="container py-5">
  <article>
    <!-- Price Badge -->
    <div class="mb-3">
      <h1 class="d-inline"><?php the_title(); ?></h1>
      <span class="badge bg-info float-end">
        <?php echo esc_html( blankslate_get_property_status() ); ?>
      </span>
    </div>

    <!-- Price -->
    <h2 class="text-success mb-4">
      <?php echo esc_html( blankslate_get_property_price() ); ?>
    </h2>

    <!-- Address -->
    <address class="mb-4">
      <?php echo nl2br( esc_html( blankslate_get_property_address() ) ); ?>
    </address>

    <!-- Specs -->
    <div class="alert alert-light">
      <strong>Property Details:</strong><br>
      <?php echo esc_html( blankslate_get_property_specs() ); ?>
      <?php if ( $lot = blankslate_get_property_lot_size() ) : ?>
        • <?php echo esc_html( $lot ); ?>
      <?php endif; ?>
      <?php if ( $year = blankslate_get_property_year_built() ) : ?>
        • Built <?php echo esc_html( $year ); ?>
      <?php endif; ?>
    </div>

    <!-- Gallery -->
    <div class="mb-5">
      <h3>Photos</h3>
      <?php blankslate_the_property_gallery(); ?>
    </div>

    <!-- Amenities -->
    <div class="mb-5">
      <h3>Amenities</h3>
      <?php blankslate_the_property_features(); ?>
    </div>

    <!-- Description -->
    <div class="mb-5">
      <?php the_content(); ?>
    </div>

    <!-- Agent Card -->
    <div class="row">
      <div class="col-md-4">
        <?php blankslate_the_agent_contact_card(); ?>
      </div>
    </div>
  </article>
</main>

<?php get_footer();
```

---

## Installation Requirements

1. **Install ACF Plugin:**
   - Go to WordPress Admin → Plugins → Add New
   - Search for "Advanced Custom Fields"
   - Install and activate the free version (or Pro for more features)

2. **Verify Fields Appear:**
   - Edit any Services post
   - Scroll down—you'll see the "Service Details" section with all fields
   - Same for Properties—look for "Property Details" section

3. **Start Filling Data:**
   - Enter service/property info
   - Publish/Update the post
   - Fields are now accessible in templates via helper functions

---

## Field Validation

- **Price fields** — Accept text or numbers; helper functions format them
- **Gallery fields** — Accept multiple images
- **Repeater fields** — Add/remove items as needed in the editor
- **Link fields** — ACF handles URL validation automatically
- **All fields optional** — Nothing is required; fill what you need

---

## Troubleshooting

**Fields not showing?**
- Ensure ACF plugin is activated (Plugins → Active)
- Clear WordPress cache if using a caching plugin
- Reload the post edit page

**Helper functions not working?**
- Verify `acf-helpers.php` is in the theme root directory
- Check that `functions.php` includes it (line 2: `require_once...`)

**ACF says plugin not found?**
- ACF registration is built into `functions.php` and will show errors only if ACF is not active
- The field groups are registered but won't display without the plugin

---

## Field Definitions (Reference)

For developers: Field definitions are in `functions.php` in the `blankslate_register_services_acf_fields()` and `blankslate_register_properties_acf_fields()` functions. All fields are registered via `acf_add_local_field_group()` with full ACF configuration.
