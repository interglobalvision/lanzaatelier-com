<?php
get_header();
?>

<main id="main-content">
  <section id="projects">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $drawings = get_post_meta($post->ID, '_igv_project_drawings', true);
    $credits = get_post_meta($post->ID, '_igv_project_credits', true);
    $photos = get_post_meta($post->ID, '_igv_project_photos', true);

    $lang = qtranxf_getLanguage();

    if ($lang == 'en') {
      $pdf = get_post_meta($post->ID, '_igv_project_pdf_en', true);
    } else {
      $pdf = get_post_meta($post->ID, '_igv_project_pdf_es', true);
    }
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
      <div class="container">
        <div class="grid-row">

          <div class="grid-item item-s-12 item-l-6 single-project-drawings project-content-holder">
            <h1 class="padding-left-basic margin-bottom-small font-size-mid"><a class="u-inline-block" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php
    if (!empty($drawings)) {
      foreach($drawings as $image) {
        echo wp_get_attachment_image($image, 'item-l-6-4x3', '', array('class'=>'margin-bottom-small'));
      }
    }
?>
          </div>
          
          <div class="grid-item item-s-12 item-l-6 single-project-text project-content-holder hide">
            <h1 class="padding-left-basic project-text-title margin-bottom-small font-size-mid"><a class="u-inline-block" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <?php the_content(); ?>
            <?php 
              if (!empty($credits)) {
            ?>
            <div class="single-project-credits margin-top-small padding-left-basic padding-right-basic font-mono font-size-small">
              <?php echo apply_filters('the_content', $credits); ?>
            </div>
            <?php 
              }
            ?>          
            </div>

          <div class="grid-item item-s-12 item-l-6 single-project-photos">
<?php
    if (!empty($photos)) {
?>
            <div class="swiper-container project-photos-container">
              <div class="swiper-wrapper">
<?php
      foreach($photos as $image) {
?>
                <div class="swiper-slide project-photo-holder grid-column justify-center align-items-center <?php 
                echo count($photos) > 1 ? 'slider-cursor' : ''; ?>">
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
            <div class="project-gallery-pagination font-mono padding-top-tiny padding-left-mid u-inline-block"></div>
<?php 
if (!empty($pdf)) { 
?>
            <div class="project-pdf font-mono padding-top-tiny u-inline-block"><a href="<?php echo esc_url($pdf); ?>">PDF</a></div>
<?php 
}
?>
          </div>

        </div>
      </div>
    </article>

<?php
  }
} else {
?>
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 text-align-center">
          <p><?php _e('[:es]Disculpa, no hay entradas para lo que buscas[:en]Sorry, no posts matched your criteria'); ?></p>
        </div>
      </div>
    </div>
<?php
} ?>
  </section>

</main>

<?php
get_footer();
?>
