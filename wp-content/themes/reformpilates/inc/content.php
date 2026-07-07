
	<?php if ($content = get_field('content')): ?>
		<?php foreach ($content as $c): ?>
			<?php if ($c['acf_fc_layout'] == 'banner'): ?>
				<section class="banner">
					<div class="banner--wrap wrap">
						<div class="banner__content" style="background-image:url(<?= wp_get_attachment_image_src($c['img'],'xl')[0] ?>);">
							<div class="banner__content--txt"><?= $c['txt'] ?></div>
						</div>
					</div>
				</section>
			<?php elseif ($c['acf_fc_layout'] == 'txt_img'): ?>
				<div class="txt_img--anchor" id="<?= $c['anchor'] ?>"></div>
				<section class="txt_img <?= $c['color'] ?>">
					<div class="txt_img--wrap wrap">
						<div class="txt_img__content <?= $c['orden'] ?>">
							<div class="txt_img__content--txt" data-parallax="0.2"><?= $c['txt'] ?></div>
							<img class="txt_img__content--img" data-parallax="-0.2" src="<?= wp_get_attachment_image_src($c['img'],'large')[0] ?>">
						</div>
					</div>
				</section>
			<?php elseif ($c['acf_fc_layout'] == 'accordion'): ?>
				<section class="accordion <?= $c['color'] ?>">
					<div class="accordion--wrap wrap">
						<div class="accordion__content">
							<div class="accordion__content--ttl"><?= $c['ttl'] ?></div>
							<?php foreach ($c['items'] as $i): ?>
								<div class="accordion__item">
									<div class="accordion__item--ttl"><?= $i['ttl'] ?></div>
									<div class="accordion__item--sub"><?= $i['sub'] ?></div>
									<div class="accordion__item--txt"><?= $i['txt'] ?></div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				</section>
			<?php elseif ($c['acf_fc_layout'] == 'slider'): ?>
				<?php if (empty($c['hide_section'])): ?>
				<section class="slider <?= $c['color'] ?>">
					<div class="slider__content">
						<div class="slider--wrap wrap">
							<div class="slider__content--ttl"><?= $c['ttl'] ?></div>
						</div>
						<div class="slider__content--slider slider_JS">
							<?php foreach ($c['slides'] as $s): ?>
								<?php if (empty($s['hide_slide'])): ?>
								<div class="slider__item">
									<div class="slider__item--img" style="background-image:url(<?= wp_get_attachment_image_src($s['img'],'large')[0] ?>);">
										<span></span>
									</div>
									<div class="slider__item--meta">
										<div class="slider__item--ttl"><?= $s['ttl'] ?></div>
										<div class="slider__item--sub"><?= $s['sub'] ?></div>
										<div class="slider__item--txt"><?= $s['txt'] ?></div>
									</div>
								</div>
								<?php endif; ?>
							<?php endforeach ?>
						</div>
					</div>
				</section>
				<?php endif; ?>



			<?php elseif ($c['acf_fc_layout'] == 'map'): ?>
				<section class="map slider">
					<div class="map--wrap wrap slider__content">
						<?php $is_slider = !empty($c['maps']) && count($c['maps']) > 2; ?>
						<div class="<?= $is_slider ? 'slider__content--slider map_slider_JS' : 'map__grid' ?>">
							<?php if (!empty($c['maps'])): ?>
								<?php foreach ($c['maps'] as $index => $m): ?>
									<?php 
										$lat = (isset($m['map']) && is_array($m['map']) && isset($m['map']['lat'])) ? $m['map']['lat'] : '';
										$lng = (isset($m['map']) && is_array($m['map']) && isset($m['map']['lng'])) ? $m['map']['lng'] : '';
									?>
									<div class="slider__item">
										<div class="slider__item--img">
											<?php if ($lat && $lng): ?>
											<div class="map_JS_instance map__content--item" data-lat="<?= $lat ?>" data-lng="<?= $lng ?>" style="border: none; border-radius: 0;"></div>
											<?php endif; ?>
										</div>
										<div class="slider__item--meta">
											<div class="slider__item--txt"><?= isset($m['txt']) ? $m['txt'] : '' ?></div>
											<div style="margin-top: 20px;">
												<?php $loc_slug = isset($m['location_slug']) ? $m['location_slug'] : ''; ?>
												<a class="header__menu--btn slider__item--btn" style="position: relative; display: inline-block; margin: 0;" href="<?php bloginfo('url') ?>/<?php pll_e('book') ?>?location=<?= urlencode($loc_slug) ?>"><?php pll_e('Reserva') ?> <span><?php pll_e('tu sesión') ?></span></a>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
					<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzKb8-Y2cdQUKajFsLPvsO_SP6A_qt1Bs&callback=initMaps" type="text/javascript"></script>
					<script type="text/javascript">
						// Initialize slick slider specifically for maps
						document.addEventListener("DOMContentLoaded", function() {
							if (typeof jQuery !== 'undefined') {
								jQuery('.map_slider_JS').slick({
									dots: false,
									fade: false,
									speed: 600,
									arrows: true,
									autoplay: false,
									infinite: false,
									centerMode: false,
									pauseOnHover: true,
									variableWidth: true,
									slidesToShow: 2,
									autoplaySpeed: 3000,
								});
							}
						});

						function initMaps() {
							var mapElements = document.querySelectorAll('.map_JS_instance');
							for (var i = 0; i < mapElements.length; i++) {
								var el = mapElements[i];
								var lat = parseFloat(el.getAttribute('data-lat'));
								var lng = parseFloat(el.getAttribute('data-lng'));
								
								if (!isNaN(lat) && !isNaN(lng)) {
									var mapOptions = {
										zoom: 16,
										center: new google.maps.LatLng(lat, lng),
										zoomControl: false,
										scaleControl: false,
										mapTypeControl: false,
										streetViewControl: false,
										gestureHandling: el.closest('.map_slider_JS') ? 'none' : 'auto'
									};
									var map = new google.maps.Map(el, mapOptions);
									var marker = new google.maps.Marker({
										map: map,
										position: new google.maps.LatLng(lat, lng),
									});
								}
							}
						}
						// If google is already loaded, init maps directly (e.g. timeout or dynamic)
						if (typeof google === 'object' && typeof google.maps === 'object') {
							initMaps();
						}
					</script>
				</section>
			<?php else: ?>
				<?php echo '<pre>',print_r($c),'</pre>' ?>
			<?php endif ?>
		<?php endforeach ?>
	<?php endif ?>
