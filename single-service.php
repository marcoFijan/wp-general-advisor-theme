<?php get_header();

$advantages = get_field('txt_advantages_group');
if ($advantages) :
  get_template_part('templates/txt-advantages', null, $advantages);
endif;

get_template_part('templates/flexible-content');

$faq = get_field('faq_group');
if ($faq) :
  get_template_part('templates/faq', null, $faq);
endif;
$similar_services = get_field('similar_services_group');
if ($similar_services) : ?>
<?php get_template_part('templates/featured-services', null, $similar_services);
endif;

get_footer();
