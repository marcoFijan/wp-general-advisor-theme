<?php
$archive_id = 'news_archive';

if (is_page_template('template-actueel.php')) {
  $archive_id = get_queried_object_id();
}

$custom_title   = get_field('hero_title', $archive_id);
$featured_array = get_field('featured_newsarticle', $archive_id);
$featured_id    = $featured_array ? $featured_array[0] : null;

if (!$custom_title) {
  if (is_page_template('template-actueel.php')) {
    $custom_title = '<h1 class="">' . get_the_title($archive_id) . '</h1>';
  } else {
    $custom_title = '<h1 class="">' . post_type_archive_title('', false) . '</h1>';
  }
}
?>

<section class="px-4 pt-23 breadcrumb-dark-no-bg bg-linear-to-b from-transparent to-beige">
  <div class="container grid gap-4 grid-cols-12">
    <div class="col-span-12 lg:col-span-10 lg:col-start-2 mb-9 border-b border-stone-medium/30 pb-6">
      <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
      <div class="prose mt-5">
        <?= $custom_title; ?>
      </div>
    </div>

    <?php if ($featured_id) :
      $post_terms    = get_the_terms($featured_id, 'news_category');
      $display_tag   = ($post_terms && !is_wp_error($post_terms)) ? $post_terms[0]->name : 'Nieuws';
      $dutch_date    = mb_strtoupper(get_the_date('j M Y', $featured_id));
      $thumbnail_url = get_the_post_thumbnail_url($featured_id, 'large');
      $excerpt       = get_the_excerpt($featured_id);
      $permalink     = get_permalink($featured_id);
    ?>
      <a href="<?= esc_url($permalink); ?>" class="col-span-12 lg:col-span-10 lg:col-start-2 grid grid-cols-12 lg:grid-cols-10 gap-4 group bg-white rounded-card hover:ring-blue ring ring-transparent duration-300 transition-all group/btn">
        <div class="col-span-12 lg:col-span-5 relative aspect-4/3 lg:aspect-auto 2xl:aspect-4/3 rounded-2xl overflow-hidden bg-blue/5 shrink-0 my-xs ml-xs">
          <?php if ($thumbnail_url) : ?>
            <img src="<?= esc_url($thumbnail_url); ?>" alt="<?= esc_attr(get_the_title($featured_id)); ?>" class="w-full h-full object-cover">
          <?php endif; ?>
        </div>
        <article class="col-span-12 lg:col-span-4 lg:col-start-7 flex flex-col  justify-center px-5 sm:px-10 lg:px-0 my-7 lg:-translate-x-10">
          <div class="w-full mb-6 flex items-center justify-between">
            <span class="bg-blue/5 text-blue py-2 px-3 flex gap-2 items-center rounded-lg text-1.2xs font-bold">
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

            <span class="text-xs font-semibold text-blue/30 uppercase">
              <?= $dutch_date; ?>
            </span>
          </div>

          <h2 class="text-3xl lg:text-4xl text-blue font-heading mb-4">
            <?= get_the_title($featured_id); ?>
          </h2>

          <div class="text-black text-sm mr-10 font-medium mb-8 line-clamp-4">
            <?= $excerpt; ?>
          </div>

          <div class="mt-auto flex justify-between items-center w-full">
            <span class="text-blue font-bold text-sm">Lees artikel</span>
            <?php
            get_template_part('components/button', null, [
              'type' => 'only-icon',
              'color' => 'blue',
              'rotation' => '0deg'
            ]);
            ?>
          </div>
        </article>
      </a>
    <?php endif; ?>
  </div>

</section>