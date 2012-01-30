<?php
if ( function_exists('register_sidebars') )
    register_sidebar(array(
		'name' => 'Sidebar',
		'description' => 'This is the regular, widgetized sidebar for everything else',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
		'name' => 'Left Footer Box',
		'description' => 'This is the left box in the footer.',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
		'name' => 'Center Footer Box',
		'description' => 'This is the center box in the footer.',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
		'name' => 'Right Footer Box',
		'description' => 'This is the right box in the footer.',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));


// clear shortcode
// a quick shortcode that clears floats
function clear() {
	return '<div class="clear"></div>';
}
add_shortcode('clear','clear');

/* load styles and scripts */
/*
   twitter_anywhere = loads the twitter @anywhere framework
   twitter_hovercards = loads twitter hovercards from @anywhere
   suckerfish = loads suckerfish from the theme's /js files
*/
function ap_core_load_scripts() {
  if ( !is_admin() ) { // instruction to only load if it is not the admin area
  	$theme  = get_theme( get_current_theme() );
     // this loads the twitter anywhere framework
     wp_register_script('twitter_anywhere','http://platform.twitter.com/anywhere.js?id=3O4tZx3uFiEPp5fk2QGq1A',false,$theme['Version'] );
     wp_enqueue_script('twitter_anywhere');
     // this loads twitter hovercards, dependent upon twitter anywhere
     wp_register_script('twitter_hovercards',get_bloginfo('template_directory').'/js/hovercards.js','twitter_anywhere',$theme['Version']);
     wp_enqueue_script('twitter_hovercards');
     // this loads suckerfish.js the dropdown menus
     wp_register_script('suckerfish',get_bloginfo('template_directory').'/js/suckerfish.js',false,$theme['Version']);
     wp_enqueue_script('suckerfish');
      // this loads jquery (for formalize, among other things)
      wp_enqueue_script('jquery');
     // this loads the formalize js
     wp_register_script('formalize',get_bloginfo('template_directory').'/js/jquery.formalize.min.js',false,$theme['Version']);
     wp_enqueue_script('formalize');
     // loads modernizr for BPH5
     wp_register_script('modernizr',get_bloginfo('template_directory').'/js/modernizr-2.0.6.min.js',false,'2.0.6');
     wp_enqueue_script('modernizr');
     // this loads the font stack
     wp_register_style('corefonts','http://fonts.googleapis.com/css?family=Play|Gruppo',false,$theme['Version']);
     wp_enqueue_style('corefonts');
     // this loads the style.css
     wp_register_style('corecss',get_bloginfo('stylesheet_url'),false,$theme['Version']);
     wp_enqueue_style('corecss');
  }
}
add_action( 'init', 'ap_core_load_scripts' );

/* WordPress core functionality */
function ap_core_setup() {
	// post thumbnail support
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150 ); // 150 pixels wide by 150 pixels tall, box resize mode
	if ( ! isset( $content_width ) ) $content_width = 1140;

	// custom nav menus
	// This theme uses wp_nav_menu() in three (count them, three!) locations.
	register_nav_menus( array(
		'top' => __( 'Top Header Navigation', 'core' ),
		'footer' => __( 'Footer Navigation', 'core' ),
	) );

	// This adds a home link option in the Menus
	function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
	}
	add_filter( 'wp_page_menu_args', 'home_page_menu_args' );


	// post formats
	// register all post formats -- child themes can remove some post formats as they so desire
	add_theme_support('post-formats',array('aside','gallery','link','image','quote','status','video','audio','chat'));

	// automatic feed links
	add_theme_support('automatic-feed-links');

	// this changes the output of the comments
	function ap_core_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="the_comment">
      <div class="comment-author vcard">
         <?php echo get_avatar
	($comment,$size='64',$default='<path_to_url>' ); ?>
	On <?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?>
     <?php printf(__('<cite>%s</cite> <span class="says">said:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
      <?php comment_text() ?>
      <div class="comment-meta commentmetadata"><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
      <div class="reply"><button>
         <?php comment_reply_link(array_merge
		 ( $args, array('depth' => $depth, 'reply_text' => 'Respond to this', 'max_depth' => $args['max_depth']))) ?>
      </button></div>
     </div>
	<?php
        }

	// this changes the default [...] to be a read more hyperlink
	function new_excerpt_more($more) {
		return '...&nbsp;(<a href="'. get_permalink($post->ID) . '">' . 'read more' . '</a>)';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

}
add_action('after_setup_theme','ap_core_setup');


?>