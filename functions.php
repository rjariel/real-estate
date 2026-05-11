<?php
// Load ACF helper functions
require_once get_template_directory() . '/acf-helpers.php';

add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup() {
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );
add_theme_support( 'html5', array( 'search-form', 'comment-list', 'comment-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'editor-styles' );
add_editor_style( 'editor-style.css' );
add_theme_support( 'appearance-tools' );
add_theme_support( 'woocommerce' );
global $content_width;
if ( !isset( $content_width ) ) {
$content_width = 1920;
}
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );
}
add_action( 'admin_notices', 'blankslate_notice' );
function blankslate_notice() {
$user_id = get_current_user_id();
if ( !$user_id || !current_user_can( 'manage_options' ) || get_user_meta( $user_id, 'blankslate_notice_dismissed_2026', true ) ) {
return;
}
$dismiss_url = add_query_arg( array( 'blankslate_dismiss' => '1', 'blankslate_nonce' => wp_create_nonce( 'blankslate_dismiss_notice' ) ), admin_url() );
echo '<div class="notice notice-info"><p><a href="' . esc_url( $dismiss_url ) . '" class="alignright" style="text-decoration:none"><big>' . esc_html__( '×', 'blankslate' ) . '</big></a><big><strong>' . esc_html__( '📝 Thank you for using BlankSlate!', 'blankslate' ) . '</strong></big><p>' . esc_html__( 'Powering over 10k websites! Buy me a sandwich! 🥪', 'blankslate' ) . '</p><a href="https://github.com/webguyio/blankslate/issues/57" class="button-primary" target="_blank" rel="noopener noreferrer"><strong>' . esc_html__( 'How do you use BlankSlate?', 'blankslate' ) . '</strong></a> <a href="https://opencollective.com/blankslate" class="button-primary" style="background-color:green;border-color:green" target="_blank" rel="noopener noreferrer"><strong>' . esc_html__( 'Donate', 'blankslate' ) . '</strong></a> <a href="https://wordpress.org/support/theme/blankslate/reviews/#new-post" class="button-primary" style="background-color:purple;border-color:purple" target="_blank" rel="noopener noreferrer"><strong>' . esc_html__( 'Review', 'blankslate' ) . '</strong></a> <a href="https://github.com/webguyio/blankslate/issues" class="button-primary" style="background-color:orange;border-color:orange" target="_blank" rel="noopener noreferrer"><strong>' . esc_html__( 'Support', 'blankslate' ) . '</strong></a></p></div>';
}
add_action( 'admin_init', 'blankslate_notice_dismissed' );
function blankslate_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['blankslate_dismiss'], $_GET['blankslate_nonce'] ) && wp_verify_nonce( $_GET['blankslate_nonce'], 'blankslate_dismiss_notice' ) && current_user_can( 'manage_options' ) ) {
add_user_meta( $user_id, 'blankslate_notice_dismissed_2026', 'true', true );
}
}
add_action( 'wp_enqueue_scripts', 'blankslate_enqueue' );
function blankslate_enqueue() {
wp_enqueue_style( 'blankslate-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'blankslate_footer' );
function blankslate_footer() {
?>
<script>
(function() {
const ua = navigator.userAgent.toLowerCase();
const html = document.documentElement;
if (/(iphone|ipod|ipad)/.test(ua)) {
html.classList.add('ios', 'mobile');
}
else if (/android/.test(ua)) {
html.classList.add('android', 'mobile');
}
else {
html.classList.add('desktop');
}
if (/chrome/.test(ua) && !/edg|brave/.test(ua)) {
html.classList.add('chrome');
}
else if (/safari/.test(ua) && !/chrome/.test(ua)) {
html.classList.add('safari');
}
else if (/edg/.test(ua)) {
html.classList.add('edge');
}
else if (/firefox/.test(ua)) {
html.classList.add('firefox');
}
else if (/brave/.test(ua)) {
html.classList.add('brave');
}
else if (/opr|opera/.test(ua)) {
html.classList.add('opera');
}
})();
</script>
<?php
}
add_filter( 'document_title_separator', 'blankslate_document_title_separator' );
function blankslate_document_title_separator( $sep ) {
$sep = esc_html( '|' );
return $sep;
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return esc_html( '...' );
} else {
return wp_kses_post( $title );
}
}
function blankslate_schema_type() {
$schema = 'https://schema.org/';
if ( is_single() ) {
$type = "Article";
} elseif ( is_author() ) {
$type = 'ProfilePage';
} elseif ( is_search() ) {
$type = 'SearchResultsPage';
} else {
$type = 'WebPage';
}
echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
add_filter( 'nav_menu_link_attributes', 'blankslate_schema_url', 10 );
function blankslate_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'blankslate_wp_body_open' ) ) {
function blankslate_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'blankslate_skip_link', 5 );
function blankslate_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'blankslate' ) . '</a>';
}
add_filter( 'the_content_more_link', 'blankslate_read_more_link' );
function blankslate_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'blankslate_excerpt_read_more_link' );
function blankslate_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'blankslate_image_insert_override' );
function blankslate_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
unset( $sizes['1536x1536'] );
unset( $sizes['2048x2048'] );
return $sizes;
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'blankslate_pingback_header' );
function blankslate_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function blankslate_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'blankslate_comment_count', 0 );
function blankslate_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

