<?php
get_header();
?>

<main id="main-content" class="main-content-padding">
  <section id="posts">

<?php
if( have_posts() ) {
?>
    <div class="container index-container">
      <div class="grid-row">
<?php
  while( have_posts() ) {
    the_post();
?>

        <article <?php post_class('grid-item item-s-12 item-m-6 item-l-4 margin-bottom-small'); ?> id="post-<?php the_ID(); ?>">

          <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail('item-l-4-3x4'); ?>

            <h1 class="font-size-basic margin-top-tiny margin-bottom-tiny u-inline-block"><?php the_title(); ?></h1>
          </a>

          <div class="padding-left-small post-content"><?php the_content(); ?></div>

        </article>

<?php
  }
?>
      </div>
    </div>
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

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>
