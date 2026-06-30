<?php /* Template Name: Reserva */ ?>

<?php get_header(); ?>
	
	<section class="rsvp">
		<div class="rsvp--wrap wrap">
			<!-- <img src="<?php bloginfo('template_url') ?>/img/mindbody.svg"> -->
			<div class="rsvp--widget">
				<script src="https://widgets.mindbodyonline.com/javascripts/healcode.js" type="text/javascript"></script>
				<healcode-widget data-type="schedules" data-widget-partner="object" data-widget-id="fd202937229c" data-widget-version="1" ></healcode-widget>
			</div>
		</div>
		<?php include_once('inc/content.php'); ?>
	</section>

<?php get_footer(); ?>

