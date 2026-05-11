<?php
/**
 * ACF Helper Functions
 *
 * Use these functions in your templates to easily display ACF field values
 * Example: echo blankslate_get_service_price();
 */

// ============================================================================
// SERVICE FIELD GETTERS
// ============================================================================

/**
 * Get service price
 */
function blankslate_get_service_price() {
	return get_field( 'service_price' );
}

/**
 * Get service duration
 */
function blankslate_get_service_duration() {
	return get_field( 'service_duration' );
}

/**
 * Get service description
 */
function blankslate_get_service_description() {
	return get_field( 'service_description' );
}

/**
 * Display service icon
 */
function blankslate_the_service_icon() {
	$icon = get_field( 'service_icon' );
	if ( $icon ) {
		echo wp_kses_post( wp_get_attachment_image( $icon['ID'], 'thumbnail' ) );
	}
}

/**
 * Get service CTA button
 */
function blankslate_get_service_cta_button() {
	$link = get_field( 'service_cta_link' );
	$text = get_field( 'service_cta_text' );

	if ( $link ) {
		$url    = isset( $link['url'] ) ? esc_url( $link['url'] ) : '#';
		$target = isset( $link['target'] ) ? esc_attr( $link['target'] ) : '';
		$text   = $text ? esc_html( $text ) : 'Learn More';

		return sprintf(
			'<a href="%s" class="btn btn-primary" %s>%s</a>',
			$url,
			$target ? 'target="' . $target . '"' : '',
			$text
		);
	}

	return '';
}

/**
 * Display service features as list
 */
function blankslate_the_service_features() {
	$features = get_field( 'service_features' );

	if ( $features ) {
		echo '<ul class="list-unstyled">';
		foreach ( $features as $feature ) {
			$icon = isset( $feature['icon'] ) ? $feature['icon'] : 'dashicons-yes';
			echo '<li class="mb-2">';
			echo '<i class="' . esc_attr( $icon ) . '" style="margin-right: 8px;"></i>';
			echo '<strong>' . esc_html( $feature['title'] ) . '</strong>';
			if ( isset( $feature['description'] ) && $feature['description'] ) {
				echo '<br><small class="text-muted">' . esc_html( $feature['description'] ) . '</small>';
			}
			echo '</li>';
		}
		echo '</ul>';
	}
}

// ============================================================================
// PROPERTY FIELD GETTERS
// ============================================================================

/**
 * Get property price formatted
 */
function blankslate_get_property_price() {
	$price = get_field( 'property_price' );
	$label = get_field( 'property_price_label' );

	if ( $price ) {
		$formatted = '$' . number_format( $price, 0 );
		return $label ? $label . ' ' . $formatted : $formatted;
	}

	return '';
}

/**
 * Get property status
 */
function blankslate_get_property_status() {
	return get_field( 'property_status' );
}

/**
 * Get property address
 */
function blankslate_get_property_address() {
	return get_field( 'property_address' );
}

/**
 * Get property specs (bedrooms, bathrooms, sqft)
 * Returns formatted string or array
 */
function blankslate_get_property_specs( $format = 'string' ) {
	$beds   = get_field( 'property_bedrooms' );
	$baths  = get_field( 'property_bathrooms' );
	$sqft   = get_field( 'property_sqft' );

	$specs = array();

	if ( $beds ) {
		$specs[] = $beds . ' bed' . ( $beds > 1 ? 's' : '' );
	}
	if ( $baths ) {
		$specs[] = $baths . ' bath' . ( $baths > 1 ? 's' : '' );
	}
	if ( $sqft ) {
		$specs[] = number_format( $sqft ) . ' sqft';
	}

	if ( 'array' === $format ) {
		return $specs;
	}

	return implode( ' • ', $specs );
}

/**
 * Get property year built
 */
function blankslate_get_property_year_built() {
	return get_field( 'property_year_built' );
}

/**
 * Get property lot size
 */
function blankslate_get_property_lot_size() {
	return get_field( 'property_lot_size' );
}

/**
 * Display property gallery
 */
function blankslate_the_property_gallery() {
	$gallery = get_field( 'property_gallery' );

	if ( $gallery ) {
		echo '<div class="row g-3 mb-4">';
		foreach ( $gallery as $image ) {
			echo '<div class="col-md-6 col-lg-4">';
			echo wp_kses_post( wp_get_attachment_image( $image['ID'], 'medium', false, array( 'class' => 'img-fluid rounded' ) ) );
			echo '</div>';
		}
		echo '</div>';
	}
}

/**
 * Display property features/amenities
 */
function blankslate_the_property_features() {
	$features = get_field( 'property_features' );

	if ( $features ) {
		echo '<ul class="list-unstyled row">';
		foreach ( $features as $feature ) {
			echo '<li class="col-md-6 mb-2">';
			echo '<i class="dashicons dashicons-yes-alt" style="color: #28a745; margin-right: 8px;"></i>';
			echo esc_html( $feature['name'] );
			echo '</li>';
		}
		echo '</ul>';
	}
}

/**
 * Get agent contact info
 */
function blankslate_get_agent_name() {
	return get_field( 'agent_name' );
}

/**
 * Get agent email
 */
function blankslate_get_agent_email() {
	return get_field( 'agent_email' );
}

/**
 * Get agent phone
 */
function blankslate_get_agent_phone() {
	return get_field( 'agent_phone' );
}

/**
 * Display agent contact card
 */
function blankslate_the_agent_contact_card() {
	$name  = get_field( 'agent_name' );
	$email = get_field( 'agent_email' );
	$phone = get_field( 'agent_phone' );
	$link  = get_field( 'agent_link' );

	if ( ! $name && ! $email && ! $phone ) {
		return;
	}

	echo '<div class="card bg-light mt-4">';
	echo '<div class="card-body">';
	echo '<h5 class="card-title">Listed By</h5>';

	if ( $name ) {
		echo '<p class="card-text"><strong>' . esc_html( $name ) . '</strong></p>';
	}

	if ( $email ) {
		echo '<p class="card-text"><a href="' . esc_url( 'mailto:' . $email ) . '">' . esc_html( $email ) . '</a></p>';
	}

	if ( $phone ) {
		echo '<p class="card-text"><a href="' . esc_url( 'tel:' . preg_replace( '/\D/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a></p>';
	}

	if ( $link ) {
		$url    = isset( $link['url'] ) ? esc_url( $link['url'] ) : '#';
		$target = isset( $link['target'] ) ? esc_attr( $link['target'] ) : '';
		echo '<a href="' . $url . '" class="btn btn-primary btn-sm mt-2" ' . ( $target ? 'target="' . $target . '"' : '' ) . '>View Profile</a>';
	}

	echo '</div>';
	echo '</div>';
}
