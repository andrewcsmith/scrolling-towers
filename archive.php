<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="main" role="main">
  <?php if (have_posts()) : ?>
		<div id="feed-container">
  		<aside class="article-container-wrapper sidebar" id="home-sidebar">
  			<div class="article-container">
  				<?php dynamic_sidebar('home-sidebar'); ?>
  			</div>
  		</aside>
			    <?php while (have_posts()) : the_post(); ?>
						<div class="article-container-wrapper">
							<div class="article-container">
						    <article <?php post_class() ?>>
						      <header>
						        <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
										<?php if(has_post_thumbnail()) {
											?><div class="post-thumbnail"><?php
											the_post_thumbnail();
											?></div><?php
										} ?>
                    <?php if(!in_descendent_category(array('art'))) : ?>
										<div class="post-meta">
							        <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
										</div>
                    <?php endif; ?>
						      </header>
						      <?php the_content() ?>
						      <footer>
						        <?php the_tags('Tags: ', ', ', '<br />'); ?>
						        Posted in <?php the_category(', ') ?>
						        | <?php edit_post_link('Edit', '', ' | '); ?>
						        <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
						      </footer>
						    </article>
							</div>
						</div>
			    <?php endwhile; ?>

			  </section>
			</div>
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
	<?php endif; ?>

</div>

<?php //dynamic_sidebar('writing-sidebar'); ?>

<?php get_footer(); ?>