/**
 * ============================================================================
 * BOOTSTRAP CDN & CUSTOM POST TYPES
 * ============================================================================
 */

/**
 * Enqueue Bootstrap 5 CSS from CDN
 */
add_action( 'wp_enqueue_scripts', 'blankslate_enqueue_bootstrap', 5 );
function blankslate_enqueue_bootstrap() {
wp_enqueue_style(
'bootstrap-css',
'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
array(),
'5.3.0'
);
}

/**
 * Enqueue Bootstrap 5 JS Bundle from CDN (footer)
 */
add_action( 'wp_footer', 'blankslate_enqueue_bootstrap_js', 20 );
function blankslate_enqueue_bootstrap_js() {
wp_enqueue_script(
'bootstrap-js',
'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
array(),
'5.3.0',
true
);
}

/**
 * Register Custom Post Type: Services
 */
add_action( 'init', 'blankslate_register_services_post_type' );
function blankslate_register_services_post_type() {
$labels = array(
'name'                  => esc_html_x( 'Services', 'Post type general name', 'blankslate' ),
'singular_name'         => esc_html_x( 'Service', 'Post type singular name', 'blankslate' ),
'menu_name'             => esc_html_x( 'Services', 'Admin Menu text', 'blankslate' ),
'name_admin_bar'        => esc_html_x( 'Service', 'Add New on Toolbar', 'blankslate' ),
'add_new'               => esc_html__( 'Add New', 'blankslate' ),
'add_new_item'          => esc_html__( 'Add New Service', 'blankslate' ),
'new_item'              => esc_html__( 'New Service', 'blankslate' ),
'edit_item'             => esc_html__( 'Edit Service', 'blankslate' ),
'view_item'             => esc_html__( 'View Service', 'blankslate' ),
'all_items'             => esc_html__( 'All Services', 'blankslate' ),
'search_items'          => esc_html__( 'Search Services', 'blankslate' ),
'not_found'             => esc_html__( 'No services found.', 'blankslate' ),
'not_found_in_trash'    => esc_html__( 'No services found in Trash.', 'blankslate' ),
);

$args = array(
'labels'             => $labels,
'description'        => esc_html__( 'Services offered by the business', 'blankslate' ),
'public'             => true,
'publicly_queryable' => true,
'show_ui'            => true,
'show_in_menu'       => true,
'show_in_rest'       => true,
'query_var'          => true,
'rewrite'            => array( 'slug' => 'services' ),
'capability_type'    => 'post',
'has_archive'        => true,
'hierarchical'       => false,
'menu_position'      => 5,
'menu_icon'          => 'dashicons-briefcase',
'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
'taxonomies'         => array( 'services_category' ),
);

register_post_type( 'services', $args );
}

/**
 * Register Custom Post Type: Properties
 */
