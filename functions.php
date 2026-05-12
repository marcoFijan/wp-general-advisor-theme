<?php
if (! defined('ABSPATH')) {
	exit;
}

if (! defined('GENERAL_ADVISOR_THEME_VERSION')) {
	define('GENERAL_ADVISOR_THEME_VERSION', '1.0.0');
}

require_once get_template_directory() . '/inc/cpt.php';

/**
 * Enqueue scripts and styles.
 */
function custom_theme_scripts()
{
	$css_path = '/assets/css/main.css';
	$js_path  = '/assets/js/main.js';

	$css_version = file_exists(get_template_directory() . $css_path) ? filemtime(get_template_directory() . $css_path) : GENERAL_ADVISOR_THEME_VERSION;
	$js_version  = file_exists(get_template_directory() . $js_path) ? filemtime(get_template_directory() . $js_path) : GENERAL_ADVISOR_THEME_VERSION;

	wp_enqueue_style('main', get_template_directory_uri() . $css_path, [], $css_version);
	wp_enqueue_script('main', get_template_directory_uri() . $js_path, [], $js_version, true);

	// Addon: Localize script for AJAX calls
	wp_localize_script('main', 'site_vars', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'search_delay' => 700,
		'nonce'    => wp_create_nonce('ajax_nonce'),
	]);

	wp_dequeue_style('wp-block-library');
	wp_dequeue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'custom_theme_scripts');

/**
 * Login page logo (Updated with SVG from Addon)
 */
function custom_login_logo()
{ ?>
	<style type="text/css">
		#login h1 a {
			background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='101' height='30' viewBox='0 0 101 30' fill='none'%3E%3Cg clip-path='url(%23clip0_2531_1779)'%3E%3Cpath d='M87.25 22.8784H101V19.9575H91.3903L100.936 8.69904V5.77809H87.2821V8.69904H96.7635L87.25 19.9575V22.8784Z' fill='%23222C78'/%3E%3Cpath d='M71.4293 14.3141C71.4293 11.1592 73.4995 8.56788 76.8381 8.56788C80.1767 8.56788 82.2469 11.1911 82.2469 14.3141C82.2469 17.4371 80.1767 20.1241 76.8381 20.1241C73.4995 20.1241 71.4293 17.5009 71.4293 14.3141ZM76.4711 23.1797C78.7408 23.1797 81.1103 22.1517 82.1792 20.7231V22.882H85.5178V0H82.1792V8.03616C81.178 6.57568 78.8762 5.48033 76.4711 5.48033C71.6965 5.48033 68.0586 9.19887 68.0586 14.3141C68.0586 19.8582 71.7642 23.1797 76.4711 23.1797Z' fill='%23222C78'/%3E%3Cpath d='M69.099 5.77809H65.2616L60.0879 18.894L54.6791 5.77809H50.9414L58.2173 22.7473L55.6697 28.6565H59.3931L69.099 5.77809Z' fill='%23222C78'/%3E%3Cpath d='M36.0162 14.3141C36.0162 11.1273 38.0864 8.56788 41.3894 8.56788C44.6924 8.56788 46.7626 11.1592 46.7626 14.3141C46.7626 17.469 44.6924 20.0248 41.3894 20.0248C38.0864 20.0248 36.0162 17.469 36.0162 14.3141ZM41.425 26.8451C38.7883 26.8451 36.9854 25.3173 36.3511 23.5236L33.5149 24.9841C34.3843 27.3095 36.9854 30 41.425 30C46.7982 30 50.0371 26.2815 50.0371 21.9319V5.77809H46.6984V8.00426C45.5974 6.54378 43.3277 5.48033 40.9903 5.48033C36.3511 5.48033 32.6455 8.83375 32.6455 14.3141C32.6455 19.4931 36.2834 23.0805 40.9903 23.0805C43.4596 23.0805 45.6616 21.9851 46.6984 20.5884V22.095C46.6984 24.7501 44.696 26.8451 41.425 26.8451Z' fill='%23222C78'/%3E%3Cpath d='M14.4021 0.0663338C22.355 0.0663338 28.8042 6.40951 28.8042 14.2316C28.8042 22.0537 22.355 28.3969 14.4021 28.3969C6.44923 28.3969 0 22.0572 0 14.2316C0 6.40601 6.44923 0.0663338 14.4021 0.0663338Z' fill='%23222C78'/%3E%3Cpath d='M10.2436 15.2783L5.05566 21.7512L12.556 18.1567L14.4017 26.2283L16.2545 18.1567L10.2436 15.2783ZM17.7403 11.6873L19.5932 3.61574L14.4053 10.0886L18.567 15.2783L26.0638 11.6873H17.7439H17.7403Z' fill='white'/%3E%3Cpath d='M23.7516 21.7512L9.21412 3.61574L11.0741 11.6909L2.74707 11.6873L23.7516 21.7512Z' fill='%2387BD25'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='clip0_2531_1779'%3E%3Crect width='101' height='30' fill='white'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E");
			background-size: 202px 60px;
			width: 202px;
			height: 60px;
		}
	</style>
	<?php }
