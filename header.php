<!DOCTYPE HTML>
<html class="scroll-smooth scroll-mt-40" <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>

	<ul class="sr-only">
		<li><a href="#nav" class="sr-only focus:not-sr-only"><?php _e('Naar navigatie', 'mf'); ?></a></li>
		<li><a href="#content" class="sr-only focus:not-sr-only"><?php _e('Naar hoofdinhoud', 'mf'); ?></a></li>
		<li><a href="#footer" class="sr-only focus:not-sr-only"><?php _e('Naar footer', 'mf'); ?></a></li>
	</ul>

	<header>

		<?php
		get_template_part('components/nav');

		if (is_front_page()) {
			get_template_part('templates/hero', 'home');
		} else {
			if (is_tax('service_type') || is_singular('sectors')) {
				$term = get_queried_object();
				get_template_part('templates/hero', 'service', ['term' => $term]);
			} elseif (is_singular('service')) {
				get_template_part('templates/hero', 'subservice');
			} elseif (is_search()) {
				get_template_part('templates/hero', 'search');
			} elseif (is_singular('news')) {
				get_template_part('templates/hero', 'news');
			} elseif (is_post_type_archive('knowledge')) {
				get_template_part('templates/hero', 'knowledge-archive');
			} elseif (is_singular('vacancy')) {
				get_template_part('templates/hero', 'vacancy');
			} elseif (is_page_template('template-actueel.php') || is_post_type_archive('news')) {
				get_template_part('templates/hero', 'news-archive');
			} elseif (is_page_template('template-contact.php')) {
				get_template_part('templates/hero', 'contact');
			} elseif (is_page_template('template-search.php')) {
				get_template_part('templates/hero', 'search');
			} elseif (is_page_template('template-about.php')) {
				get_template_part('templates/hero', 'about');
			} elseif (is_singular('case')) {
				get_template_part('templates/hero', 'case');
			} elseif (is_404()) {
				get_template_part('templates/hero', '404');
			} else {
				get_template_part('templates/hero');
			}
		}
		?>

	</header>

	<main id="content-start" class="scroll-mt-28">