<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
require_once('modal/class.Base.php');
require_once('modal/class.Team.php');
require_once('modal/class.Term.php');
require_once('modal/class.Insight.php');
require_once('modal/class.Page.php');
//require_once('modal/class.WPAjax.php');
$wcAdjustStylesheet = 'understrap-theme';
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    //wp_enqueue_style( 'google_font', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&family=Raleway:wght@400;700&display=swap"');
    //wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick.css');
    //wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick-theme.css');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css');
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
function dg_remove_page_templates( $templates ) {
    unset( $templates['page-templates/blank.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );
    unset( $templates['page-templates/both-sidebarspage.php'] );
    unset( $templates['page-templates/empty.php'] );
    unset( $templates['page-templates/fullwidthpage.php'] );
    unset( $templates['page-templates/left-sidebarpage.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );

    return $templates;
}
add_filter( 'theme_page_templates', 'dg_remove_page_templates' );
add_action('init', 'bhb_register_menus');
function bhb_register_menus() {
    register_nav_menus(
        Array(
            'footer-menu' => __('Footer Menu'),
            'main-menu-right' => __('Main Menu Right'),
        )
    );
}
add_image_size( 'profile', 800, 600, true);
function template_widgets_init()
{
    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'understrap' ),
        'id'            => 'footerwidget',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="left-footer-widget-wrapper">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget 2', 'understrap' ),
        'id'            => 'footerwidget2',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="right-footer-widget-wrapper">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
add_action( 'widgets_init', 'template_widgets_init' );

add_action('admin_init', 'my_general_section');
function my_general_section() {
    add_settings_section(
        'my_settings_section', // Section ID
        'Custom Website Settings', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field( // Option 1
        'address', // Option ID
        'Address', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'address' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'linkedin', // Option ID
        'LinkedIn', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'linkedin' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'email', // Option ID
        'Email', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'email' // Should match Option ID
        )
    );

    register_setting('general','address', 'esc_attr');
    register_setting('general','linkedin', 'esc_attr');
    register_setting('general','email', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '';
}

function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
function getAddress()
{
    $address = str_replace("|", "<br />", get_option('address'));

    return $address;
}
function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;
}
function getTeam() {
    $our_team = Array();
    $posts_array = get_posts([
        'post_type' => 'team',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order'
    ]);
    foreach ($posts_array as $post) {
        $team = new Team($post);
        $our_team[] = $team;
    }
    return $our_team;
}

function teamModule_shortcode()
{
    $html = '<div class="row justify-content-center team-members-wrapper">';
    foreach (getTeam() as $team)
    {
        $html .= '<div class="col-6 col-sm-6 col-md-4 col-lg-3 team-panel">
            <a href="' . $team->link() . '">
                <div class="image-wrapper no-lazy">
                    ' . $team->getFeatureImage() . '
                    <span class="read-more btn btn-primary">read more</span>
                </div>    
                <div class="content-wrapper">
                    <h3>' . $team->getTitle() . '</h3>
                    <div class="position">
                        ' . $team->getCustomField('team-position') . '
                    </div>
                </div>
            </a>    
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('team_module', 'teamModule_shortcode');
function getInsights($type) {
    $articles = Array();
    $posts_array = get_posts([
        'post_type' => 'insight',
        'post_status' => 'publish',
        'numberposts' => 3,
        'orderby' => 'menu_order',
        'meta_query' => [
            [
                'key' => 'wpcf-insight-type',
                'value' => $type
            ]
        ]
    ]);
    foreach ($posts_array as $post) {
        $article = new Insight($post);
        $articles[] = $article;
    }
    return $articles;
}
function insightsModule_shortcode($atts)
{
    $type = $atts['type'];
    $html = '<div class="row row-eq-height insights-wrapper">';
    foreach (getInsights($type) as $article)
    {
        $html .= '<div class="col-12 col-sm-6 col-md-4 article">
            <div class="inner-wrapper">
                <div class="image-wrapper">
                    ' . $article->getFeatureImage() . '
                </div>
                <div class="content-wrapper">
                    <h3>' . $article->getTitle() . '</h3>
                    ' . $article->getContent() . '
                    <a href="' . $article->getCustomField('insight-pdf') . '" target="_blank">Read more ></a>
                </div>
            </div>
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('insights_module', 'insightsModule_shortcode');
add_action( 'wp_print_styles', 'wc_adjustStylesheetOrder', 99);
function wc_adjustStylesheetOrder() {
    global $wp_styles, $wcAdjustStylesheet;

    if(!$wcAdjustStylesheet) return;

    $keys=[];
    $keys[] = $wcAdjustStylesheet;

    foreach($keys as $currentKey) {
        $keyToSplice = array_search($currentKey,$wp_styles->queue);

        if ($keyToSplice!==false && !is_null($keyToSplice)) {
            $elementToMove = array_splice($wp_styles->queue,$keyToSplice,1);
            $wp_styles->queue[] = $elementToMove[0];
        }

    }

    return;
}
function customSearchForm() {
    $html = '
    <form class="search-form" action="' . $_SERVER['SCRIPT_NAME'] . '" method="get" role="search">
        <div class="inner-wrapper">
            <span class="fa fa-search"></span>
            <input class="search-field" type="search" name="s" value="" placeholder="Search...">
            <input type="hidden" name="post_type" value="product" />
        </div>    
    </form>';

    return $html;
}
function contactDetails_shortcode()
{
    $html = '
    <h2>' . get_bloginfo('name') . '</h2>
    <ul class="plain contact-details">
        <li class="addy"><address>' . getAddress() . '</address></li>
        <li class="email"><a href="mailto:' . get_option('email') . '">' . get_option('email') . '</a></li>
        <li class="linkedin"><a href="' . get_option('linkedin') . '" target="_blank">LinkedIn/Wai-Comply-Limited</a></li>
    </ul>';
    return $html;
}
add_shortcode('contact_details', 'contactDetails_shortcode');

function formatURL($url)
{
    $new_url = str_replace("https://", "", $url);
    return $new_url;
}
function servicesMenu_shortcode()
{
    global $post;
    $third_party = new Page(3234);
    $compliance = new Page(3321);
    $training = new Page(3323);
    $class1 = '';
    $class2 = '';
    $class3 = '';
    if($post->ID == $third_party->id())
    {
        $class1 = 'current';
    } elseif ($post->ID == $compliance->id()) {
        $class2 = 'current';
    } elseif ($post->ID == $training->id()) {
        $class3 = 'current';
    }
    $html = '
    <div class="service-menu-wrapper">
        <div class="title">Explore our Services</div>
        <ul class="plain">
            <li class="' . $class1 . '"><a href="' . $third_party->link() . '">' . $third_party->getTitle() . '</a></li>
            <li class="' . $class2 . '"><a href="' . $compliance->link() . '">' . $compliance->getTitle() . '</a></li>
            <li class="' . $class3 . '"><a href="' . $training->link() . '">' . $training->getTitle() . '</a></li>
        </ul>
    </div>';
    return $html;
}
add_shortcode('services_menu','servicesMenu_shortcode');