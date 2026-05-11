# Growmodo Theme - Deployment Guide

**Package:** `growmodo-theme.zip` | **Version:** 1.0.0 | **Size:** ~176 KB

## What's Included

```
growmodo-theme.zip
└── growmodo/
    ├── Core Theme Files
    │   ├── functions.php              ← ACF registration + theme setup
    │   ├── style.css                  ← Theme styles + Bootstrap integration
    │   ├── header.php, footer.php     ← Header/footer templates
    │   └── [other WordPress templates]
    │
    ├── Custom Post Type Templates
    │   ├── single-services.php        ← Individual service page
    │   ├── archive-services.php       ← Services listing
    │   ├── single-properties.php      ← Individual property page
    │   └── archive-properties.php     ← Properties listing
    │
    ├── ACF Integration
    │   ├── acf-helpers.php            ← 20+ template helper functions
    │   └── acf-json/                  ← ACF field group exports
    │       ├── group_services_details.json
    │       └── group_properties_details.json
    │
    ├── Documentation
    │   ├── README_GROWMODO.md         ← Theme overview
    │   ├── ACF_FIELDS_GUIDE.md        ← Field documentation
    │   ├── SETUP_GUIDE.md             ← Initial setup guide
    │   └── DEPLOYMENT_GUIDE.md        ← This file
    │
    └── Assets
        └── screenshot.jpg             ← Theme preview image
```

## Installation Steps

### Step 1: Extract and Upload Theme

**Option A: Via FTP/File Manager**
1. Extract `growmodo-theme.zip` on your computer
2. Connect via FTP to your hosting
3. Navigate to `/wp-content/themes/`
4. Upload the `growmodo` folder
5. Verify all files are uploaded (should match ZIP contents above)

**Option B: Via WordPress Admin**
1. WordPress Admin → Appearance → Themes
2. Click "Add New" → "Upload Theme"
3. Select `growmodo-theme.zip`
4. Click "Install Now"
5. Click "Activate"

### Step 2: Install Advanced Custom Fields Plugin

**REQUIRED:** Theme needs ACF to display custom fields

1. WordPress Admin → Plugins → Add New
2. Search: "Advanced Custom Fields"
3. Find plugin by Elliot Condon (by Automattic)
4. Click "Install Now" → "Activate Plugin"

**Note:** Free version works fine; Pro has additional field types

### Step 3: Verify ACF Field Groups Load

With ACF activated, field groups auto-sync from `acf-json/` folder:

1. Go to WordPress Admin → ACF
2. Look for these field groups:
   - ✅ Service Details
   - ✅ Property Details
3. Both should be marked as **"Synced"** (green)
4. If not synced automatically:
   - Click "Sync Available"
   - Select both field groups
   - Click "Sync"

### Step 4: Flush Rewrite Rules

Activate custom post type URLs:

