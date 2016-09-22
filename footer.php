  <footer id="footer">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-6 footer-logo-holder">
          <a href="<?php echo home_url(); ?>" class="site-logo"><?php 
            echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/logo-atelier.svg'); 
          ?></a>
        </div>
<?php 
$email = IGV_get_option('_igv_site_options', '_igv_contact_email'); 

if (!empty($email)) {
?>
        <div class="grid-item item-s-6 text-align-right footer-email-holder">
          <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
        </div>
<?php
}
?>
      </div>
    </div>
  </footer>

</section>

<?php
  get_template_part('partials/scripts');
  get_template_part('partials/schema-org');
?>

</body>
</html>