add_action('login_enqueue_scripts', 'custom_login_logo');

/**
 * Custom setup
 */
function custom_theme_setup()
{
	register_nav_menu('primary', 'Primary Menu');
	register_nav_menu('footer', 'Footer Menu');

	add_editor_style('assets/css/editor.css');
	add_theme_support('admin-bar', ['callback' => '__return_false']);

	// Base image sizes
	add_image_size('landscape', 1920, 1080, true);
	add_image_size('landscape-wide', 1440, 680, true);
	add_image_size('square-sm', 500, 500, true);
	add_image_size('landscape-xs', 519, 224, true);
	add_image_size('landscape-sm', 550, 240, true);

	// Addon image sizes
	add_image_size('wide', 1360, 560, true);
	add_image_size('wide-hero', 1360, 471, true);
	add_image_size('wide-lg', 1360, 677, true);
	add_image_size('square', 558, 558, true);
	add_image_size('icon', 52, 52, true);
	add_image_size('portrait', 443, 493, true);
	add_image_size('portrait-sm', 328, 366, true);
	add_image_size('portrait-lg', 443, 563, true);
	add_image_size('portrait-xl', 507, 564, true);
	add_image_size('landscape-slider', 607, 486, true);
	add_image_size('video', 1111, 625, true);
	add_image_size('landscape-xl', 1440, 900, true);
}
add_action('after_setup_theme', 'custom_theme_setup');

/**
 * Menu function
 *
 * @param string $menu_location The theme location identifier.
 * @return array Hierarchical array of menu items.
 */
function get_menu($menu_location)
{
	$locations = get_nav_menu_locations();
	if (empty($locations[$menu_location])) {
		return [];
	}

	$menu = wp_get_nav_menu_object($locations[$menu_location]);
	if (!$menu || is_wp_error($menu)) {
		return [];
	}

	$items = wp_get_nav_menu_items($menu->term_id);
	if (!$items || is_wp_error($items)) {
		return [];
	}

	$current_object_id = get_queried_object_id();
	$current_post_type = get_post_type($current_object_id);

	if (is_tax()) {
		$queried_object = get_queried_object();
		if (!empty($queried_object->taxonomy)) {
			$taxonomy = get_taxonomy($queried_object->taxonomy);
			if (!empty($taxonomy->object_type)) {
				$current_post_type = $taxonomy->object_type[0];
			}
		}
	}

	$archive_url = $current_post_type ? get_post_type_archive_link($current_post_type) : false;

	$menu_array = [];
	$items_dict = [];

	foreach ($items as $item) {
		$is_current = (!is_archive() && (int) $item->object_id === (int) $current_object_id)
			|| ($archive_url && $item->url === $archive_url);

		$classes = array_filter((array) $item->classes);
		if ($is_current) {
			$classes[] = 'current-menu-item';
		}
		$classes_str = implode(' ', array_unique($classes));

		$items_dict[$item->ID] = [
			'ID'        => $item->ID,
			'object_id' => $item->object_id,
			'title'     => $item->title,
			'url'       => $item->url,
			'target'    => !empty($item->target) ? "target={$item->target}" : '',
			'classes'   => $classes_str ? " {$classes_str}" : '',
			'icon'      => function_exists('get_field') ? get_field('icon', $item) : '',
			'children'  => []
		];
	}

	foreach ($items as $item) {
		if (empty($item->menu_item_parent)) {
			$menu_array[$item->ID] = &$items_dict[$item->ID];
		} else {
			if (isset($items_dict[$item->menu_item_parent])) {
				$items_dict[$item->menu_item_parent]['children'][] = &$items_dict[$item->ID];
			}
		}
	}

	return $menu_array;
}

