<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="main" role="main">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article class="post" id="post-<?php the_ID(); ?>">
    <header>
      <h2><?php the_title(); ?></h2>
    </header>
		<?php if(has_post_thumbnail()) {
			?><div class="post-thumbnail"><?php
			the_post_thumbnail();
			?></div><?php
		} ?>
		
    <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
  
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
  </article>
  <?php endwhile; endif; ?>
	
  <?php // comments_template(); ?>

</div>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
