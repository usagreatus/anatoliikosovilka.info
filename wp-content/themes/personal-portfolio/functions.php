<?php
/**
 * Personal Portfolio functions and definitions
 *
 * @package Personal Portfolio

 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

if ( ! function_exists( 'personalportfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function personalportfolio_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on personal-portfolio, use a find and replace
	 * to change 'personal-portfolio' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'personal-portfolio', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => __( 'Primary Menu', 'personal-portfolio' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'personalportfolio_custom_background_args', array(
		'default-image' => get_template_directory_uri().'/images/bg.jpg',
		'default-repeat' => 'repeat'
	) ) );

	add_theme_support( 'custom-header', apply_filters( 'personalportfolio_custom_header_args', array(
	    'default-image'          => '%s/images/rainbow.png',
		'width'                  => 1200,
		'height'                 => 140,
		'default-text-color'     => '#FFF',
		'flex-height'            => true,
	) ) );
		
	add_editor_style();
	
	// WooCommerce Support Declaration
	add_theme_support( 'woocommerce' );
	
	// Custom Image Sizes
	add_image_size( 'featured-image', 240, 136, true );
	add_image_size( 'image-header', 900, 300, true );
}
endif; // personalportfolio_setup
add_action( 'after_setup_theme', 'personalportfolio_setup' );

/*
To change excerpt length
*/
function personalportfolio_excerpt_length( $length ) {
	return get_theme_mod ( 'excerpt_length', 55 );
}
add_filter( 'excerpt_length', 'personalportfolio_excerpt_length', 999 );
/*
Change excerpt more 
more string at the end of the excerpt. 
*/
function personalportfolio_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'personalportfolio_excerpt_more' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function personalportfolio_widgets_init() {
	register_sidebar( array(
		'name'          => sprintf( '%1$s (%2$s)', __('Sidebar', 'personal-portfolio'), __('Right', 'personal-portfolio') ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="widget-bottom">
								<div class="l"></div>
								<div class="r"></div>
							</div>
							</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => sprintf( '%1$s (%2$s)', __('Sidebar', 'personal-portfolio'), __('Left', 'personal-portfolio') ),
		'id'            => 'sidebar-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="widget-bottom">
								<div class="l"></div>
								<div class="r"></div>
							</div>
							</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'personalportfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function personalportfolio_theme_scripts() {
	wp_enqueue_style( 'personal-portfolio-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'personal-portfolio-vegas-style',get_template_directory_uri().'/inc/css/vegas.min.css',array() );
	
	wp_enqueue_style( 'personal-portfolio-bxslider-style',get_template_directory_uri().'/inc/css/bxslider.css',array() );
	
	wp_enqueue_style( 'personal-portfolio-font-awesome',get_template_directory_uri().'/inc/font-awesome/css/font-awesome.min.css',array() );
	
	wp_enqueue_style( 'personal-portfolio-google-fonts','//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700',array() );

	wp_enqueue_script( 'personal-portfolio-navigation', get_template_directory_uri() . '/inc/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'personal-portfolio-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'personal-portfolio-fitvids', get_template_directory_uri() . '/inc/js/jquery.fitvids.js', array('jquery'), '' );
	
	wp_enqueue_script( 'personal-portfolio-fitvids-doc-ready', get_template_directory_uri() . '/inc/js/fitvids-doc-ready.js', array('jquery'), '' );
	
	wp_register_script( 'personal-portfolio-jquery-cycle', get_template_directory_uri() . '/inc/js/jquery.cycle.all.min.js', array( 'jquery' ), '2.9999.5' ); // JQuery cycle js file for slider.
	
	wp_enqueue_script( 'personal-portfolio-vegas', get_template_directory_uri() . '/inc/js/vegas.min.js', array('jquery'), '' );
	
	wp_enqueue_script( 'personal-portfolio-bxslider', get_template_directory_uri() . '/inc/js/jquery.bxslider.min.js', array('jquery'), '' );
	
	wp_enqueue_script( 'personal-portfolio-blackandwhite', get_template_directory_uri() . '/inc/js/jquery.black.and.white.js', array('jquery'), '' );
	
	wp_enqueue_script( 'personal-portfolio-basejs',get_template_directory_uri().'/inc/js/base.js',array('jquery'),'' );

	//  comment-reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Enqueue Slider setup js file.
	 */	
	if( get_theme_mod( 'enable_slider', 1 ) ) { 
		if ( is_home() || is_front_page() ) {
			// Register the slider script
			wp_register_script( 'personalportfolio_slider', get_template_directory_uri() . '/inc/js/slider-setting.js', array( 'personal-portfolio-jquery-cycle' ), 1, true );
			// Slider script with new settings data
			$vars = array(
				'effect' => get_theme_mod( 'slider_effect', 'shuffle' ),
				'speed' => get_theme_mod( 'slider_anim_speed', 1000 ),
				'timeout' => get_theme_mod( 'slider_speed', 2000 ),
			);
			wp_localize_script( 'personalportfolio_slider', 'dinozoom', $vars );
			
			// Enqueued script with localized data.
			wp_enqueue_script( 'personalportfolio_slider' );
		}
	}
	
	/**
    * Browser specific queuing i.e
	* https://gist.github.com/grappler/05568f05633484499acc
    */
	global $wp_scripts;
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.2', false );
	$wp_scripts->add_data( 'html5shiv', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'personalportfolio_theme_scripts' );

/**
 * VEGAS BG Slideshow
 */
function personalportfolio_background_cycle_js() {
	$imagepath =  get_template_directory_uri() . '/images/bg-slider';
	// Vegas Slider Images Array
		$slides = array();
		for( $i=1; $i<=4; $i++) {
			$image = get_theme_mod( "bg_slider_image$i", "$imagepath/$i.jpg" );
			if ($image) $slides [] = "{ src: '".esc_url($image)."' }";
		}
		// No images?
		if ( count($slides) == 0 ) return false;
		
		// Implode
		$slides = implode(",", $slides);
		
		if ( get_theme_mod( 'enable_vegas', 1 ) ):
		?>
		<script type="text/javascript">
		(function($){
			jQuery(document).ready(function($){		
				jQuery('body').vegas({
					slides: [
						<?php echo $slides; ?>
					],
					transition: 'blur',
					animation: 'random',
					//overlay: "/personal-portfolio/inc/css/overlays/01.png"
				});
		
		
			});
		})(jQuery);
		</script>
		<?php
		endif;
}
add_action( 'wp_head', 'personalportfolio_background_cycle_js', 10 );

/**
 * Fav icon for the site
 */
function personalportfolio_favicon() {
	if ( get_theme_mod( 'personalportfolio_activate_favicon', '0' ) ) {
		$personalportfolio_favicon = of_get_option( 'personalportfolio_favicon', '' );
		$personalportfolio_favicon_output = '';
		if ( !empty( $personalportfolio_favicon ) ) {
			$personalportfolio_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $personalportfolio_favicon ).'" type="image/x-icon" />';
		}
		echo $personalportfolio_favicon_output;
	}
}
add_action( 'admin_head', 'personalportfolio_favicon' );
add_action( 'wp_head', 'personalportfolio_favicon' );

/**
 * Hooks the Custom Internal CSS to head section
 */
require get_template_directory() . '/inc/css.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Theme Options Panel
 */
require_once get_template_directory() . '/inc/options-config.php';
require_once get_template_directory() . '/inc/admin/class.customizer-api-wrapper.php';
$obj = new Dinozoom_Customizer_API_Wrapper($options);
/**
 * Slider
 */
require_once( get_template_directory() . '/inc/slider-functions.php' );
/**
 * WooCommerce Support & Functions
 */
require get_template_directory() . '/inc/woocommerce.php';

?>