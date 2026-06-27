<?php get_header(); ?>
	
	<section class="archive">
		<div class="archive--wrap wrap">

			<?php if (have_posts()) : ?>

				<?php $post = $posts[0]; ?>

				<h1>
					<?php if (is_category()) : ?>
						<?php single_cat_title(); ?>
					<?php elseif( is_tag() ) : ?>
						#<?php single_tag_title(); ?>
					<?php elseif (is_day()) : ?>
						Fecha: <?php the_time('F jS, Y'); ?>
					<?php elseif (is_month()) : ?>
						Fecha: <?php the_time('F, Y'); ?>
					<?php elseif (is_year()) : ?>
						Fecha: <?php the_time('Y'); ?>
					<?php elseif (is_author()) : ?>
						Autor:
					<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
						Blog
					<?php endif ?>
				</h1>
				
				<div class="grid">

					<?php while (have_posts()) : the_post(); ?>
						<a 
						class="grid__item" 
						href="<?= the_permalink() ?>" 
						style="background-image: url(<?= get_the_post_thumbnail_url('','large') ?>);">
							<div class="grid__item--holder">
								<div class="grid__item--inner">
									<div class="grid__item--ttl"><?php the_title() ?></div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					
					<div class="grid__nav">
						<?php posts_nav_link('&nbsp;','<span class="fwd">&larr; <i>Posts</i> Recientes</span>','<span class="prev"><i>Posts</i> Anteriores &rarr;</span>'); ?>
					</div>

				</div>
				
			<?php endif; ?>

		</div>
	</section>

<?php get_footer(); ?>
