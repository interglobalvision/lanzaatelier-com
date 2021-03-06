<?php
get_header();
?>

<main id="main-content" class="main-content-padding">
  <section id="posts">
    <div class="container">
      <div class="grid-row">
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

        <article <?php post_class('grid-item item-s-12 item-m-6 offset-m-3'); ?> id="post-<?php the_ID(); ?>">

          <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>

          <?php the_content(); ?>

        </article>

<?php
  }
} ?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
