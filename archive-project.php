<?php
get_header();
?>

<main id="main-content" class="margin-top-mid">
  <section id="project">

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

              <li><a class="archive-project-title" href="<?php the_permalink() ?>" data-id="<?php echo get_the_ID(); ?>"><?php the_title(); ?></a></li>

<?php
  }
?>
            </ul>
          </div>

          <div class="grid-item item-s-12 item-l-6">

<?php
  while( have_posts() ) {
    the_post();
?>

            <?php the_post_thumbnail('post-thumbnail', array('data-id'=>get_the_ID())); ?>

<?php
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