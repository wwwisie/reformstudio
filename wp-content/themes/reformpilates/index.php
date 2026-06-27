

<?php get_header(); ?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<a class="<?php $cat = get_the_category(); $cat = $cat[0]; echo strtolower($cat->cat_name); ?>" target="_self" href="<?php the_permalink(); ?>">	
			<div class="post">
				
			</div>
		</a>
	
	<?php endwhile; endif; ?>		

<?php get_footer(); ?>
