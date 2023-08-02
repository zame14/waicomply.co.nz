<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<a class="top">
    <span class="fa fa-chevron-up"></span>
</a>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner-wrapper">
                    <div class="f-col-1">
                        <div class="footer-logo-wrapper">
                            <?=the_custom_logo()?>
                        </div>
                        <?php
                        if(is_active_sidebar('footerwidget')){
                            dynamic_sidebar('footerwidget');
                        }
                        ?>
                    </div>
                    <div class="f-col-2">
                        <h3>Useful Links</h3>
                        <?php wp_nav_menu(
                            array(
                                'theme_location'  => 'footer-menu',
                                'container_class' => 'footer-menu-wrapper',
                                'container_id'    => '',
                                'menu_class'      => 'plain',
                                'fallback_cb'     => '',
                                'menu_id'         => 'footer-menu',
                            )

                        ); ?>
                    </div>
                    <div class="f-col-3">
                        <h3>Contact Information</h3>
                        <address><?=getAddress()?></address>
                        <ul class="plain">
                            <li><a href="mailto:<?=get_option('email')?>" class="email"><?=get_option('email')?></a></li>
                            <li><a href="<?=get_option('linkedin')?>" target="_blank" class="linkedin">LinkedIn/Wai-Comply-Limited</a></li>
                        </ul>
                    </div>
                    <div class="f-col-4">
                        <?php
                        if(is_active_sidebar('footerwidget2')){
                            dynamic_sidebar('footerwidget2');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner-wrapper">
                    <p>&copy; Copyright <?=date('Y')?> <?=get_bloginfo('name')?></p>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<?php wp_footer(); ?>
<script src="<?=get_stylesheet_directory_uri()?>/js/noframework.waypoints.min.js" type="text/javascript"></script>
<script src="<?=get_stylesheet_directory_uri()?>/js/theme.js" type="text/javascript"></script>
</body>
</html>