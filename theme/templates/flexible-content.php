<?php

$queried_object = '';

if (is_post_type_archive('service')) {
	$queried_object = 'service_archive';
} elseif (is_post_type_archive('case')) {
	$queried_object = 'case_archive';
} elseif (is_post_type_archive('vacancy')) {
	$queried_object = 'vacancy_archive';
} elseif (is_post_type_archive('sectors')) {
	$queried_object = 'sectors_archive';
} elseif (is_tax('service_type')) {
	$term = get_queried_object();
	$queried_object = 'term_' . $term->term_id;
} elseif (is_singular('service') || is_singular('case')) {
	$queried_object = get_the_ID();
} else {
	$queried_object = get_queried_object();
}

if (have_rows('flexible_content', $queried_object)) :
	while (have_rows('flexible_content', $queried_object)) : the_row();

		if (get_row_layout() == 'txt_img') :
			get_template_part('templates/txt-img');

		elseif (get_row_layout() == 'txt_txt') :
			get_template_part('templates/txt-txt');

		elseif (get_row_layout() == 'txt') :
			get_template_part('templates/txt');

		elseif (get_row_layout() == 'cards') :
			get_template_part('templates/cards');

		elseif (get_row_layout() == 'testimonial_tabs') :
			get_template_part('templates/testimonial-tabs');

		elseif (get_row_layout() == 'testimonial') :
			get_template_part('templates/testimonial');

		elseif (get_row_layout() == 'usps') :
			get_template_part('templates/usps');

		elseif (get_row_layout() == 'contact') :
			get_template_part('templates/contact');

		elseif (get_row_layout() == 'featured_cases') :
			get_template_part('templates/featured-cases');

		elseif (get_row_layout() == 'faq') :
			get_template_part('templates/faq');

		elseif (get_row_layout() == 'logo_slider') :
			get_template_part('templates/logo-slider');

		elseif (get_row_layout() == 'txt_features') :
			get_template_part('templates/txt-features');

		elseif (get_row_layout() == 'video') :
			get_template_part('templates/video');

		elseif (get_row_layout() == 'form') :
			get_template_part('templates/form');

		elseif (get_row_layout() == 'txt_txt_slider') :
			get_template_part('templates/txt-txt-slider');

		elseif (get_row_layout() == 'vacancies') :
			get_template_part('templates/vacancies');

		elseif (get_row_layout() == 'txt_customers') :
			get_template_part('templates/txt-customers');

		elseif (get_row_layout() == 'employees') :
			get_template_part('templates/employees');

		elseif (get_row_layout() == 'img_cases') :
			get_template_part('templates/img-cases');

		elseif (get_row_layout() == 'txt_txt_services') :
			get_template_part('templates/txt-txt-services');

		elseif (get_row_layout() == 'txt_btn') :
			get_template_part('templates/txt-btn');

		elseif (get_row_layout() == 'img') :
			get_template_part('templates/img');

		elseif (get_row_layout() == 'testimonials_slider') :
			get_template_part('templates/testimonials-slider');

		elseif (get_row_layout() == 'sectors') :
			get_template_part('templates/sectors');

		elseif (get_row_layout() == 'img_scrollable_txt') :
			get_template_part('templates/img-scrollable-txt');

		endif;
	endwhile;
endif;
