<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); 

?>

<div id="main" role="main">
	<div id="feed-container">
		<aside class="article-container-wrapper sidebar" id="home-sidebar">
			<div class="article-container">
				<?php dynamic_sidebar('home-sidebar'); ?>
			</div>
		</aside>
		
	  <?php 
		if (have_posts()) : 	
			while (have_posts()) : the_post(); ?>
				<div class="article-container-wrapper">
					<div class="article-container">
			      <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			        <header>
			          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<?php if(!in_descendent_category(array('art'))) : ?>
			          <div class="post-meta">
									<time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time>
			          	<span class="author">by <?php the_author() ?></span>
								</div>
                <?php endif; ?>
			        </header>
							<?php if(has_post_thumbnail()) {
								?><div class="post-thumbnail"><?php
								the_post_thumbnail();
								?></div><?php
							} ?>
			        <?php the_content('Read the rest of this entry &raquo;'); ?>
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

	  <?php else : ?>

	    <h2>Not Found</h2>
	    <p>Sorry, but you are looking for something that isn't here.</p>
	    <?php get_search_form(); ?>

	  <?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>


