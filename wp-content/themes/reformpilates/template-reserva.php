<?php /* Template Name: Reserva */ ?>

<?php get_header(); ?>
	
<?php
// Check if a location query parameter is present
$location_param = isset($_GET['location']) ? $_GET['location'] : '';

// Fetch maps layout data from the homepage to render the selection step
$front_page_id = function_exists('pll_get_post') ? pll_get_post(get_option('page_on_front')) : get_option('page_on_front');
$front_content = get_field('content', $front_page_id);
$maps_data = null;
if ($front_content) {
	foreach ($front_content as $layout) {
		if ($layout['acf_fc_layout'] === 'map') {
			$maps_data = $layout;
			break;
		}
	}
}

// Dynamic fail-safe translations
$lang = function_exists('pll_current_language') ? pll_current_language() : 'es';
$select_title = ($lang === 'en') ? 'Select your location' : 'Selecciona tu sede';
$select_btn   = ($lang === 'en') ? 'Select' : 'Seleccionar';
?>

	<style>
		/* Hide the widget container off-screen on load so third-party scripts can initialize and bind events normally */
		.rsvp--widget-container.is-hidden {
			position: absolute !important;
			left: -9999px !important;
			top: -9999px !important;
			width: 100% !important;
			opacity: 0 !important;
			height: 0 !important;
			overflow: hidden !important;
			pointer-events: none !important;
		}
	</style>

	<section class="rsvp">
		<div class="rsvp--wrap wrap">
			<?php if (empty($location_param) && !empty($maps_data['maps'])): ?>
				<!-- 1. Location selection step (only if entering without location query) -->
				<div class="rsvp--location-select map slider" style="margin-bottom: 50px;">
					<div class="map--wrap wrap slider__content">
						<h2 style="text-align: center; margin-bottom: 50px; font-size: 28px; font-weight: 300; letter-spacing: 1px;">
							<?= esc_html($select_title) ?>
						</h2>
						<?php $is_slider = count($maps_data['maps']) > 2; ?>
						<div class="<?= $is_slider ? 'slider__content--slider map_slider_JS' : 'map__grid' ?>">
							<?php foreach ($maps_data['maps'] as $index => $m): ?>
								<?php 
									$loc_slug = isset($m['location_slug']) ? $m['location_slug'] : '';
								?>
								<div class="slider__item">
									<div class="slider__item--meta">
										<div class="slider__item--txt"><?= isset($m['txt']) ? $m['txt'] : '' ?></div>
										<div style="margin-top: 20px;">
											<a class="header__menu--btn slider__item--btn js-location-select-btn" 
											   style="position: relative; display: inline-block; margin: 0; cursor: pointer;" 
											   data-slug="<?= esc_attr($loc_slug) ?>">
												<?= esc_html($select_btn) ?>
											</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!-- 2. Mindbody Widget Container (hidden initially if no location query parameter is present) -->
			<div class="rsvp--widget-container <?= empty($location_param) ? 'is-hidden' : '' ?>">
				<div class="rsvp--widget">
					<script src="https://widgets.mindbodyonline.com/javascripts/healcode.js" type="text/javascript"></script>
					<healcode-widget data-type="schedules" data-widget-partner="object" data-widget-id="fd202937229c" data-widget-version="1" ></healcode-widget>
				</div>
			</div>
		</div>

		<!-- Dropdown filter helper & click listener -->
		<script type="text/javascript">
			function filterWidget(locationParam) {
				var attempts = 0;
				var maxAttempts = 100; // 10 seconds max
				var interval = setInterval(function() {
					attempts++;
					var select = document.querySelector('select.location_alias');
					
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
						
						for (var i = 0; i < options.length; i++) {
							var optionText = options[i].text.toLowerCase();
							if (optionText.indexOf(searchStr) !== -1 || searchStr.indexOf(optionText) !== -1) {
								targetValue = options[i].value;
								break;
							}
						}

						if (targetValue) {
							select.value = targetValue;
							select.dispatchEvent(new Event('change', { bubbles: true }));
							if (typeof jQuery !== 'undefined') {
								jQuery(select).trigger('change');
							}

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
			}

			document.addEventListener("DOMContentLoaded", function() {
				var urlParams = new URLSearchParams(window.location.search);
				var initialLoc = urlParams.get('location');
				
				// If location param was present, run the filter script immediately
				if (initialLoc) {
					filterWidget(initialLoc);
				}

				// Handle clicking a location in the select screen
				document.addEventListener("click", function(e) {
					var selectBtn = e.target.closest(".js-location-select-btn");
					if (selectBtn) {
						e.preventDefault();
						var slug = selectBtn.getAttribute("data-slug");
						if (slug) {
							// Update URL query parameter without reloading
							var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?location=" + encodeURIComponent(slug);
							window.history.pushState({ path: newUrl }, '', newUrl);

							// Hide maps selection step
							var selectStep = document.querySelector(".rsvp--location-select");
							if (selectStep) {
								selectStep.style.display = "none";
							}
							
							// Show widget container
							var widgetContainer = document.querySelector(".rsvp--widget-container");
							if (widgetContainer) {
								widgetContainer.classList.remove("is-hidden");
							}

							// Trigger filtering and map to the select option
							filterWidget(slug);
						}
					}
				});
			});
		</script>

		<?php include_once('inc/content.php'); ?>
	</section>

<?php get_footer(); ?>

