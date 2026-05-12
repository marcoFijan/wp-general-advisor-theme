<?php
$queried_object = get_queried_object();
$current_context = ($queried_object instanceof WP_Term) ? $queried_object : get_queried_object_id();
$text               = $args['faq_txt'] ?? (get_sub_field('faq_txt') ?: get_field('faq_txt', $current_context));
$faq_selection_type = $args['faq_selection_type'] ?? (get_sub_field('faq_selection_type') ?: get_field('faq_selection_type', $current_context));
$faq_custom         = $args['faq_custom'] ?? (get_sub_field('faq_custom') ?: get_field('faq_custom', $current_context));
$faq_service        = $args['faq_service'] ?? (get_sub_field('faq_service') ?: get_field('faq_service', $current_context));

$faq_ids = [];
$filter_services = [];

$get_normalized_ids = function ($acf_value) {
  if (empty($acf_value)) return [];
  $ids = [];
  foreach ((array) $acf_value as $item) {
    if (is_numeric($item)) {
      $ids[] = (int) $item;
    } elseif (is_object($item) && isset($item->ID)) {
      $ids[] = (int) $item->ID;
    } elseif (is_array($item) && isset($item['ID'])) {
      $ids[] = (int) $item['ID'];
    }
  }
  return $ids;
};

if ($faq_selection_type === 'custom' && !empty($faq_custom)) {
  $faq_ids = $get_normalized_ids($faq_custom);

  foreach ($faq_ids as $faq_id) {
    $services = $get_normalized_ids(get_field('services', $faq_id));
    foreach ($services as $service_id) {
      if (!isset($filter_services[$service_id])) {
        $filter_services[$service_id] = get_the_title($service_id);
      }
    }
  }
} elseif ($faq_selection_type === 'service_current') {
  $current_service_ids = [];
  $queried_object = get_queried_object();

  if ($queried_object instanceof WP_Term && $queried_object->taxonomy === 'service_type') {
    $term_id = $queried_object->term_id;

    $term_services = get_posts([
      'post_type'      => 'service',
      'post_status'    => 'publish',
      'posts_per_page' => -1,
      'fields'         => 'ids',
      'tax_query'      => [
        [
          'taxonomy' => 'service_type',
          'field'    => 'term_id',
          'terms'    => $term_id,
        ],
      ],
    ]);

    $current_service_ids = $term_services;
  } else {
    $current_id = isset($post->ID) ? (int) $post->ID : get_queried_object_id();
    if ($current_id) {
      $current_service_ids[] = $current_id;
    }
  }

  if (!empty($current_service_ids)) {
    $all_faqs = get_posts([
      'post_type'      => 'faq',
      'post_status'    => 'publish',
      'posts_per_page' => -1,
      'fields'         => 'ids',
    ]);

    foreach ($all_faqs as $faq_id) {
      $faq_service_ids = $get_normalized_ids(get_field('services', $faq_id));

      if (!empty($faq_service_ids)) {
        $matched = array_intersect($current_service_ids, $faq_service_ids);

        if (!empty($matched)) {
          $faq_ids[] = $faq_id;

          foreach ($matched as $service_id) {
            if (!isset($filter_services[$service_id])) {
              $filter_services[$service_id] = get_the_title($service_id);
            }
          }
        }
      }
    }
  }
} elseif ($faq_selection_type === 'service' && !empty($faq_service)) {
  $service_ids = $get_normalized_ids($faq_service);

  $all_faqs = get_posts([
    'post_type'      => 'faq',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'fields'         => 'ids',
  ]);

  foreach ($all_faqs as $faq_id) {
    $faq_service_ids = $get_normalized_ids(get_field('services', $faq_id));

    if (!empty($faq_service_ids)) {
      $matched = array_intersect($service_ids, $faq_service_ids);
      if (!empty($matched)) {
        $faq_ids[] = $faq_id;

        foreach ($matched as $service_id) {
          if (!isset($filter_services[$service_id])) {
            $filter_services[$service_id] = get_the_title($service_id);
          }
        }
      }
    }
  }
}

$faq_ids = array_unique($faq_ids); ?>

<?PHP

if (!$text && empty($faq_ids)) return; ?>

<section class="faq-section bg-blue-lighter py-section lg:py-section-lg" data-faq-container>
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-0">
      <div class="lg:col-span-3 lg:col-start-2">
        <?php if ($text): ?>
          <div class="prose max-w-none">
            <?php echo $text; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($filter_services) && count($filter_services) > 1): ?>
          <div class="mt-12 flex flex-wrap gap-1">
            <label class="cursor-pointer select-none rounded-lg font-bold uppercase text-3xs py-1 px-3 bg-white text-blue transition-colors duration-300 hover:bg-blue/10 has-checked:bg-blue has-checked:text-white">
              <input type="checkbox" value="all" data-faq-filter="all" class="hidden" checked>
              Alles
            </label>
            <?php foreach ($filter_services as $service_id => $service_title): ?>
              <label class="cursor-pointer select-none rounded-lg font-bold uppercase text-3xs py-1 px-3 bg-white text-blue transition-colors duration-300 hover:bg-blue/10 has-checked:bg-blue has-checked:text-white">
                <input type="checkbox" value="<?php echo esc_attr($service_id); ?>" data-faq-filter="specific" class="hidden">
                <?php echo esc_html($service_title); ?>
              </label>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="lg:col-span-6 lg:col-start-6">
        <?php if (!empty($faq_ids)): ?>
          <div class="faq-list flex flex-col">
            <?php
            $index = 0;
            foreach ($faq_ids as $faq_id):
              $question = get_the_title($faq_id);
              $answer   = apply_filters('the_content', get_post_field('post_content', $faq_id));

              if (!$question && !$answer) continue;
              $faq_uid = 'faq-content-' . $faq_id . '-' . $index;
              $is_expanded = ($index === 0) ? 'true' : 'false';

              $faq_services = $get_normalized_ids(get_field('services', $faq_id));
              $services_attr = !empty($faq_services) ? implode(',', $faq_services) : '';
            ?>

              <div
                class="faq-item border-b border-stone-medium transition-colors duration-300 has-aria-expanded:border-transparent has-[+div_[aria-expanded=true]]:border-transparent"
                data-faq-item
                data-faq-services="<?php echo esc_attr($services_attr); ?>">
                <button type="button" class="aria-expanded peer group flex w-full cursor-pointer items-center justify-between gap-1.5 text-left font-medium transition-all duration-300 px-5 py-7 aria-expanded:bg-white aria-expanded:rounded-t-card" aria-expanded="<?php echo $is_expanded; ?>" aria-controls="<?php echo esc_attr($faq_uid); ?>">
                  <h3 class="font-normal text-blue text-1.5xl"><?php echo esc_html($question); ?></h3>
                  <span class="shrink-0 rounded-usp-md bg-white text-blue p-1.5 transition-all duration-300 group-hover:bg-blue group-hover:text-white group-aria-expanded:bg-blue group-aria-expanded:text-white sm:p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 shrink-0 transition-all duration-300 group-aria-expanded:-rotate-45" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                  </span>
                </button>
                <div id="<?php echo esc_attr($faq_uid); ?>" class="grid grid-rows-[0fr] opacity-0 transition-all duration-300 ease-in-out peer-aria-expanded:grid-rows-[1fr] peer-aria-expanded:opacity-100 peer-aria-expanded:bg-white peer-aria-expanded:rounded-b-card">
                  <div class="overflow-hidden">
                    <div class="px-5 pb-7 leading-relaxed text-black text-sm">
                      <?php echo $answer; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php
              $index++;
            endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>