/**
 * Remove function that removes admin bar margin
 */
remove_action('get_header', 'remove_admin_bar_spacing');

/**
 * Remove media upload button
 */
remove_action('media_buttons', 'media_buttons');

/**
 * Text editor customization (Merged with extended formats)
 */
function custom_tinymce_settings($settings)
{
	$settings['body_class'] = 'prose font-sans';
	$block_formats['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

	$style_formats = array(
		array(
			'title' => 'Heading 1 (H1)',
			'items' => array(
				array(
					'title' => 'Grootte',
					'items' => array(
						array('title' => '8XL (82px)', 'selector' => 'h1', 'attributes' => array('class' => 'text-8xl')),
						array('title' => '7XL (68px)', 'selector' => 'h1', 'attributes' => array('class' => 'text-7xl')),
					)
				),
				array(
					'title' => 'Kleur',
					'items' => array(
						array('title' => 'Lichtblauw', 'selector' => 'h1', 'inline' => 'span', 'attributes' => array('class' => 'text-blue-light')),
						array('title' => 'Blauw', 'selector' => 'h1', 'inline' => 'span', 'attributes' => array('class' => 'text-blue')),
					)
				),
			)
		),

		array(
			'title' => 'Heading 2 (H2)',
			'items' => array(
				array(
					'title' => 'Grootte',
					'items' => array(
						array('title' => '6XL', 'selector' => 'h2', 'attributes' => array('class' => 'text-6xl')),
						array('title' => '5XL', 'selector' => 'h2', 'attributes' => array('class' => 'text-5xl')),
					)
				),
				array(
					'title' => 'Kleur',
					'items' => array(
						array('title' => 'Groen', 'selector' => 'h2', 'inline' => 'span', 'attributes' => array('class' => 'text-green')),
						array('title' => 'Lichtblauw', 'selector' => 'h2', 'inline' => 'span', 'attributes' => array('class' => 'text-blue-light')),
					)
				),
				array(
					'title' => 'Kompas',
					'items' => array(
						array('title' => 'Wel kompas voor tekst', 'selector' => 'h2', 'inline' => 'span', 'attributes' => array('class' => 'inline-compass')),
						array('title' => 'Geen kompas voor tekst', 'selector' => 'h2', 'inline' => 'span', 'attributes' => array('class' => '')),
					)
				),
			)
		),

		array(
			'title' => 'Heading 3 (H3)',
			'items' => array(
				array(
					'title' => 'Grootte',
					'items' => array(
						array('title' => '3XL', 'selector' => 'h3', 'attributes' => array('class' => 'text-3xl')),
					)
				),
				array(
					'title' => 'Kleur',
					'items' => array(
						array('title' => 'Groen', 'selector' => 'h3', 'inline' => 'span', 'attributes' => array('class' => 'text-green')),
						array('title' => 'Lichtblauw', 'selector' => 'h3', 'inline' => 'span', 'attributes' => array('class' => 'text-blue-light')),
					)
				),
				array(
					'title' => 'Kompas',
					'items' => array(
						array('title' => 'Wel kompas voor tekst', 'selector' => 'h3', 'inline' => 'span', 'attributes' => array('class' => 'inline-compass')),
						array('title' => 'Geen kompas voor tekst', 'selector' => 'h3', 'inline' => 'span', 'attributes' => array('class' => '')),
					)
				),
			)
		),

		array(
			'title' => 'Heading 4 (H4)',
			'items' => array(
				array(
					'title' => 'Kleur',
					'items' => array(
						array('title' => 'Groen', 'selector' => 'h4', 'inline' => 'span', 'attributes' => array('class' => 'text-green')),
						array('title' => 'Lichtblauw', 'selector' => 'h4', 'inline' => 'span', 'attributes' => array('class' => 'text-blue-light')),
					)
				),
			)
		),

		array(
			'title' => 'Paragraaf (P)',
			'items' => array(
				array(
					'title' => 'Grootte',
					'items' => array(
						array('title' => 'XS (13px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-xs')),
						array('title' => 'SM (14px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-sm')),
						array('title' => 'Basis (16px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-base')),
						array('title' => 'MD (17px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-md')),
						array('title' => 'LG (18px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-lg')),
						array('title' => 'XL (20px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-1.5xl')),
						array('title' => '2XL (22px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-xl')),
						array('title' => '3XL (26px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-lglg:text-3xl')),
						array('title' => '4XL (32px)', 'selector' => 'p', 'inline' => 'span', 'attributes' => array('class' => 'text-2xl lg:text-4xl lg:leading-[3rem]')),
					)
				),
				array(
					'title' => 'Ruimte onder (margin)',
					'items' => array(
						array('title' => 'Geen', 'selector' => 'p', 'attributes' => array('class' => 'mb-0')),
						array('title' => 'Klein', 'selector' => 'p', 'attributes' => array('class' => 'mb-sm')),
						array('title' => 'Normaal', 'selector' => 'p', 'attributes' => array('class' => 'mb-5')),
					)
				),
				array(
					'title' => 'Dikte',
					'items' => array(
						array('title' => 'Normaal', 'selector' => 'p', 'inline' => 'strong', 'attributes' => array('class' => 'font-normal')),
						array('title' => 'Halfvet', 'selector' => 'p', 'inline' => 'strong', 'attributes' => array('class' => 'font-semibold')),
						array('title' => 'Vet', 'selector' => 'p', 'inline' => 'strong', 'attributes' => array('class' => 'font-bold')),
					)
				),
				array(
					'title' => 'Kleur',
					'items' => array(
						array('title' => 'Lichtblauw', 'inline' => 'span', 'attributes' => array('class' => 'text-blue-light')),
						array('title' => 'Blauw', 'inline' => 'span', 'attributes' => array('class' => 'text-blue')),
					)
				),
			)
		),

		array(
			'title' => 'Lijsten',
			'items' => array(
				array(
					'title' => 'Stijl',
					'items' => array(
						array('title' => 'Compass Groen', 'selector' => 'ul, ol', 'attributes' => array('class' => 'compass-green')),
						array('title' => 'Compass Blauw', 'selector' => 'ul, ol', 'attributes' => array('class' => 'compass-blue')),
					)
				),
			)
		),
	);

	$settings['block_formats'] = implode(';', $block_formats);
	$settings['style_formats'] = json_encode($style_formats);
	return $settings;
}
add_filter('tiny_mce_before_init', 'custom_tinymce_settings');

