<?php
/*
Template Name: Horizontal
*/
?>

<?php get_header(); ?>

<div id="main" role="main" class="horizontal">
	<aside class="sidebar">
			<?php 
			$cat_sidebar = strtolower(single_cat_title( '', false )) . '-sidebar';
			if ( is_active_sidebar( $cat_sidebar )) :
				dynamic_sidebar( $cat_sidebar ); 
			else :
				dynamic_sidebar( 'home-sidebar' );
			endif;
			?>
	</aside>
	<div class="content">
	  <?php if (have_posts()) : ?>
			<?php // removed the feed container ?>
			    <?php while (have_posts()) : the_post(); ?>
							<div class="article-container">
						    <article <?php post_class() ?>>
						      <header>
						        <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
										<div class="post-meta">
							        <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
										</div>
									</header>
                  <?php if(has_post_thumbnail()) {
										?><div class="post-thumbnail"><?php
										the_post_thumbnail(array(240,240));
										?></div><?php
  									} ?>
						      <?php the_content() ?>
						      <footer>
						        <?php the_tags('Tags: ', ', ', '<br />'); ?>
						        Posted in <?php the_category(', ') ?>
						        | <?php edit_post_link('Edit', '', ' | '); ?>
						        <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
						      </footer>
						    </article>
							</div>
			    <?php endwhile; ?>
				<div class="posts-nav-links"><?php posts_nav_link( ' | ', __('View Newer Entries'), __('View Older Entries') ); ?></div>
			  </section>
			</div>
	  <?php else : ?>
			<article class="post category-empty">
			<?php 
	  if ( is_category() ) { // If this is a category archive
	    printf("<h2>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
	  } else if ( is_date() ) { // If this is a date archive
	    echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
	  } else if ( is_author() ) { // If this is a category archive
	    $userdata = get_userdatabylogin(get_query_var('author_name'));
	    printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
	  } else {
	    echo("<h2>No posts found.</h2>");
	  }
	  get_search_form(); ?>
			</article>
		<?php endif; ?> <!-- if have_posts -->
</div>



<?php get_footer(); ?>

