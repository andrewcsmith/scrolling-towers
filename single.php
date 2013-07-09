<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="main" role="main">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <header>
      <h2><?php the_title(); ?></a></h2>
    </header>
		<?php if(has_post_thumbnail()) {
			?><div class="post-thumbnail"><?php
			the_post_thumbnail();
			?></div><?php
		} ?>
		<div class="post-content">
	    <?php the_content('Read the rest of this entry &raquo;'); ?>
		</div>
    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    <?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
    <footer>
      <?php if(!in_descendent_category(array('art'))) : ?>
      <p>This entry was posted 
      on <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
      at <time><?php the_time() ?></time>
      and is filed under <?php the_category(', ') ?>.
      <?php edit_post_link('Edit this entry','','.'); ?>
      </p>
      <?php endif; ?>
    </footer>
    <nav>
			<div><?php previous_post_link('&laquo; %link') ?></div><div> | </div><div><?php next_post_link('%link &raquo;') ?></div>
    </nav>

    <?php // comments_template(); ?>

  </article>

<?php endwhile; else: ?>

  <p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

</div>

<?php get_footer(); ?>
