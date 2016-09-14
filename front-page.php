<?php
get_header();
?>

<main id="main-content">
  <section id="front-page">
    <div class="container">
      <div class="grid-row">
<?php

// WP_Query arguments
$args = array (
  'post_type'              => array( 'project' ),
  'posts_per_page'         => '5',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
?>
      <div class="grid-item item-s-12 item-l-6 front-left front-page-section">
<?php
  while ( $query->have_posts() ) {
    $query->the_post();

    $image_id = get_post_meta($post->ID, '_igv_front_image_left_id', true);

    if (!empty($image_id)) {
?>
        <a href="<?php echo get_the_permalink($post->ID); ?>" class="project-<?php echo $post->ID; ?>">
          <?php echo wp_get_attachment_image($image_id, 'full');?>
        </a>
<?php 
    }
  }
?>
      </div>
      <div class="grid-item item-s-12 item-l-6 front-right front-page-section">
<?php
  $posts_reversed = array_reverse($query->posts);
  $query->posts = $posts_reversed;

  while ( $query->have_posts() ) {
    $query->the_post();

    $image_id = get_post_meta($post->ID, '_igv_front_image_right_id', true);

    if (!empty($image_id)) {
?>
        <a href="<?php echo get_the_permalink($post->ID); ?>" class="project-<?php echo $post->ID; ?>">
          <?php echo wp_get_attachment_image($image_id, 'full');?>
        </a>
<?php 
    }
  }
?>
      </div>
<?php
}

// Restore original Post Data
wp_reset_postdata();
?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>