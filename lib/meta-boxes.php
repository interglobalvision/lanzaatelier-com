<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

  // PROJECT META

  $project_meta = new_cmb2_box( array(
    'id'           => $prefix . 'project_meta',
    'title'        => __( 'Project Options', 'cmb2' ),
    'object_types' => array( 'project', ),
  ) );

  $project_meta->add_field( array(
    'name'    => __( 'Creditos', 'cmb2' ),
    'id'      => $prefix . 'project_credits',
    'type'    => 'wysiwyg',
    'options' => array(
      'media_buttons' => false,
      'textarea_rows' => 3,
      'editor_class' => 'cmb2-qtranslate'
    )
  ) );

  $project_meta->add_field( array(
    'name'    => __( 'PDF Español', 'cmb2' ),
    'id'      => $prefix . 'project_pdf_es',
    'type'    => 'file',
  ) );

    $project_meta->add_field( array(
    'name'    => __( 'PDF Inglés', 'cmb2' ),
    'id'      => $prefix . 'project_pdf_en',
    'type'    => 'file',
  ) );

  $project_meta->add_field( array(
    'name'            => __( 'Dibujos', 'cmb2' ),
    'button'          => 'Modificar galería', // Optionally set button label
    'clear-button'    => 'Eliminar galería', // Optionally set clear button label
    'id'              => $prefix . 'project_drawings',
    'type'            => 'pw_gallery',
    'preview_size'    => array( 150, 150 ), // Set the size of the thumbnails
    'sanitization_cb' => 'pw_gallery_field_sanitise', // REQUIRED
  ) );

  $project_meta->add_field( array(
    'name'            => __( 'Fotos', 'cmb2' ),
    'button'          => 'Modificar galería', // Optionally set button label
    'clear-button'    => 'Eliminar galería', // Optionally set clear button label
    'id'              => $prefix . 'project_photos',
    'type'            => 'pw_gallery',
    'preview_size'    => array( 150, 150 ), // Set the size of the thumbnails
    'sanitization_cb' => 'pw_gallery_field_sanitise', // REQUIRED
  ) );

  $project_meta->add_field( array(
    'name' => __( 'Portada izquierda', 'cmb2' ),
    'desc' => __( 'Imagen que aparece en la columna izquierda del Home', 'cmb2' ),
    'id'   => $prefix . 'front_image_left',
    'type' => 'file',
  ) );

  $project_meta->add_field( array(
    'name' => __( 'Portada derecha', 'cmb2' ),
    'desc' => __( 'Imagen que aparece en la columna derecha del Home', 'cmb2' ),
    'id'   => $prefix . 'front_image_right',
    'type' => 'file',
  ) );

  // FRONT PAGE META

  $front_meta = new_cmb2_box( array(
    'id'           => $prefix . 'front_meta',
    'title'        => __( 'Front Page Projects', 'cmb2' ),
    'object_types' => array( 'page', ),
    'show_on'      => array( 'key' => 'id', 'value' => array( get_option( 'page_on_front' ) ) ),
  ) );

  $front_group_id = $front_meta->add_field( array(
    'id'          => $prefix . 'front_projects',
    'type'        => 'group',
    'description' => __( 'Front page projects', 'cmb2' ),
    'options'     => array(
      'group_title'   => __( 'Project {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'    => __( 'Add Another Project', 'cmb2' ),
      'remove_button' => __( 'Remove Project', 'cmb2' ),
      'sortable'      => true, // beta
      // 'closed'     => true, // true to have the groups closed by default
    ),
  ) );

  $front_meta->add_group_field( $front_group_id, array(
    'name'             => __( 'Project', 'cmb2' ),
    'id'               => 'id',
    'type'             => 'select',
    'show_option_none' => true,
    'options'          => get_post_objects(array(
      'post_type'       => 'project',
      'posts_per_page'  => -1,
    )),
  ) );

}
?>