/**
 * Change default page template name
 */
add_filter('default_page_template_title', function () {
	return 'Selecteer een template in de rechter zijbalk';
});

/**
 * ACF JSON Save Point
 */
function theme_acf_json_save_point($path)
{
	return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'theme_acf_json_save_point');

/**
 * ACF JSON Load Point
 */
function theme_acf_json_load_point($paths)
{
	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}
add_filter('acf/settings/load_json', 'theme_acf_json_load_point');

/**
 * Modify ACF/ACFE modules
 */
function custom_remove_acfe_modules()
{
	acf_update_setting('acfe/modules/post_types', false);
	acf_update_setting('acfe/modules/taxonomies', false);
	acf_update_setting('acfe/modules/block_types', false);
	acf_update_setting('acfe/modules/categories', false);
	acf_update_setting('acfe/modules/forms', false);
	acf_update_setting('acfe/modules/options_pages', false);
	acf_update_setting('acfe/modules/performance', true);
}
add_action('acf/init', 'custom_remove_acfe_modules');

add_filter('acf/settings/enable_post_types', '__return_false');

/**
 * Flexible content thumbnails
 */
function custom_acf_layout_thumbnail($thumbnail, $field, $layout)
{
	$image_name = str_replace('_', '-', $layout['name']);
	return get_stylesheet_directory_uri() . '/assets/images/blocks/' . $image_name . '.webp';
}
add_filter('acfe/flexible/thumbnail/name=flexible_content', 'custom_acf_layout_thumbnail', 10, 3);


/**
 * Rank Math Breadcrumbs Logic
 */
