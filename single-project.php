<?php
get_header();
?>

<main id="main-content" class="margin-top-mid">
  <section id="projects">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
      <div class="container">
        <div class="grid-row">

          <div class="grid-item item-s-12 item-l-6">
            <h1 class="single-project-title"><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </div>

          <div class="grid-item item-s-12 item-l-6">
            // SLIDER
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