<?php
/*
Template Name: Dienst Duurzaamheidsreis
Template Post Type: service
*/

get_header();

$advantage_data      = get_field('advantage');
$steps_data          = get_field('steps');
$contact_data        = get_field('contact');
$featured_cases_data = get_field('featured_cases');
$faq_data            = get_field('faq');
?>


<?php

get_template_part('templates/txt-advantages');


if (!empty($steps_data)) {
  get_template_part('templates/steps', null, $steps_data);
}

if (!empty($contact_data)) {
  get_template_part('templates/contact', null, $contact_data);
}

if (!empty($featured_cases_data)) {
  get_template_part('templates/featured-cases', null, $featured_cases_data);
}

get_template_part('templates/faq', null, $faq_data);
get_template_part('templates/featured-services', null, $faq_data);




get_footer();
