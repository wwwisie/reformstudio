<?php /* Template Name: Reserva */ ?>

<?php get_header(); ?>
	
	<section class="rsvp">
		<div class="rsvp--wrap wrap">
			<!-- <img src="<?php bloginfo('template_url') ?>/img/mindbody.svg"> -->
			<div class="rsvp--widget">
				<script src="https://widgets.mindbodyonline.com/javascripts/healcode.js" type="text/javascript"></script>
				<healcode-widget data-type="schedules" data-widget-partner="object" data-widget-id="fd202937229c" data-widget-version="1" ></healcode-widget>

				<script type="text/javascript">
					document.addEventListener("DOMContentLoaded", function() {
						var urlParams = new URLSearchParams(window.location.search);
						var locationParam = urlParams.get('location');

						var attempts = 0;
						var maxAttempts = 100; // 10 seconds max
						var interval = setInterval(function() {
							attempts++;
							var select = document.querySelector('select.location_alias');
							
							// Ensure the select dropdown is in the DOM and options have loaded
							if (select && select.options.length > 1) {
								clearInterval(interval);

								// Correct "All Location S" typo based on document language
								var firstOption = select.options[0];
								if (firstOption && firstOption.value === "") {
									var lang = document.documentElement.lang || 'es';
									if (lang.toLowerCase().indexOf('en') !== -1) {
										firstOption.text = "All Locations";
									} else {
										firstOption.text = "Todas las sedes";
									}
								}

								if (!locationParam) return;

								var targetValue = '';
								var searchStr = locationParam.toLowerCase().trim();

								var options = select.options;
								
								// Loop through all locations dynamically fetched from Mindbody
								for (var i = 0; i < options.length; i++) {
									var optionText = options[i].text.toLowerCase();
									// Match if option text contains the keyword or vice-versa
									if (optionText.indexOf(searchStr) !== -1 || searchStr.indexOf(optionText) !== -1) {
										targetValue = options[i].value;
										break;
									}
								}

								if (targetValue) {
									// 1. Set values immediately
									select.value = targetValue;
									
									// 2. Trigger events immediately
									select.dispatchEvent(new Event('change', { bubbles: true }));
									if (typeof jQuery !== 'undefined') {
										jQuery(select).trigger('change');
									}

									// 3. Trigger events again after 500ms to ensure any late-bound Mindbody event listeners catch it
									setTimeout(function() {
										select.value = targetValue;
										select.dispatchEvent(new Event('change', { bubbles: true }));
										if (typeof jQuery !== 'undefined') {
											jQuery(select).trigger('change');
										}
									}, 500);
								}
							}
							if (attempts >= maxAttempts) {
								clearInterval(interval);
							}
						}, 100);
					});
				</script>
			</div>
		</div>
		<?php include_once('inc/content.php'); ?>
	</section>

<?php get_footer(); ?>

