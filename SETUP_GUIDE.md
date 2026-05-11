# Blankslate Theme - Setup Guide

## What's Been Added

### 1. **Bootstrap 5.3.0 (CDN)**
- CSS loaded from CDN (JSDelivr): `https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css`
- JS Bundle loaded in footer: `https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js`
- Both are enqueued properly in `functions.php`
- Use Bootstrap classes directly in your templates

### 2. **Custom Post Types**

#### Services
- **Slug**: `services`
- **URL**: `/services/` archive, `/services/service-name/` single
- **Features**: Title, Editor, Author, Thumbnails, Excerpts, Custom Fields (ACF compatible)
- **Icon**: Briefcase (dashicons)
- **Menu Position**: 5 (below Posts)
- **Taxonomy**: Services Category (hierarchical)

#### Properties  
- **Slug**: `properties`
- **URL**: `/properties/` archive, `/properties/property-name/` single
- **Features**: Title, Editor, Author, Thumbnails, Excerpts, Custom Fields (ACF compatible)
- **Icon**: Building (dashicons)
- **Menu Position**: 6 (below Services)
- **Taxonomy**: Property Types (hierarchical)

### 3. **Custom Taxonomies**

#### Services Category
- Hierarchical (supports parent/child)
- Rewrite slug: `service-category`

#### Property Types
- Hierarchical (supports parent/child)
- Rewrite slug: `property-type`

## What You Need to Do

### Step 1: Activate the Changes
Since you added these post types, you should flush WordPress rewrite rules:
1. Go to **WordPress Admin → Settings → Permalinks**
2. Click **Save Changes** (even without making changes)
3. This activates the custom post type URLs

### Step 2: Create Templates (Optional but Recommended)
For best UX, create dedicated template files:

```
/themes/blankslate/
├── single-services.php      (individual service pages)
├── archive-services.php     (services listing)
├── single-properties.php    (individual property pages)
└── archive-properties.php   (properties listing)
```

### Step 3: Start Using Bootstrap
Use Bootstrap grid and components in your templates:

```php
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <!-- content -->
    </div>
  </div>
</div>
```

### Step 4: ACF Integration (Optional)
If you want to add flexible fields to Services or Properties:
1. Install Advanced Custom Fields (free or Pro)
2. Create field groups assigned to `services` or `properties` post types
3. Fields will appear in the WordPress editor

## Key Functions Added to functions.php

- `blankslate_enqueue_bootstrap()` — Loads Bootstrap CSS
- `blankslate_enqueue_bootstrap_js()` — Loads Bootstrap JS
- `blankslate_register_services_post_type()` — Services CPT
- `blankslate_register_properties_post_type()` — Properties CPT
- `blankslate_register_services_taxonomy()` — Services Category taxonomy
- `blankslate_register_properties_taxonomy()` — Property Types taxonomy
- `blankslate_flush_rewrite_rules()` — Resets URLs on theme activation

## Quick Testing

In WordPress Admin:
1. You should see **Services** and **Properties** in the sidebar menu
2. Under each, you'll see **Services/Properties** and **Service Categories/Property Types**
3. Try creating a test service/property post
4. Visit `/services/` or `/properties/` to confirm URLs work

## Documentation Links
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/)
- [WordPress Custom Post Types](https://developer.wordpress.org/plugins/post-types/)
- [ACF Documentation](https://www.advancedcustomfields.com/resources/)
