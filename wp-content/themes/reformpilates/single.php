<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<article class="single">
			<div class="single--wrap wrap">

				<h1 class="single--ttl"><?php the_title(); ?></h1>
				<div class="single__meta">
					<?php if ($cats = get_the_category()): ?>
						<div class="single__meta--cats">
							<?php foreach ($cats as $cat): ?>
								<span><?= $cat->cat_name; ?></span>
							<?php endforeach ?>
						</div>
					<?php endif ?>
					<div class="single__meta--time"><?php the_time('d.m.Y') ?></div>
				</div>
				<div class="single__cintent"><?php the_content() ?></div>

			</div>
		</article>
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>

