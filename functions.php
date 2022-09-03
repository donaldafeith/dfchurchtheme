<?php
/**
 * DFChurchTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DFChurchTheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dfchurchtheme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on DFChurchTheme, use a find and replace
		* to change 'dfchurchtheme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'dfchurchtheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'dfchurchtheme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'dfchurchtheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'dfchurchtheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dfchurchtheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dfchurchtheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'dfchurchtheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dfchurchtheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'dfchurchtheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'dfchurchtheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dfchurchtheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dfchurchtheme_scripts() {
	wp_enqueue_style( 'dfchurchtheme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'dfchurchtheme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'dfchurchtheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dfchurchtheme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function register_custom_js() {
    wp_register_script( 'mootools',  get_bloginfo('template_directory') . '/js/mootools-yui-compressed.js', '1.3.0' );
    wp_register_script( 'noobslide', get_bloginfo('template_directory') . '/js/_class.noobSlide.packed.js' , array( 'mootools' ) );
}
add_action( 'init', 'register_custom_js' );
 
function enqueue_noobslide() {
    if ( is_home() ) { // our slider only appear in the home page, so load the script only in home page
        wp_enqueue_script( 'noobslide' );
    }
}   
add_action( 'wp_print_scripts', 'enqueue_noobslide' );

function custom_theme_setup() {
    add_theme_support( 'post_thumbnails' );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );
function custom_excerpt_with_more( $excerpt ) {
    if ( has_excerpt() && ! is_attachment() ) {
        global $post;
        return $excerpt . '<p class="slider-more"><a href="' . get_permalink( $post->ID ) . '">Continue reading</a></p>';
    }
    return $excerpt;
}
add_filter( 'get_the_excerpt', 'custom_excerpt_with_more' );
 
function custom_excerpt_more( $more ) {
    global $post;
    return '<p class="slider-more"><a href="' . get_permalink( $post->ID ) . '">Continue reading</a></p>';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );
function custom_slider_css_js() {
    if ( is_home() ) { // only in home page
?>
<style type="text/css">
#slider{
	margin-left:25%;
	width:640px;
	position:relative;
	overflow:hidden;
	height:300px;
	margin-bottom:20px;
}
#mask{
	position:absolute;
	height:213px;
}
.items{
	float:left;
	height:213px;
	width:640px;
	position:relative;
}
.items .wp-post-image {
	float:left;
	height: 300px;
	width:100%;
}
.info{
	width:320px;
	float:left;
	font-family:Arial, Helvetica, sans-serif;
}
#content .info h2{
	font-size:20px;
	font-weight:bold;
	color:#1c3f95;
	margin:10px 10px 15px 10px;
}
#content .info p{
	font-size:11px;
	color:#1c3f95;
	line-height:16px;
	margin:10px;
}
.info a{
	font-size:10px;
	padding:5px 7px;
	background:#e1e1e1;
	text-decoration:none;
	text-transform:uppercase;
	font-weight:bold;
	color:#1c3f95;
}
.info a:hover{
	color:#ffffff;
	background:#1c3f95;
}
#slider .handle{
	position:absolute;
	bottom:0;
	right:5px;
	line-height:10px;
	text-align:center;
	font-size:25px;
	font-weight:bold;
}
.handle a{
	color:#ccc;
	height:20px;
	width:20px;
	display:inline-block;
	cursor:pointer;
}
.handle .active{
	color:#1c3f95;
}
.handle a:hover{
	color:#1c9f65;
	}
</style>
<script type="text/javascript">
/*<![CDATA[*/
window.addEvent('domready',function(){
    var nS8 = new noobSlide({
        box: $('mask'),
        items: $$('#mask .items'),
        size: 640,
        autoPlay: true,
        interval:8000,
        handles: $$('.handle a'),
        onWalk: function(currentItem,currentHandle){
            $$(this.handles).removeClass('active');
            $$(currentHandle).addClass('active');
        }
    });
    var handle = $$('.handle a');
    handle.each(function(el,i){el.addEvent('click',nS8.walk.bind(nS8,[i,true]));});
});
/*]]>*/
</script>
<?php
    }
}
add_action('wp_head', 'custom_slider_css_js' );

/**
 * Custom thumbnail theme support
 */
if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails');

// Changing excerpt length
function new_excerpt_length($length) {
return 5;
}
add_filter('excerpt_length', 'new_excerpt_length');
 
function new_excerpt_more($more) {
 global $post;
 return '<br><a class="moretag" href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function limit_posts_per_home_page() 
{
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $first_page_limit = 4;
    $limit = get_option('posts_per_page');

    if (is_front_page())
    {
        if ($paged == 1)
        {
            $limit = $first_page_limit;
        }
        else
        {
            $offset = $first_page_limit + (($paged - 2) * $limit);
            set_query_var('offset', $offset);   
        }
    }

    set_query_var('posts_per_archive_page', $limit);
    set_query_var('posts_per_page', $limit);
}
add_filter('pre_get_posts', 'limit_posts_per_home_page');
// Register Sidebars
function custom_sidebar() {

	$args = array(
		'id'            => 'upcoming-events',
		'name'          => __( 'CalendarEvents', 'text_domain' ),
		'description'   => __( 'Appears under recent blogs.', 'text_domain' ),
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',

	);
	register_sidebar( $args );

	$args = array(
		'id'            => 'latest',
		'class'         => 'latestgreatest',
		'name'          => __( 'Latest', 'text_domain' ),
		'description'   => __( 'Use this to display podcasts, links, sermons', 'text_domain' ),
	);

	register_sidebar( $args );
		$args = array(
		'id'            => 'footer1',
		'class'         => 'footer1',
		'name'          => __( 'Footer 1', 'text_domain' ),
		'description'   => __( 'Use this to display address, message, scripture', 'text_domain' ),
	);
	register_sidebar( $args );
		register_sidebar( $args );
		$args = array(
		'id'            => 'footer2',
		'class'         => 'footer2',
		'name'          => __( 'Footer 2', 'text_domain' ),
		'description'   => __( 'Use this to display address, message, scripture', 'text_domain' ),
	);
	register_sidebar( $args );
		register_sidebar( $args );
		$args = array(
		'id'            => 'footer3',
		'class'         => 'footer3',
		'name'          => __( 'Footer 3', 'text_domain' ),
		'description'   => __( 'Use this to display address, message, scripture', 'text_domain' ),
	);
	register_sidebar( $args );
}
add_action( 'widgets_init', 'custom_sidebar' );