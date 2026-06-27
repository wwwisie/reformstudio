
	<footer class="footer">
		<div class="footer--wrap wrap">
			
			<a class="footer__logo" href="<?php bloginfo('url') ?>">
				<img class="footer__logo--img" src="<?php bloginfo('template_url') ?>/img/icon.svg">
			</a>

			<div class="footer__sub">
				<a class="footer__sub--btn sub_btn_JS"><?php pll_e('Suscríbete') ?></a>
			</div>

			<div class="footer__menu">
				<a class="footer__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/#reformer">Reformer</a>
				<a class="footer__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/#mat">Mat</a>
				<a class="footer__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/#yoga">Yoga</a>
				<a class="footer__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/#team"><?php pll_e('Nuestro Equipo') ?></a>
				<a class="footer__menu--item menu_item_JS" href="<?php bloginfo('url') ?>/<?php pll_e('nosotros') ?>"><?php pll_e('Sobre Reform') ?></a>
			</div>

			<?php if ($info = get_field('info','option')): ?>
				<div class="footer__info"><?= $info ?></div>
			<?php endif ?>

		</div>
	</footer>
	
	<?php wp_footer(); ?>

</body>

</html>
