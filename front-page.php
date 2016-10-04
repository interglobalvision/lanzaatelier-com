<?php
get_header();
?>

<main id="main-content">
  <section id="front-page">
    <div class="scroll-cols-holder">
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
      <div class="grid-item item-s-12 item-l-6">
        <div class="scroll-col scroll-col-left text-align-center" data-side="left">
<?php
  while ( $query->have_posts() ) {
    $query->the_post();

    $image_id = get_post_meta($post->ID, '_igv_front_image_left_id', true);

    if (!empty($image_id)) {
      if (wp_check_filetype(wp_get_attachment_url($image))['ext'] == 'gif') {
        $img_elem = '<img src="' . wp_get_attachment_url($image) . '">';
      } else {
        $img_elem = wp_get_attachment_image($image, 'item-l-6-4x3');
      }
?>
        <a href="<?php echo get_the_permalink($post->ID); ?>" class="project-<?php echo $post->ID; ?>">
          <?php echo $img_elem; ?>
        </a>
<?php 
    }
  }
?>
        </div>
      </div>
      <div class="grid-item item-s-12 item-l-6">
        <div class="scroll-col scroll-col-right text-align-center" data-side="right">
<?php
  $posts_reversed = array_reverse($query->posts);
  $query->posts = $posts_reversed;

  while ( $query->have_posts() ) {
    $query->the_post();

    $image_id = get_post_meta($post->ID, '_igv_front_image_right_id', true);

    if (!empty($image_id)) {
      if (wp_check_filetype(wp_get_attachment_url($image))['ext'] == 'gif') {
        $img_elem = '<img src="' . wp_get_attachment_url($image) . '">';
      } else {
        $img_elem = wp_get_attachment_image($image, 'item-l-6-4x3');
      }
?>
        <a href="<?php echo get_the_permalink($post->ID); ?>" class="project-<?php echo $post->ID; ?>">
          <?php echo $img_elem; ?>
        </a>
<?php 
    }
  }
?>
        </div>
      </div>
<?php
}

// Restore original Post Data
wp_reset_postdata();
?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