add_filter('rank_math/frontend/breadcrumb/items', function ($items, $breadcrumbs) {
	if (
		is_singular(['knowledge', 'news', 'video']) ||
		is_post_type_archive(['knowledge', 'news', 'video']) ||
		is_tax(['news_category', 'video_category', 'knowledge_category'])
	) {
		$actueel_pages = get_pages([
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template-actueel.php'
		]);

		if ($actueel_pages) {
			$actueel_item = [get_the_title($actueel_pages[0]->ID), get_permalink($actueel_pages[0]->ID), false];
			array_splice($items, 1, 0, [$actueel_item]);
		}
	}

	if (is_tax('service_type')) {
		$services_archive_url = get_post_type_archive_link('service');
		$services_item = ['Diensten', $services_archive_url, false];
		$items[1] = $services_item;
	}

	if (is_singular('service')) {
		$terms = get_the_terms(get_the_ID(), 'service_type');
		if ($terms && !is_wp_error($terms)) {
			$term_item = [$terms[0]->name, get_term_link($terms[0]), false];
			array_splice($items, count($items) - 1, 0, [$term_item]);
		}
	}

	if (is_singular('sectors') || is_post_type_archive('sectors')) {
		$services_archive_url = get_post_type_archive_link('service');
		$diensten_item = ['Diensten', $services_archive_url, false];

		array_splice($items, 1, 0, [$diensten_item]);
	}

	return $items;
}, 10, 2);

/**
 * Custom Rank Math separator
 */
add_filter('rank_math/frontend/breadcrumb/settings', function ($settings) {
	$settings = [
		'separator' => '<i class="breadcrumbs-separator"></i>',
	];
	return $settings;
});

/**
 * AJAX Filtering for Cases and News
 */
add_action('wp_ajax_filter_cases', 'filter_cases_ajax_handler');
add_action('wp_ajax_nopriv_filter_cases', 'filter_cases_ajax_handler');
add_action('wp_ajax_filter_news', 'filter_news_ajax_handler');
add_action('wp_ajax_nopriv_filter_news', 'filter_news_ajax_handler');

function filter_cases_ajax_handler()
{
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax_nonce')) {
		wp_send_json_error(['message' => 'Invalid nonce'], 403);
	}

	$sector_slug = isset($_POST['filter_value']) ? sanitize_text_field($_POST['filter_value']) : 'all';

	$args = [
		'post_type'      => 'case',
		'posts_per_page' => 6,
		'paged'          => 1,
		'post_status'    => 'publish',
	];

	if ($sector_slug !== 'all') {
		$sector_post = get_page_by_path($sector_slug, OBJECT, 'sectors');
		if ($sector_post) {
			$args['meta_query'] = [[
				'key'     => 'acf',
				'value'   => '"sector";i:' . $sector_post->ID,
				'compare' => 'LIKE',
			]];
		}
	}

	$query = new WP_Query($args);
	ob_start();

	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
			get_template_part('templates/case-card', null, ['case_id' => get_the_ID()]);
		endwhile;
	else :
		echo '<p class="col-span-full py-10 text-center text-stone-500">Geen cases gevonden voor deze sector.</p>';
	endif;

	$html = ob_get_clean();

	wp_send_json([
		'html'        => $html,
		'total_found' => $query->found_posts,
		'max_pages'   => $query->max_num_pages
	]);
}

function filter_news_ajax_handler()
{
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax_nonce')) {
		wp_send_json_error(['message' => 'Invalid nonce'], 403);
	}

	$tag = isset($_POST['filter_value']) ? sanitize_text_field($_POST['filter_value']) : 'all';

	$args = [
		'post_type'      => 'news',
		'posts_per_page' => 6,
		'paged'          => 1,
		'post_status'    => 'publish',
	];

	if ($tag !== 'all') {
		$args['tax_query'] = [[
			'taxonomy' => 'news_category',
			'field'    => 'slug',
			'terms'    => $tag,
		]];
	}

	$query = new WP_Query($args);
	ob_start();

	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
			get_template_part('components/news-card', null, ['post_id' => get_the_ID()]);
		endwhile;
	else :
		echo '<p class="col-span-full py-10 text-center text-stone-500">Geen nieuwsberichten gevonden.</p>';
	endif;

	$html = ob_get_clean();

	wp_send_json([
		'html'      => $html,
		'max_pages' => $query->max_num_pages,
	]);
}

/**
 * Universal Load More Handler
 */
$load_more_post_types = ['cases', 'news', 'knowledge', 'videos'];
foreach ($load_more_post_types as $type) {
	add_action("wp_ajax_load_more_{$type}", 'universal_load_more_handler');
	add_action("wp_ajax_nopriv_load_more_{$type}", 'universal_load_more_handler');
}

