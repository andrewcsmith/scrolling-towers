<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

// Custom HTML5 Comment Markup
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li>
     <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
       <header class="comment-author vcard">
          <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
          <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
          <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a></time>
          <?php edit_comment_link(__('(Edit)'),'  ','') ?>
       </header>
       <?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.') ?></em>
          <br />
       <?php endif; ?>

       <?php comment_text() ?>

       <nav>
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
       </nav>
     </article>
    <!-- </li> is added by wordpress automatically -->
<?php
}

automatic_feed_links();

// Widgetized Sidebar HTML5 Markup
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name'         => __( 'Writing Sidebar' ),
		'id'           => 'writing-sidebar',
		'description'  => 'Only appears on the Writing categories page',
		'before_widget'=> '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title'  => '</h2>',
	));
	register_sidebar(array(
		'name'         => __( 'News Sidebar' ),
		'id'           => 'news-sidebar',
		'description'  => 'Only appears on the news page. If empty, uses Home Sidebar instead',
		'before_widget'=> '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title'  => '</h2>',
	));
	register_sidebar(array(
		'name'         => __( 'Home Sidebar' ),
		'id'           => 'home-sidebar',
		'description'  => 'Default sidebar appears on the home page',
		'before_widget'=> '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title'  => '</h2>',
	));
}

// Custom Functions for CSS/Javascript Versioning
$GLOBALS["TEMPLATE_URL"] = get_bloginfo('template_url')."/";
$GLOBALS["TEMPLATE_RELATIVE_URL"] = wp_make_link_relative($GLOBALS["TEMPLATE_URL"]);

// Add ?v=[last modified time] to style sheets
function versioned_stylesheet($relative_url, $add_attributes=""){
  echo '<link rel="stylesheet" href="'.versioned_resource($relative_url).'" '.$add_attributes.'>'."\n";
}

// Add ?v=[last modified time] to javascripts
function versioned_javascript($relative_url, $add_attributes=""){
  echo '<script src="'.versioned_resource($relative_url).'" '.$add_attributes.'></script>'."\n";
}

// Add ?v=[last modified time] to a file url
function versioned_resource($relative_url){
  $file = $_SERVER["DOCUMENT_ROOT"].$relative_url;
  $file_version = "";

  if(file_exists($file)) {
    $file_version = "?v=".filemtime($file);
  }

  return $relative_url.$file_version;
}

// Adds the main header menu
add_action('init', 'register_primary_menu');
function register_primary_menu() {
	register_nav_menu( 'primary-menu', __('Primary Menu'));
}

add_theme_support( 'post-thumbnails' );
 
if ( ! function_exists( 'in_descendent_category' ) ) {
	function in_descendent_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
      $cat = get_term_by('name', $cat, 'category')->term_id;
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}

// *** Category Template Redirection ***
// Inspired by a snippet by Justin Tadlock (http://justintadlock.com/) posted here: http://elliotjaystocks.com/blog/tutorial-multiple-singlephp-templates-in-wordpress/#comment-2383
// Original Gist: https://gist.github.com/mjangda/275170#file-category_template_filter-php
// Calls the horizontal template for certain types of posts
add_filter( 'category_template', 'horizontal_template' );
function horizontal_template( $template ) {
  $horizontal_categories = array('news', 'writing');
	if( is_category( $horizontal_categories ) || 
      in_descendent_category( $horizontal_categories ) ) 
  {
		$template = locate_template( array( 'horizontal.php', 'category.php' ) );
  }
	return $template;
}

add_action('pre_get_posts', 'restrict_to_projects');
function restrict_to_projects( $query ) {
  if ( $query->is_home() && $query->is_main_query() ) {
	$query->set('category_name', 'featured');
  $query->set('order', 'DESC');
  $query->set('orderby', 'meta_value');
  $query->set('meta_key', 'featured_rank');
  }
	return $query;
}