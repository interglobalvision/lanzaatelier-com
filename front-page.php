<?php
get_header();
?>

<main id="main-content">
  <section id="front-page">
    <div class="scroll-cols-holder u-hidden">
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

    $image_left = get_post_meta($post->ID, '_igv_front_image_left_id', true);
    $image_right = get_post_meta($post->ID, '_igv_front_image_right_id', true);

    if (!empty($image_left)) {
      $check_filetype = wp_check_filetype(wp_get_attachment_url($image_left));
      if ($check_filetype['ext'] == 'gif') { 
        $img_elem = '<img src="' . wp_get_attachment_url($image_left) . '">';
      } else {
        $img_elem = wp_get_attachment_image($image_left, 'item-l-6-4x3');
      }
?>
          <div class="front-image-holder">
            <a href="<?php echo get_the_permalink($post->ID); ?>" class="project-<?php echo $post->ID; ?>  grid-column justify-center align-items-center">
              <?php echo $img_elem; ?>
            </a>
          </div>
<?php 
    }

    if (!empty($image_right)) {
      $check_filetype = wp_check_filetype(wp_get_attachment_url($image_right));
      if ($check_filetype['ext'] == 'gif') { 
        $img_elem = '<img src="' . wp_get_attachment_url($image_right) . '">';
      } else {
        $img_elem = wp_get_attachment_image($image_right, 'item-l-6-4x3');
      }
?>
          <div class="front-image-holder mobile-front-item">
            <a href="<?php echo get_the_permalink($post->ID); ?>" class="project-<?php echo $post->ID; ?>  grid-column justify-center align-items-center">
              <?php echo $img_elem; ?>
            </a>
          </div>
<?php 
    }
  }
?>
        </div>
      </div>
      <div class="grid-item item-s-12 item-l-6">
        <div class="scroll-col scroll-col-right text-align-center desktop-front-item" data-side="right">
<?php
  $posts_reversed = array_reverse($query->posts);
  $query->posts = $posts_reversed;

  while ( $query->have_posts() ) {
    $query->the_post();

    $image_right = get_post_meta($post->ID, '_igv_front_image_right_id', true);

    if (!empty($image_right)) {
      if (wp_check_filetype(wp_get_attachment_url($image_right))['ext'] == 'gif') {
        $img_elem = '<img src="' . wp_get_attachment_url($image_right) . '">';
      } else {
        $img_elem = wp_get_attachment_image($image_right, 'item-l-6-4x3');
      }
?>
          
          <div class="front-image-holder">
            <a href="<?php echo get_the_permalink($post->ID); ?>" class="project-<?php echo $post->ID; ?>  grid-column justify-center align-items-center">
              <?php echo $img_elem; ?>
            </a>
          </div>
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
