<?php /* Template name: Legal */ get_header(); ?>

<section class="container grid grid-cols-12 gap-6 mb-20">
	<article class="prose col-span-12 lg:col-span-10 lg:col-start-2">
		<?= get_field('txt') ?>
	</article>
</section>

<?php get_footer(); ?>