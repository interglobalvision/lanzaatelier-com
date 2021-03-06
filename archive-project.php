<?php
get_header();
?>

<main id="main-content">
  <section id="projects">

<?php
if( have_posts() ) {
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
      <div class="container">
        <div class="grid-row">

          <div class="grid-item item-s-12 item-l-6" id="archive-project-holder">
            <ul id="archive-project-list">
<?php
  while( have_posts() ) {
    the_post();
?>
              <li><a class="archive-project-title u-inline-block font-size-extra" href="<?php the_permalink() ?>" data-id="<?php echo get_the_ID(); ?>"><?php the_title(); ?></a></li>
<?php
  }
?>
            </ul>
          </div>

          <div class="grid-item item-s-12 item-l-6 grid-column justify-center align-items-start archive-project-photos">
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