add_action( 'init', 'blankslate_register_properties_post_type' );
function blankslate_register_properties_post_type() {
$labels = array(
'name'                  => esc_html_x( 'Properties', 'Post type general name', 'blankslate' ),
'singular_name'         => esc_html_x( 'Property', 'Post type singular name', 'blankslate' ),
'menu_name'             => esc_html_x( 'Properties', 'Admin Menu text', 'blankslate' ),
'name_admin_bar'        => esc_html_x( 'Property', 'Add New on Toolbar', 'blankslate' ),
'add_new'               => esc_html__( 'Add New', 'blankslate' ),
'add_new_item'          => esc_html__( 'Add New Property', 'blankslate' ),
'new_item'              => esc_html__( 'New Property', 'blankslate' ),
'edit_item'             => esc_html__( 'Edit Property', 'blankslate' ),
'view_item'             => esc_html__( 'View Property', 'blankslate' ),
'all_items'             => esc_html__( 'All Properties', 'blankslate' ),
'search_items'          => esc_html__( 'Search Properties', 'blankslate' ),
'not_found'             => esc_html__( 'No properties found.', 'blankslate' ),
'not_found_in_trash'    => esc_html__( 'No properties found in Trash.', 'blankslate' ),
);

$args = array(
'labels'             => $labels,
'description'        => esc_html__( 'Real estate properties', 'blankslate' ),
'public'             => true,
'publicly_queryable' => true,
'show_ui'            => true,
'show_in_menu'       => true,
'show_in_rest'       => true,
'query_var'          => true,
'rewrite'            => array( 'slug' => 'properties' ),
'capability_type'    => 'post',
'has_archive'        => true,
'hierarchical'       => false,
'menu_position'      => 6,
'menu_icon'          => 'dashicons-building',
'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
'taxonomies'         => array( 'properties_type' ),
);

register_post_type( 'properties', $args );
}

/**
 * Register Custom Taxonomy: Services Category
 */
add_action( 'init', 'blankslate_register_services_taxonomy' );
function blankslate_register_services_taxonomy() {
$labels = array(
'name'              => esc_html_x( 'Service Categories', 'taxonomy general name', 'blankslate' ),
'singular_name'     => esc_html_x( 'Service Category', 'taxonomy singular name', 'blankslate' ),
'search_items'      => esc_html__( 'Search Service Categories', 'blankslate' ),
'all_items'         => esc_html__( 'All Service Categories', 'blankslate' ),
'parent_item'       => esc_html__( 'Parent Service Category', 'blankslate' ),
'edit_item'         => esc_html__( 'Edit Service Category', 'blankslate' ),
'add_new_item'      => esc_html__( 'Add New Service Category', 'blankslate' ),
'menu_name'         => esc_html__( 'Service Categories', 'blankslate' ),
);

$args = array(
'hierarchical'      => true,
'labels'            => $labels,
'show_ui'           => true,
'show_admin_column' => true,
'query_var'         => true,
'rewrite'           => array( 'slug' => 'service-category' ),
'show_in_rest'      => true,
);

register_taxonomy( 'services_category', array( 'services' ), $args );
}

/**
 * Register Custom Taxonomy: Properties Type
 */
add_action( 'init', 'blankslate_register_properties_taxonomy' );
function blankslate_register_properties_taxonomy() {
$labels = array(
'name'              => esc_html_x( 'Property Types', 'taxonomy general name', 'blankslate' ),
'singular_name'     => esc_html_x( 'Property Type', 'taxonomy singular name', 'blankslate' ),
'search_items'      => esc_html__( 'Search Property Types', 'blankslate' ),
'all_items'         => esc_html__( 'All Property Types', 'blankslate' ),
'parent_item'       => esc_html__( 'Parent Property Type', 'blankslate' ),
'edit_item'         => esc_html__( 'Edit Property Type', 'blankslate' ),
'add_new_item'      => esc_html__( 'Add New Property Type', 'blankslate' ),
'menu_name'         => esc_html__( 'Property Types', 'blankslate' ),
);

$args = array(
'hierarchical'      => true,
'labels'            => $labels,
'show_ui'           => true,
'show_admin_column' => true,
'query_var'         => true,
'rewrite'           => array( 'slug' => 'property-type' ),
'show_in_rest'      => true,
);

register_taxonomy( 'properties_type', array( 'properties' ), $args );
}

/**
 * Flush rewrite rules after theme activation
 */
add_action( 'after_switch_theme', 'blankslate_flush_rewrite_rules' );
function blankslate_flush_rewrite_rules() {
blankslate_register_services_post_type();
blankslate_register_properties_post_type();
blankslate_register_services_taxonomy();
blankslate_register_properties_taxonomy();
flush_rewrite_rules();
}

/**
 * ============================================================================
 * ACF FIELD GROUPS - Services & Properties
 * ============================================================================
 */

/**
 * Register ACF Fields for Services Post Type
 */
