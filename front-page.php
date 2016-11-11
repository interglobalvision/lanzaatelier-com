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
$projects = get_post_meta(get_the_ID(), '_igv_front_projects', true);

//pr($projects); die;

// The Loop
if ($projects) {
?>
      <div class="grid-item item-s-12 item-l-6">
        <div class="scroll-col scroll-col-left text-align-center" data-side="left">
<?php
  foreach ($projects as $project) {

    $image_left = get_post_meta($project['id'], '_igv_front_image_left_id', true);
    $image_right = get_post_meta($project['id'], '_igv_front_image_right_id', true);

    if (!empty($image_left)) {
      $check_filetype = wp_check_filetype(wp_get_attachment_url($image_left));
      if ($check_filetype['ext'] == 'gif') { 
        $img_elem = '<img src="' . wp_get_attachment_url($image_left) . '">';
      } else {
        $img_elem = wp_get_attachment_image($image_left, 'item-l-6-4x3');
      }
?>
          <div class="front-image-holder desktop-front-item">
            <a href="<?php echo get_the_permalink($project['id']); ?>" class="project-<?php echo $project['id']; ?>  grid-column justify-center align-items-center">
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
            <a href="<?php echo get_the_permalink($project['id']); ?>" class="project-<?php echo $project['id']; ?>  grid-column justify-center align-items-center">
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
  $projects_reversed = array_reverse($projects);

  foreach ($projects_reversed as $project) {

    $image_right = get_post_meta($project['id'], '_igv_front_image_right_id', true);

    if (!empty($image_right)) {
      $check_filetype = wp_check_filetype(wp_get_attachment_url($image_right));
      if ($check_filetype['ext'] == 'gif') { 
        $img_elem = '<img src="' . wp_get_attachment_url($image_right) . '">';
      } else {
        $img_elem = wp_get_attachment_image($image_right, 'item-l-6-4x3');
      }
?>
          
          <div class="front-image-holder desktop-front-item">
            <a href="<?php echo get_the_permalink($project['id']); ?>" class="project-<?php echo $project['id']; ?>  grid-column justify-center align-items-center">
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
