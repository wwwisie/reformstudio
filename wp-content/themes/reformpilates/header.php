<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

	<title>
		<?php bloginfo('name'); ?>
		<?= (is_singular() || is_page()) && !is_front_page() ? ' | '.get_the_title() : '' ; ?>
		<?php /*if (get_bloginfo('description')): ?>
			<?= is_front_page() ? ' | '.get_bloginfo('description') : '' ; ?>
		<?php endif*/ ?>
	</title>

	<meta name="description" content="<?php bloginfo('description'); ?>" />
	
	<?php
	if (get_the_post_thumbnail_url()) {
		$share_img = get_the_post_thumbnail_url();
	} elseif (get_field('share_img','option')) {
		$share_img = get_field('share_img','option');
	} else {
		$share_img = get_bloginfo('template_url').'/screenshot.png';
	}
	?>

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@">
	<meta name="twitter:title" content="<?php bloginfo('name'); ?><?= (is_singular() || is_page()) && !is_front_page() ? ' | '.get_the_title() : '' ; ?><?= is_front_page() ? ' | '.get_bloginfo('description') : '' ; ?>">
	<meta name="twitter:description" content="<?php if (is_singular()) { echo strip_tags(get_the_content()); } else { echo bloginfo('description'); } ?>">
	<meta name="twitter:creator" content="@">
	<meta name="twitter:image" content="<?= $share_img ?>">

	<!-- Open Graph data -->
	<meta property="og:title" content="<?php bloginfo('name'); ?><?= (is_singular() || is_page()) && !is_front_page() ? ' | '.get_the_title() : '' ; ?><?= is_front_page() ? ' | '.get_bloginfo('description') : '' ; ?>">
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:image" content="<?= $share_img ?>"/>
	<meta property="og:description" content="<?php if (is_singular()) { echo strip_tags(get_the_content()); } else { echo bloginfo('description'); } ?>"/>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="fb:admins" content="" />
	
	<?php include_once('inc/general/favicon.php'); ?>
	
	<?php wp_head(); ?>
	
</head>

<body>

	<?php if (get_field('cover_img') && get_field('cover_txt')): ?>
		<section class="cover cover_JS" style="background-image:url(<?= wp_get_attachment_image_src(get_field('cover_img'),'xl')[0] ?>);">
			<div id="canvas"></div>
			<div class="plane">
				<img src="<?= wp_get_attachment_image_src(get_field('cover_img'),'xl')[0] ?>" />
			</div>
			<script id="plane-vs" type="x-shader/x-vertex">
				#ifdef GL_ES
				precision mediump float;
				#endif

				attribute vec3 aVertexPosition;
				attribute vec2 aTextureCoord;

				uniform mat4 uMVMatrix;
				uniform mat4 uPMatrix;

				varying vec3 vVertexPosition;
				varying vec2 vTextureCoord;

				void main() {
					vec3 vertexPosition = aVertexPosition;

					gl_Position = uPMatrix * uMVMatrix * vec4(vertexPosition, 1.0);

					vTextureCoord = aTextureCoord;
					vVertexPosition = vertexPosition;
				}
			</script>
			<script id="plane-fs" type="x-shader/x-fragment">
				#ifdef GL_ES
				precision mediump float;
				#endif

				varying vec3 vVertexPosition;
				varying vec2 vTextureCoord;

				uniform float uTime;

				uniform sampler2D uSampler0;

				void main() {
					vec2 textureCoord = vTextureCoord;

					const float PI = 3.141592;

					textureCoord.x += (
						sin(textureCoord.x * 10.0 + ((uTime * (PI / 3.0)) * 0.031))
						+ sin(textureCoord.y * 10.0 + ((uTime * (PI / 2.489)) * 0.017))
						) * 0.0500;

					textureCoord.y += (
						sin(textureCoord.y * 10.0 + ((uTime * (PI / 2.023)) * 0.023))
						+ sin(textureCoord.x * 10.0 + ((uTime * (PI / 3.1254)) * 0.037))
						) * 0.0500;

					gl_FragColor = texture2D(uSampler0, textureCoord);
				}
			</script>
			<script src="<?php bloginfo('template_url') ?>/js/min/curtains.min.js" type="text/javascript"></script>		
			<div class="cover--wrap wrap">
				<div class="cover--txt"><?= get_field('cover_txt') ?></div>
			</div>
		</section>
	<?php endif ?>

	<header class="header header_JS">
		<div class="header--wrap wrap">
			<a class="header__logo" href="<?php bloginfo('url') ?>">
				<img class="header__logo--img" src="<?php bloginfo('template_url') ?>/img/logo.svg">
				<img class="header__logo--icon" src="<?php bloginfo('template_url') ?>/img/logo-icon.svg">
			</a>
			<nav class="header__menu menu_JS">
				<a class="header__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/#reformer">Reformer</a>
				<a class="header__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/#mat">Mat</a>
				<a class="header__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/#yoga">Yoga</a>
				<a class="header__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/#team"><?php pll_e('Nuestro Equipo') ?></a>
				<a class="header__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/<?php pll_e('nosotros') ?>"><?php pll_e('Sobre Reform') ?></a>
			</nav>
			<div class="header__lang">
				<?php pll_the_languages(array(
					'display_names_as' => 'slug'
				)) ?>
			</div>
			<a class="header__menu--btn" href="<?php bloginfo('url') ?>/<?php pll_e('book') ?>"><?php pll_e('Reserva') ?> <span><?php pll_e('tu sesión') ?></span></a>
			<div class="header--btn menu_btn_JS"></div>
		</div>
	</header>