add_action( 'acf/include_fields', 'blankslate_register_services_acf_fields' );
function blankslate_register_services_acf_fields() {
if ( ! function_exists( 'acf_add_local_field_group' ) ) {
return;
}

acf_add_local_field_group( array(
'key' => 'group_services_details',
'title' => 'Service Details',
'fields' => array(
array(
'key' => 'field_service_description',
'label' => 'Service Description',
'name' => 'service_description',
'type' => 'textarea',
'instructions' => 'Detailed description of the service',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'rows' => 4,
'new_lines' => 'wpautop',
),
array(
'key' => 'field_service_price',
'label' => 'Service Price',
'name' => 'service_price',
'type' => 'text',
'instructions' => 'e.g., $99.00 or "Starting at $50"',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
'placeholder' => '$0.00',
),
array(
'key' => 'field_service_duration',
'label' => 'Duration/Timeline',
'name' => 'service_duration',
'type' => 'text',
'instructions' => 'e.g., "2-3 weeks" or "Same day service"',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
'placeholder' => 'e.g., 2-3 weeks',
),
array(
'key' => 'field_service_icon',
'label' => 'Service Icon/Image',
'name' => 'service_icon',
'type' => 'image',
'instructions' => 'Small icon or image (recommended: 200x200px)',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
'return_format' => 'array',
'preview_size' => 'thumbnail',
'library' => 'all',
),
array(
'key' => 'field_service_cta_text',
'label' => 'CTA Button Text',
'name' => 'service_cta_text',
'type' => 'text',
'instructions' => 'E.g., "Get Started", "Learn More", "Book Now"',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
'placeholder' => 'Get Started',
),
array(
'key' => 'field_service_cta_link',
'label' => 'CTA Button Link',
'name' => 'service_cta_link',
'type' => 'link',
'instructions' => 'Where the button points to',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'return_format' => 'array',
),
array(
'key' => 'field_service_features',
'label' => 'Service Features',
'name' => 'service_features',
'type' => 'repeater',
'instructions' => 'Add key features or benefits of this service',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'collapsed' => 'field_feature_title',
'min' => 0,
'max' => 0,
'layout' => 'table',
'button_label' => '+ Add Feature',
'sub_fields' => array(
array(
'key' => 'field_feature_title',
'label' => 'Feature Title',
'name' => 'title',
'type' => 'text',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
),
array(
'key' => 'field_feature_description',
'label' => 'Feature Description',
'name' => 'description',
'type' => 'textarea',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
'rows' => 2,
),
array(
'key' => 'field_feature_icon',
'label' => 'Feature Icon (optional)',
'name' => 'icon',
'type' => 'text',
'instructions' => 'Dashicon name (e.g., "dashicons-yes", "dashicons-star-filled")',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'placeholder' => 'dashicons-yes',
),
),
),
),
'location' => array(
array(
array(
'param' => 'post_type',
'operator' => '==',
'value' => 'services',
),
),
),
'menu_order' => 0,
'position' => 'normal',
'style' => 'default',
'label_placement' => 'top',
'instruction_placement' => 'label',
) );
}

/**
 * Register ACF Fields for Properties Post Type
 */