function universal_load_more_handler()
{
	$action      = isset($_POST['action']) ? sanitize_text_field($_POST['action']) : '';
	$post_type   = str_replace('load_more_', '', $action);
	$paged       = isset($_POST['page']) ? intval($_POST['page']) : 2;
	$filter_value = isset($_POST['filter_value']) ? sanitize_text_field($_POST['filter_value']) : 'all';

	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax_nonce')) {
		wp_send_json_error(['message' => 'Invalid nonce'], 403);
	}

	$post_type_map = [
		'cases'     => 'case',
		'news'      => 'news',
		'knowledge' => 'knowledge',
		'videos'    => 'video',
	];

	$post_type_name   = $post_type_map[$post_type] ?? $post_type;
	$posts_per_page   = ($post_type === 'knowledge') ? 5 : (($post_type === 'videos') ? 3 : 6);
	$args = [
		'post_type'      => $post_type_name,
		'post_status'    => 'publish',
		'posts_per_page' => $posts_per_page,
		'paged'          => $paged,
	];

	if ($post_type === 'videos') {
		unset($args['paged']);
		$args['offset'] = 1 + (($paged - 1) * $posts_per_page);
	}

	if ($post_type === 'cases' && $filter_value !== 'all') {
		$sector_post = get_page_by_path($filter_value, OBJECT, 'sectors');
		if ($sector_post) {
			$args['meta_query'] = [[
				'key'     => 'acf',
				'value'   => '"sector";i:' . $sector_post->ID,
				'compare' => 'LIKE',
			]];
		}
	}

	if ($post_type === 'news' && $filter_value !== 'all') {
		$args['tax_query'] = [[
			'taxonomy' => 'news_category',
			'field'    => 'slug',
			'terms'    => $filter_value,
		]];
	}

	$query = new WP_Query($args);

	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
			echo '<div class="animate-fade-in">';

			if ($post_type === 'cases') {
				get_template_part('templates/case-card', null, ['case_id' => get_the_ID()]);
			} elseif ($post_type === 'news') {
				get_template_part('components/news-card', null, ['post_id' => get_the_ID()]);
			} elseif ($post_type === 'knowledge') {
				$dutch_date = mb_strtoupper(get_the_date('j M Y'));
	?>
				<a href="<?php the_permalink(); ?>" class="group/btn grid grid-cols-2 lg:grid-cols-6 gap-y-4 lg:gap-x-4 items-center py-6 px-4 -mx-4 border-b border-blue/10 transition-all duration-300 hover:bg-white rounded-xl focus:outline-none animate-fade-in">
					<div class="col-span-2 lg:col-span-4">
						<h3 class="text-1.5xl text-blue font-heading mr-10"><?php the_title(); ?></h3>
					</div>
					<div class="col-span-1 lg:col-span-1">
						<span class="text-xs font-semibold text-blue/40 uppercase"><?= $dutch_date; ?></span>
					</div>
					<div class="col-span-1 lg:col-span-1 flex justify-end">
						<?php get_template_part('components/button', null, ['type' => 'only-icon', 'color' => 'green', 'rotation' => '0deg']); ?>
					</div>
				</a>
<?php
			} elseif ($post_type === 'videos') {
				get_template_part('components/video-card', null, ['post_id' => get_the_ID(), 'is_featured' => false]);
			}
			echo '</div>';
		endwhile;
	endif;

	wp_reset_postdata();
	die();
}

/**
 * Searchpage & Relevanssi Setup
 */
add_filter('search_template', function ($template) {
	if (is_search()) {
		return locate_template('template-search.php');
	}
	return $template;
});

add_shortcode('custom_search_form', function () {
	ob_start();
	get_template_part('templates/search');
	return ob_get_clean();
});

add_filter('relevanssi_do_not_index', function ($block, $post_id) {
	$template = get_page_template_slug($post_id);

	if ($template === 'template-search.php') {
		return true;
	}

	return $block;
}, 10, 2);

add_filter('relevanssi_excerpt_content', function ($content, $post, $query) {
	if (empty($content)) {
		$fields = get_fields($post->ID);
		if ($fields) {
			foreach ($fields as $field) {
				if (is_string($field)) {
					$content .= " " . $field;
				}
			}
		}
	}
	return $content;
}, 10, 3);

/**
 * Hide default posts / Admin cleanup
 */
add_action('admin_menu', function () {
	remove_menu_page('edit.php');
});

add_action('wp_before_admin_bar_render', function () {
	global $wp_admin_bar;
	$wp_admin_bar->remove_node('new-post');
});

add_action('wp_dashboard_setup', function () {
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}, 999);
