
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
				<section class="map">
					<div class="map--wrap wrap">
						<div class="map__content">
							<div class="map__content--container">
								<div id="map_JS" class="map__content--item"></div>
								<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzKb8-Y2cdQUKajFsLPvsO_SP6A_qt1Bs&callback=initMap" type="text/javascript"></script>
								<script type="text/javascript">
									google.maps.event.addDomListener(window,'load',init);
									function initMap() {
										var mapOptions = {
											zoom: 16,
											center: new google.maps.LatLng(<?= $c['map']['lat'] ?>,<?= $c['map']['lng'] ?>),
											zoomControl: false,
											scaleControl: false,
											mapTypeControl: false,
											streetViewControl: false,
											// styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":-17}]}]
										};
										var mapElement = document.getElementById('map_JS');
										var map = new google.maps.Map(mapElement, mapOptions);
										var marker = new google.maps.Marker({ //jshint ignore:line
											map: map,
											position: new google.maps.LatLng(<?= $c['map']['lat'] ?>,<?= $c['map']['lng'] ?>), //jshint ignore:line
										})
									}
								</script>

							</div>
							<div class="map__content--txt"><?= $c['txt'] ?></div>
						</div>
					</div>
				</section>
			<?php else: ?>
				<?php echo '<pre>',print_r($c),'</pre>' ?>
			<?php endif ?>
		<?php endforeach ?>
	<?php endif ?>
