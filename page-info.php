<?php
get_header();
?>

<main id="main-content" class="main-content-padding">
  <section id="posts">
    <div class="container">
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

        <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-12 item-m-10 offset-m-1 item-l-6 offset-l-3 text-align-center">
            <?php the_post_thumbnail('item-l-6-4x3'); ?>
          </div>

          <div class="grid-item item-s-12 item-m-12 item-l-8 offset-l-2 font-size-large margin-top-basic info-content">
            <?php the_content(); ?>
          </div>
        </article>

<?php
  }
} else {
?>
        <article class="u-alert grid-row">
          <div class="grid-item item-s-12">
            <?php _e('Sorry, page not found'); ?>
          </div>
        </article>
<?php
} ?>
    </div>
  </section>
</main>

<?php
get_footer();
?>