1. WordPress Admin → Settings → Permalinks
2. Click "Save Changes" (don't change anything)
3. Test URLs work:
   - `/services/` (should load Services archive)
   - `/properties/` (should load Properties archive)

### Step 5: Activate Theme (if not done in Step 1)

1. WordPress Admin → Appearance → Themes
2. Find "Growmodo"
3. Click "Activate"

## Post-Installation Checklist

- [ ] Theme uploaded to `/wp-content/themes/growmodo/`
- [ ] ACF plugin installed and activated
- [ ] Field groups synced (visible in ACF admin)
- [ ] Rewrite rules flushed (Settings → Permalinks → Save)
- [ ] Theme activated
- [ ] Test: Create a sample Service post
- [ ] Test: Create a sample Property post
- [ ] Test: Visit `/services/` and `/properties/` URLs

## Verifying Installation

### Check WordPress Admin

Service & Property post types visible in sidebar:
```
Dashboard
├── Posts
├── Pages
├── Services           ← Should appear here
├── Properties         ← Should appear here
└── ...
```

### Check ACF Fields

Edit any Services post → Scroll down:
```
┌─────────────────────────────┐
│ Service Details             │
├─────────────────────────────┤
│ Service Description         │
│ Service Price              │
│ Duration/Timeline          │
│ Service Icon/Image         │
│ CTA Button Text            │
│ CTA Button Link            │
│ Service Features           │
└─────────────────────────────┘
```

### Check Custom URLs

Visit these URLs in your browser:
- `yourdomain.com/services/` — Should show Services archive
- `yourdomain.com/properties/` — Should show Properties archive
- `yourdomain.com/services/sample-service/` — Single service (after creating one)

## Configuration

### Site URL & Permalinks

**Important:** If URLs show 404 errors after installation:

1. Verify site URL: Settings → General → Site Address
2. Check Permalinks: Settings → Permalinks → Save Changes
3. If still broken, try "Plain" permalinks, then switch back
4. Check `.htaccess` exists in WordPress root (if on Apache)

### Memory Limit

If you see memory errors with large galleries:

Add to `wp-config.php`:
```php
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
```

## File Permissions

For automatic ACF JSON syncing to work, theme folder needs write permissions:

**Typical permissions:**
```
/wp-content/themes/growmodo/        755
/wp-content/themes/growmodo/acf-json/ 755
```

If you can't write JSON files manually, contact hosting support to set permissions.

## Database

No database schema changes needed. Theme works with standard WordPress database + ACF.

**Tables used:**
- `wp_posts` (standard posts)
- `wp_postmeta` (ACF field values)
- `wp_terms` (custom taxonomies)

## Customization After Installation

### Modify Templates

Edit files in `/wp-content/themes/growmodo/`:
- `single-services.php` — Edit to change service page layout
- `archive-services.php` — Edit to change services list
- `style.css` — Add custom CSS

### Add More ACF Fields

Edit `functions.php` to add fields:
1. Find `blankslate_register_services_acf_fields()` function
2. Add new field arrays in the `fields` array
3. Save and reload admin
4. New fields appear on Service post edit page

## Troubleshooting

### ACF Fields Not Appearing

**Cause:** ACF plugin not activated
**Solution:**
1. Go to Plugins
2. Search for "Advanced Custom Fields"
3. Click "Activate"

**Cause:** Field groups not synced
**Solution:**
1. Go to ACF → Tools
2. Look for "Sync Available"
3. Click it and sync field groups

### 404 Errors on Custom Post Types

**Cause:** Rewrite rules not flushed
**Solution:**
1. Settings → Permalinks → Save Changes
2. If still broken: try "Plain", then back to "Post name"

### Theme Not Showing After Upload

**Cause:** Theme folder name wrong
**Solution:**
1. Verify folder is named `growmodo` (not `growmodo-theme`)
2. Reload Themes page (Appearance → Themes)

### ACF JSON Not Syncing

**Cause:** Write permissions missing
**Solution:**
1. FTP to `/wp-content/themes/growmodo/`
2. Right-click `acf-json` folder
3. Check permissions (should be 755)
4. If not, change via FTP or hosting control panel

## Performance Tips

### Images
- Compress images before uploading (especially in Property Gallery)
- Use "Optimize" on media uploads
- WordPress auto-generates thumbnails—fine to use

### Caching
- Install W3 Total Cache or WP Super Cache for faster pages
- Clear cache after updating templates

### CDN
- Bootstrap loads from CDN (fast)
- No need to cache-bust Bootstrap—CDN handles versioning

## Backing Up

After successful installation, backup:
1. `wp-content/themes/growmodo/` — Keep copy of theme
2. WordPress database — Use WordPress backup plugin
3. `/wp-content/uploads/` — All media files

## Support & Documentation

**Included Files:**
- `README_GROWMODO.md` — Feature overview
- `ACF_FIELDS_GUIDE.md` — Complete field documentation
- `SETUP_GUIDE.md` — Initial setup instructions

**External Resources:**
- [Advanced Custom Fields Docs](https://www.advancedcustomfields.com/resources/)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/)
- [WordPress Theme Development](https://developer.wordpress.org/themes/)

## Common Issues & Solutions

| Issue | Cause | Solution |
|-------|-------|----------|
| Fields not showing on post edit | ACF not activated | Activate ACF plugin |
| 404 errors on /services/ URL | Rewrite rules not flushed | Settings → Permalinks → Save |
| Theme not appearing in theme list | Folder name wrong or upload incomplete | Check folder is named `growmodo` and all files uploaded |
| Gallery not uploading images | PHP memory limit too low | Increase PHP memory to 256MB |
| Slow page loads | No caching | Install W3 Total Cache plugin |
| JSON sync permission denied | File permissions wrong | Set folder to 755 via FTP |

## Next Steps

1. ✅ Install theme
2. ✅ Activate ACF plugin
3. ✅ Verify field groups synced
4. ✅ Flush rewrite rules
5. 📝 Create sample Services/Properties
6. 🎨 Customize templates to match your design
7. 📱 Test responsive design on mobile
8. 🚀 Go live!

## Version Information

- **Theme Version:** 1.0.0
- **WordPress Minimum:** 5.2
- **PHP Minimum:** 7.4
- **ACF Minimum:** 5.11 (Free) or 5.13 (Pro)
- **Bootstrap Version:** 5.3.0 (CDN)

---

**Installation Date:** [Your Date]  
**Deployed By:** [Your Name]  
**Notes:** [Any custom notes]