add_action( 'acf/include_fields', 'blankslate_register_properties_acf_fields' );
function blankslate_register_properties_acf_fields() {
if ( ! function_exists( 'acf_add_local_field_group' ) ) {
return;
}

acf_add_local_field_group( array(
'key' => 'group_properties_details',
'title' => 'Property Details',
'fields' => array(
array(
'key' => 'field_property_price',
'label' => 'Property Price',
'name' => 'property_price',
'type' => 'number',
'instructions' => 'Enter price as a number (e.g., 350000)',
'required' => 0,
'wrapper' => array( 'width' => '33.33' ),
'min' => 0,
'step' => 1000,
),
array(
'key' => 'field_property_price_label',
'label' => 'Price Display Label',
'name' => 'property_price_label',
'type' => 'text',
'instructions' => 'E.g., "Starting from", "Price reduced", "Contact for price"',
'required' => 0,
'wrapper' => array( 'width' => '33.33' ),
'placeholder' => 'Starting from',
),
array(
'key' => 'field_property_status',
'label' => 'Status',
'name' => 'property_status',
'type' => 'select',
'instructions' => 'Property listing status',
'required' => 0,
'wrapper' => array( 'width' => '33.33' ),
'choices' => array(
'available' => 'Available',
'pending' => 'Pending',
'sold' => 'Sold',
'rented' => 'Rented',
),
'default_value' => 'available',
'return_format' => 'value',
),
array(
'key' => 'field_property_address',
'label' => 'Full Address',
'name' => 'property_address',
'type' => 'textarea',
'instructions' => 'Complete property address',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'rows' => 2,
),
array(
'key' => 'field_property_city',
'label' => 'City',
'name' => 'property_city',
'type' => 'text',
'required' => 0,
'wrapper' => array( 'width' => '33.33' ),
),
array(
'key' => 'field_property_state',
'label' => 'State/Province',
'name' => 'property_state',
'type' => 'text',
'required' => 0,
'wrapper' => array( 'width' => '33.33' ),
),
array(
'key' => 'field_property_zipcode',
'label' => 'Zip/Postal Code',
'name' => 'property_zipcode',
'type' => 'text',
'required' => 0,
'wrapper' => array( 'width' => '33.33' ),
),
array(
'key' => 'field_property_bedrooms',
'label' => 'Bedrooms',
'name' => 'property_bedrooms',
'type' => 'number',
'required' => 0,
'wrapper' => array( 'width' => '25' ),
'min' => 0,
'step' => 1,
),
array(
'key' => 'field_property_bathrooms',
'label' => 'Bathrooms',
'name' => 'property_bathrooms',
'type' => 'number',
'required' => 0,
'wrapper' => array( 'width' => '25' ),
'min' => 0,
'step' => 0.5,
),
array(
'key' => 'field_property_sqft',
'label' => 'Square Footage',
'name' => 'property_sqft',
'type' => 'number',
'required' => 0,
'wrapper' => array( 'width' => '25' ),
'min' => 0,
'step' => 100,
),
array(
'key' => 'field_property_lot_size',
'label' => 'Lot Size',
'name' => 'property_lot_size',
'type' => 'text',
'instructions' => 'E.g., "0.5 acres" or "2,500 sqft"',
'required' => 0,
'wrapper' => array( 'width' => '25' ),
'placeholder' => '0.5 acres',
),
array(
'key' => 'field_property_year_built',
'label' => 'Year Built',
'name' => 'property_year_built',
'type' => 'number',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'min' => 1800,
'step' => 1,
),
array(
'key' => 'field_property_gallery',
'label' => 'Property Gallery',
'name' => 'property_gallery',
'type' => 'gallery',
'instructions' => 'Upload multiple photos of the property',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'return_format' => 'array',
'preview_size' => 'medium',
'insert' => 'append',
'library' => 'all',
'min' => 0,
'max' => 0,
),
array(
'key' => 'field_property_features',
'label' => 'Property Features/Amenities',
'name' => 'property_features',
'type' => 'repeater',
'instructions' => 'Add features and amenities available in this property',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'collapsed' => 'field_amenity_name',
'min' => 0,
'max' => 0,
'layout' => 'table',
'button_label' => '+ Add Amenity',
'sub_fields' => array(
array(
'key' => 'field_amenity_name',
'label' => 'Amenity Name',
'name' => 'name',
'type' => 'text',
'required' => 0,
'wrapper' => array( 'width' => '100' ),
'placeholder' => 'E.g., Swimming Pool, Garage, Fireplace',
),
),
),
array(
'key' => 'field_property_agent_name',
'label' => 'Agent/Contact Name',
'name' => 'agent_name',
'type' => 'text',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
),
array(
'key' => 'field_property_agent_email',
'label' => 'Agent Email',
'name' => 'agent_email',
'type' => 'email',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
),
array(
'key' => 'field_property_agent_phone',
'label' => 'Agent Phone',
'name' => 'agent_phone',
'type' => 'text',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
'placeholder' => '(555) 123-4567',
),
array(
'key' => 'field_property_agent_link',
'label' => 'Agent Profile Link',
'name' => 'agent_link',
'type' => 'link',
'instructions' => 'Link to agent profile or website',
'required' => 0,
'wrapper' => array( 'width' => '50' ),
'return_format' => 'array',
),
),
'location' => array(
array(
array(
'param' => 'post_type',
'operator' => '==',
'value' => 'properties',
),
),
),
'menu_order' => 0,
'position' => 'normal',
'style' => 'default',
'label_placement' => 'top',
'instruction_placement' => 'label',
) );
}