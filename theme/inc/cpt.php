<?php
function register_cpt()
{
	// ==========================================
	// DIENSTEN (Services)
	// ==========================================
	register_post_type('inspiration', [
		'labels' => [
			'name'           => 'Inspiratie',
			'singular_name'  => 'Detailpagina',
			'add_new'        => 'Nieuwe Detailpagina',
			'add_new_item'   => 'Nieuwe Detailpagina',
		],
		'public'      => true,
		'show_ui'     => true,
		'menu_icon'   => 'dashicons-lightbulb',
		'supports'    => ['title', 'editor', 'author', 'thumbnail', 'revisions'],
		'taxonomies'  => ['inspiration_category'],
		'has_archive' => true,
		'rewrite'     => ['with_front' => false, 'slug' => 'inspiratie'],
		'delete_with_user' => false,

		'acfe_archive_ppp'     => 12,
		'acfe_archive_orderby' => 'date',
		'acfe_archive_order'   => 'DESC',

		'acfe_admin_archive' => true,
		'acfe_admin_ppp'     => 999,
	]);

	register_taxonomy('inspiration_category', ['inspiration'], [
		'labels' => [
			'name'              => 'Categorieën',
			'singular_name'     => 'Categorie',
			'add_new_item'      => 'Nieuwe Categorie',
		],
		'public'           => true,
		'show_ui'          => true,
		'show_admin_column' => true,
		'meta_box_cb'      => false,
		'rewrite' => [
			'slug'       => 'inspiratie',
			'with_front' => false,
		],

		'acfe_admin_terms' => true,
	]);

	// ==========================================
	// CASES (Cases)
	// ==========================================
	register_post_type('case', [
		'labels' => [
			'name'          => 'Cases',
			'singular_name' => 'Case',
			'add_new'       => 'Nieuwe Case toevoegen'
		],
		'public'           => true,
		'show_ui'          => true,
		'menu_icon'        => 'dashicons-portfolio',
		'supports'         => ['title', 'author', 'thumbnail', 'revisions'],
		'has_archive'      => true,
		'rewrite'          => ['with_front' => false, 'slug' => 'cases'],
		'delete_with_user' => false,
		'acfe_admin_archive' => true,
		'acfe_archive_ppp' => 6,
	]);

	// ==========================================
	// KENNIS (Knowledge)
	// ==========================================
	register_post_type('knowledge', [
		'labels' => ['name' => 'Kennis', 'singular_name' => 'Kennis', 'add_new' => 'Nieuw Kennisartikel toevoegen'],
		'public' => true,
		'show_ui' => true,
		'menu_icon' => 'dashicons-welcome-learn-more',
		'supports' => ['title', 'author', 'thumbnail', 'revisions', 'excerpt'],
		'taxonomies' => ['knowledge_category'],
		'has_archive' => true,
		'rewrite' => ['with_front' => false, 'slug' => 'kennis'],
		'delete_with_user' => false,
		'acfe_admin_archive' => true,
		'acfe_archive_ppp' => 5,

	]);

	// ==========================================
	// NIEUWS (News)
	// ==========================================
	register_post_type('news', [
		'labels' => ['name' => 'Nieuws', 'singular_name' => 'Nieuwsbericht', 'add_new' => 'Nieuw Bericht toevoegen'],
		'public' => true,
		'show_ui' => true,
		'menu_icon' => 'dashicons-megaphone',
		'supports' => ['title', 'author', 'thumbnail', 'revisions', 'excerpt'],
		'taxonomies' => ['news_category'],
		'has_archive' => true,
		'rewrite' => ['with_front' => false, 'slug' => 'nieuws'],
		'delete_with_user' => false,
		'acfe_admin_archive' => true,
		'acfe_archive_ppp' => 6,
	]);

	register_taxonomy('news_category', ['news'], [
		'labels' => [
			'name'          => 'Nieuws Tags',
			'singular_name' => 'Nieuws Tag',
			'add_new_item'  => 'Nieuwe Tag toevoegen'
		],
		'public'             => true,
		'hierarchical'       => false,
		'show_ui'            => true,
		'show_admin_column'  => true,
		'show_in_nav_menus'  => false,
		'show_tagcloud'      => false,
		'publicly_queryable' => false,
		'rewrite'            => false,
		'query_var'          => false,
	]);

	// ==========================================
	// VIDEO'S (Video)
	// ==========================================
	register_post_type('video', [
		'labels' => ['name' => 'Video\'s', 'singular_name' => 'Video', 'add_new' => 'Nieuwe Video toevoegen'],
		'public' => true,
		'show_ui' => true,
		'menu_icon' => 'dashicons-video-alt3',
		'supports' => ['title', 'author', 'thumbnail', 'revisions'],
		'taxonomies' => ['video_category'],
		'has_archive' => true,
		'rewrite' => ['with_front' => false, 'slug' => 'videos'],
		'delete_with_user' => false,
		'acfe_admin_archive' => true,
		'acfe_archive_ppp' => 4,

	]);

	// ==========================================
	// VACATURES (Vacancy)
	// ==========================================
	register_post_type('vacancy', [
		'labels' => ['name' => 'Vacatures', 'singular_name' => 'Vacature', 'add_new' => 'Nieuwe Vacature toevoegen'],
		'public' => true,
		'show_ui' => true,
		'menu_icon' => 'dashicons-groups',
		'supports' => ['title', 'author', 'thumbnail', 'revisions', 'excerpt'],
		'has_archive' => true,
		'rewrite' => ['with_front' => false, 'slug' => 'vacatures'],
		'delete_with_user' => false,
		'acfe_admin_archive' => true,
		'acfe_archive_ppp' => 6,

	]);

	// ==========================================
	// MEDEWERKERS (Employees)
	// ==========================================
	register_post_type('medewerker', [
		'labels' => ['name' => 'Medewerkers', 'singular_name' => 'Medewerker', 'add_new' => 'Nieuwe Medewerker toevoegen'],
		'public' => false,
		'show_ui' => true,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-businessman',
		'supports' => ['title', 'thumbnail', 'revisions'],
		'has_archive' => false,
		'rewrite' => false,
	]);

	// ==========================================
	// FAQ
	// ==========================================
	register_post_type('faq', [
		'labels' => [
			'name'               => 'FAQs',
			'singular_name'      => 'FAQ',
			'add_new'            => 'Nieuwe FAQ toevoegen',
			'edit_item'          => 'FAQ bewerken',
			'all_items'          => 'Alle FAQs',
		],
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_rest'        => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'rewrite'             => false,
		'query_var'           => false,
		'menu_icon'           => 'dashicons-editor-help',
		'supports'            => ['title', 'editor', 'revisions'],
	]);
}

