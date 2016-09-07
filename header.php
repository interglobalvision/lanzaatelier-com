<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
    get_template_part('partials/globie');
    get_template_part('partials/seo');
  ?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.png">
  <link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.ico">
  <link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon-touch.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.png">

  <?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php } ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<section id="main-container">

  <header id="header" class="padding-top-small padding-bottom-small">
    <h1 class="u-visuallyhidden"><?php bloginfo('name'); ?></h1>

    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-6">
          <div id="mobile-header" class="site-title">
            <a href="<?php echo home_url(); ?>">LANZA</a>
            <div id="mobile-toggle" class="mobile-only">=</div>
          </div>
        </div>
        <div class="grid-item item-s-12 item-m-6 grid-column no-gutter" id="nav-holder">
          <nav class="grid-item item-s-12 item-m-9" id="nav-menu">
            <ul>
              <li class="nav-item"><a href="<?php echo home_url(); ?>/proyectos"><?php _e('[:es]Proyectos[:en]Projects'); ?></a></li>
              <li class="nav-item"><a href="<?php echo home_url(); ?>/noticias"><?php _e('[:es]Noticias[:en]News'); ?></a></li>
              <li class="nav-item"><a href="<?php echo home_url(); ?>/info">Info</a></li>
            </ul>
          </nav>
          <div class="grid-item item-s-12 item-m-3" id="lang-holder">
<?php 
  $en = is_404() ? site_url() : qtranxf_convertURL('', 'en', false, true);
  $es = is_404() ? site_url() : qtranxf_convertURL('', 'es', false, true);

  $email = IGV_get_option('_igv_site_options', '_igv_contact_email');
?>
            <nav id="lang-menu">
              <a href="<?php echo $en; ?>">EN</a> / <a href="<?php echo $es; ?>">ES</a>
            </nav>
<?php 
  if (!empty($email)) {
?>
            <div id="mobile-email" class="mobile-only">
              <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
            </div>
<?php 
  }
?>
          </div>
        </div>
      </div>
    </div>
  </header>