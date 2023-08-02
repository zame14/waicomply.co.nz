<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

global $post;
get_header();
?>
<div class="wrapper" id="search-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h1>
                        <?php
                        printf(
                        /* translators: %s: query term */
                        esc_html__( 'Search Results for: %s', 'understrap' ),
                        '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div id="content" class="container">
        <div class="row">
            <div class="col-12">
                <main class="site-main" id="main">
                    <?php
                    while ( have_posts() ) :
                        the_post();

                        /*
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'loop-templates/content', 'search' );
                    endwhile;
                    ?>
                </main><!-- #main -->
            </div>
        </div><!-- .row -->
    </div><!-- #content -->
</div>
<?php get_footer(); ?>