// ==========================================
// SECTORS 
// ==========================================
register_post_type('sectors', [
	'labels' => [
		'name'               => 'Sectoren',
		'singular_name'      => 'Sector',
		'add_new'            => 'Nieuwe sector toevoegen',
		'edit_item'          => 'Sector bewerken',
		'all_items'          => 'Alle Sectoren',
	],
	'public'              => true,
	'show_ui'             => true,
	'publicly_queryable'  => true,
	'exclude_from_search' => false,
	'show_in_nav_menus'   => true,
	'menu_icon'           => 'dashicons-category',
	'supports'            => ['title', 'editor', 'revisions', 'thumbnail', 'excerpt'],
	'has_archive'         => true,
	'rewrite'             => ['slug' => 'diensten/sectoren'],
	'acfe_admin_archive' => true,
	'show_in_rest'       => true,
]);

// ==========================================
// TESTIMONIALS 
// ==========================================
register_post_type('testimonial', [
	'labels' => [
		'name'               => 'Testimonials',
		'singular_name'      => 'Testimonial',
		'add_new'            => 'Nieuwe Testimonial toevoegen',
		'edit_item'          => 'Testimonial bewerken',
		'all_items'          => 'Alle Testimonials',
	],
	'public'              => false,
	'show_ui'             => true,
	'publicly_queryable'  => false,
	'exclude_from_search' => true,
	'show_in_nav_menus'   => false,
	'menu_icon'           => 'dashicons-format-quote',
	'supports'            => ['title', 'editor', 'revisions'],
	'taxonomies'          => ['klant'],
	'has_archive'         => false,
	'rewrite'             => false,
]);

register_taxonomy('klant', ['testimonial'], [
	'labels' => [
		'name'          => 'Klanten',
		'singular_name' => 'Klant',
		'add_new_item'  => 'Nieuwe Klant toevoegen'
	],
	'public'             => false,
	'hierarchical'       => false,
	'show_ui'            => true,
	'show_admin_column'  => true,
	'show_in_nav_menus'  => false,
	'show_tagcloud'      => false,
	'publicly_queryable' => false,
	'rewrite'            => false,
]);

add_action('init', 'register_cpt');
