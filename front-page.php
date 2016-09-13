<?php
get_header();
?>

<main id="main-content">
  <section id="front-page">
    <div class="container">
      <div class="grid-row">


<?php
$projects_left = get_posts('post_type=project&order=DESC');

if (count($projects_left) > 0) {
?>
      <div class="grid-item item-s-12 item-l-6 front-left front-page-section">
<?php 
  foreach ($projects_left as $project) {
    $image_id = get_post_meta($project->ID, '_igv_front_image_left_id', true);

    if (!empty($image_id)) {
?>
        <a href="<?php echo get_the_permalink($project->ID); ?>" class="project-<?php echo $project->ID; ?>">
          <?php echo wp_get_attachment_image($image_id, 'full');?>
        </a>
<?php 
    }
  }
?>
      </div>
      <div class="grid-item item-s-12 item-l-6 front-right front-page-section">
<?php 
  $projects_right = get_posts('post_type=project&order=ASC');

  foreach ($projects_right as $project) {
    $image_id = get_post_meta($project->ID, '_igv_front_image_right_id', true);

    if (!empty($image_id)) {
?>
        <a href="<?php echo get_the_permalink($project->ID); ?>" class="project-<?php echo $project->ID; ?>">
          <?php echo wp_get_attachment_image($image_id, 'full');?>
        </a>
<?php 
    }
  }
?>
      </div>
<?php
  }
?>
  
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>