<?php
$queried_object = get_queried_object();

$is_service_type = ($queried_object instanceof WP_Term && $queried_object->taxonomy === 'service_type');
$is_sector       = (is_singular('sectors'));

if (!$is_service_type && !$is_sector) {
  return;
}

$services_args = [
  'post_type'      => 'service',
  'post_status'    => 'publish',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order title',
  'order'          => 'ASC',
];

if ($is_service_type) {
  $term_id = $queried_object->term_id;
  $intro_text = get_field('sub_services_intro', $queried_object);
  $services_args['tax_query'] = [
    [
      'taxonomy' => 'service_type',
      'field'    => 'term_id',
      'terms'    => $term_id,
    ],
  ];
} elseif ($is_sector) {
  $sector_id = get_queried_object_id();
  $intro_text = get_field('sector_intro', $sector_id);

  // Fetch all services, then filter by related_sector field
  $all_services = get_posts([
    'post_type'      => 'service',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
  ]);

  $filtered_ids = [];
  foreach ($all_services as $service) {
    $related = get_field('related_sector', $service->ID);
    if ((int) $related === (int) $sector_id) {
      $filtered_ids[] = $service->ID;
    }
  }

  if (!empty($filtered_ids)) {
    $services_args['post__in'] = $filtered_ids;
  } else {
    // No matches — force empty result
    $services_args['post__in'] = [0];
  }
}
$services_query = new WP_Query($services_args);

if (!$intro_text && !$services_query->have_posts()) {
  return;
}
?>

<section class="my-section lg:my-section-lg container grid grid-cols-12 gap-4">
  <div class="col-span-12 md:col-span-10 md:col-start-2 lg:col-span-6 lg:col-start-4 grid grid-cols-12 md:grid-cols-10 lg:grid-cols-6 gap-4">
    <?php if ($intro_text): ?>
      <article class="prose col-span-12 md:col-span-10 lg:col-span-6 border-b border-blue-light mb-6 pb-4">
        <?php echo $intro_text; ?>
      </article>
    <?php endif; ?>

    <?php if ($services_query->have_posts()): ?>
      <?php while ($services_query->have_posts()): $services_query->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="text-black hover:bg-blue transition-colors duration-300 hover:text-white col-span-12 md:col-span-5 lg:col-span-3 w-full flex justify-between items-center bg-blue-lighter p-xs pl-5 rounded-usp-xs">
          <span class="block text-sm font-semibold ">
            <?php the_title(); ?>
          </span>
          <span class="bg-white rounded-usp-xs p-2 w-7 aspect-square text-black">
            <?php
            $path = get_theme_file_path('/assets/media/compass-small.svg');
            if (file_exists($path)) {
              $svg = file_get_contents($path);
              echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
            }
            ?>
          </span>
        </a>
      <?php endwhile;
      wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</section>