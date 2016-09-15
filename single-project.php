<?php
get_header();
?>

<main id="main-content">
  <section id="projects">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
      <div class="container">
        <div class="grid-row">

          <div class="grid-item item-s-12 item-l-6 project-content-holder">
<?php
    $drawings = get_post_meta($post->ID, '_igv_project_drawings', true);

    if (!empty($drawings)) {
?>
            <div class="project-drawings">
              <h1 class="padding-left-basic"><?php the_title(); ?></h1>
<?php
      foreach($drawings as $image) {
        echo wp_get_attachment_image($image, 'item-l-6-4x3');
      }
?>
            </div>
<?php
    }
?>
            <div class="project-text">
              <h1 class="padding-left-basic"><?php the_title(); ?></h1>
              <?php the_content(); ?>
            </div>
          </div>

          <div class="grid-item item-s-12 item-l-6">
<?php
    $photos = get_post_meta($post->ID, '_igv_project_photos', true);

    if (!empty($photos)) {
?>
            <div class="swiper-container">
              <div class="swiper-wrapper">
<?php
      foreach($photos as $image) {
?>
                <div class="swiper-slide grid-column justify-center align-items-center">
                  <?php echo wp_get_attachment_image($image, 'item-l-6-4x3'); ?>
                </div>
<?php
      }
?>
              </div>
            </div>
<?php
    } 
?>
          <div class="project-gallery-pagination padding-top-tiny padding-left-mid"></div>
          </div>

        </div>
      </div>
    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
  </section>

</main>

<?php
get_footer();
?>