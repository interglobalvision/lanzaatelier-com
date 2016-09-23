<?php
get_header();
?>

<main id="main-content" class="main-content-padding">
  <section id="projects">

<?php
if( have_posts() ) {
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
      <div class="container">
        <div class="grid-row">

          <div class="grid-item item-s-12 item-l-6">
            <ul>
<?php
  while( have_posts() ) {
    the_post();
?>
              <li><a class="archive-project-title font-size-extra" href="<?php the_permalink() ?>" data-id="<?php echo get_the_ID(); ?>"><?php the_title(); ?></a></li>
<?php
  }
?>
            </ul>
          </div>

          <div class="grid-item item-s-12 item-l-6 grid-column justify-center align-items-center archive-project-photos">
<?php
  while( have_posts() ) {
    the_post();
    $photos = get_post_meta($post->ID, '_igv_project_photos', true);

    if (!empty($photos)) {
?>
            <div class="project-photos-container archive-photos-container hide grid-row" data-id="<?php echo $post->ID; ?>">
              <div class="project-photo-holder grid-column justify-center align-items-center">
                <?php echo wp_get_attachment_image($photos[0], 'item-l-6-4x3'); ?>
              </div>
            </div>
<?php
    }
  }
?>
          </div>

        </div>
      </div>
    </article>

<?php
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