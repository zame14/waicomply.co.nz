<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
get_header();
?>
    <div class="wrapper" id="page-wrapper">
    <?php
    if(!is_front_page()) {
        if(has_post_thumbnail($post->ID))
        { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 no-padding">
                        <?php
                        if(has_post_thumbnail($post->ID)) { ?>
                            <div class="banner-wrapper">
                                <?= get_the_post_thumbnail($post->ID, 'full') ?>
                                <div class="page-title">
                                    <span><h1><?= get_the_title() ?></h1></span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        } else { ?>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title">
                            <h1><?=get_the_title()?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
        ?>
        <div id="content" class="container-fluid">
            <div class="row">
                <div class="col-12 no-padding">
                    <main class="site-main" id="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'loop-templates/content', 'page' ); ?>
                        <?php endwhile; // end of the loop. ?>
                    </main><!-- #main -->
                </div>
            </div><!-- .row -->
        </div><!-- #content -->
    </div>
<?php get_footer(); ?>