<?php
/*
Plugin Name: CMB Field Type: Gallery
Plugin URI: https://github.com/mustardBees/cmb-field-gallery
Description: Gallery field type for Custom Metaboxes and Fields for WordPress. Thanks to <a href="http://www.purewebsolutions.nl/">Roel Obdam</a> for the hard work <a href="http://goo.gl/RYj2w">figuring out the media library</a>.
Version: 2.0.2
Author: Phil Wylie
Author URI: http://www.philwylie.co.uk/
License: GPLv2+
*/

// Useful global constants
if ( ! defined( 'PW_GALLERY_URL' ) ) {
  define( 'PW_GALLERY_URL', get_bloginfo('stylesheet_directory') . '/lib/cmb-field-gallery/' );
}

/**
 * Render field
 */
function pw_gallery_field( $field, $meta ) {
	wp_enqueue_script( 'pw_gallery_init', PW_GALLERY_URL . 'js/script.js', array( 'jquery' ), null );

  $hidden = 'hidden';

	if ( ! empty( $meta ) ) {
		$meta = implode( ',', $meta );
    $hidden = '';
	}

  $preview_size = $field->args('preview_size');

	$img_size = !empty($preview_size) ? $preview_size : array(50, 50);

	echo '<div class="pw-gallery">';
	echo '	<input type="hidden" id="' . $field->args( 'id' ) . '" name="' . $field->args( 'id' ) . '" value="' . $meta . '" />';
  echo '  <input type="button" class="manage-gallery button" value="' . ( $field->args( 'button' ) ? $field->args( 'button' ) : 'Manage gallery' ) . '" style="margin-left: 0;" />';
	echo '	<input type="button" class="clear-gallery button ' . $hidden . '" value="' . ( $field->args( 'clear-button' ) ? $field->args( 'clear-button' ) : 'Clear gallery' ) . '" style="margin-left: 0;" />';
	echo '</div>';

	$desc = $field->args( 'desc' );
	if ( ! empty( $desc ) ) echo '<p class="cmb2-metabox-description">' . $desc . '</p>';

	echo '<ul id="'.$field->args( 'id' ).'-status" class="cmb2-media-status">';

	$ids = explode(',', $meta);

	foreach($ids as $id) {
		echo '<li class="img-status">'. wp_get_attachment_image( $id, $img_size ) .'</li>';
 	}

	echo '</ul>';

}

add_filter( 'cmb2_render_pw_gallery', 'pw_gallery_field', 10, 2 );


/**
 * Split CSV string into an array of values
 */
function pw_gallery_field_sanitise( $meta_value, $field ) {
	if ( empty( $meta_value ) ) {
		$meta_value = '';
	} else {
		$meta_value = explode( ',', $meta_value );
	}

	return $meta_value;
}
