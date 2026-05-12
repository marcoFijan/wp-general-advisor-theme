<?php

/**
 * News Card Component
 */
$post_id     = $args['post_id'] ?? get_the_ID();
$post_terms  = get_the_terms($post_id, 'news_category');
$display_tag = ($post_terms && !is_wp_error($post_terms)) ? $post_terms[0]->name : 'Nieuws';
$dutch_date  = mb_strtoupper(get_the_date('j M Y', $post_id));
?>

<a href="<?php echo get_permalink($post_id); ?>" class="group/btn relative flex flex-col bg-white p-5 rounded-card h-full hover:ring-blue ring ring-transparent duration-300 transition-all">
  <div class="w-full mb-7 flex items-center justify-between">
    <span class="bg-blue/5 text-blue py-2 px-3 flex gap-2 items-center rounded-lg text-sm font-bold">
      <span class="w-4 h-4 -rotate-35 shrink-0">
        <svg fill="currentColor" class="w-full h-full" viewBox="0 0 21 8" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_2588_1301)">
            <path d="M19.27 3.97L1.72998 0L6.79998 3.97L1.85998 7.95L19.27 3.97Z" fill="currentColor"></path>
          </g>
          <defs>
            <clipPath id="clip0_2588_1301">
              <rect width="17.54" height="7.95" fill="currentColor" transform="translate(1.72998)"></rect>
            </clipPath>
          </defs>
        </svg>
      </span>
      <?= esc_html($display_tag); ?>
    </span>

    <span class="text-xs font-semibold text-blue/30 uppercase text-right">
      <?= $dutch_date; ?>
    </span>
  </div>

  <h3 class="text-2xl text-blue font-heading mb-16">
    <?php echo get_the_title($post_id); ?>
  </h3>

  <div class="mt-auto flex justify-between items-center">
    <span class="text-blue font-bold text-sm">Ontdek het artikel</span>
    <?php
    get_template_part('components/button', null, [
      'type' => 'only-icon',
      'color' => 'blue',
      'rotation' => '0deg'
    ]);
    ?>
  </div>
</a>