<?php
get_header();
?>

<main id="main-content" class="main-content-padding">
  <section id="posts">
    <div class="container index-container">
      <div class="grid-row">
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

        <article <?php post_class('grid-item item-s-12 item-m-6 item-l-4 margin-bottom-small'); ?> id="post-<?php the_ID(); ?>">

          <?php the_post_thumbnail('item-l-4-3x4'); ?>

          <h1 class="font-size-basic margin-top-tiny margin-bottom-tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>

          <div class="padding-left-small"><?php the_content(); ?></div>

        </article>

<?php
  }
} else {
?>
        <article class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
      </div>
    </div>
  </section>

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>