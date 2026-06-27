<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article class="page">
			<?php include_once('inc/content.php'); ?>
		</article>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
