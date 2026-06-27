<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "<?php bloginfo('name') ?>",
  "url": "<?php bloginfo('url') ?>",
  "logo": "<?php bloginfo('template_url'); ?>/img/favicon/mstile-150x150.png",
  "sameAs": [
    <?php $i=1; $redes_count=count($redes); foreach ($redes as $red) : ?>
    "<?= $red['link'] ?>"<?= $i<$redes_count ? ',' : '' ?>

    <?php $i++; endforeach; ?>
  ]
}
</script>



