<?php

/**
 * Template Name: Actueel Pagina
 * Beschrijving: Compleet overzicht met uitgelicht nieuws, kennisbank en recente video's.
 */
get_header();

$archive_id     = 'post_type_archive_news';
$custom_title   = get_field('hero_title', $archive_id) ?: '<h1 class="text-4xl md:text-6xl text-blue font-heading">Actueel</h1>';
$featured_array = get_field('featured_newsarticle', $archive_id);
$featured_id    = $featured_array ? $featured_array[0] : null;

$posts_per_page = 6;
?>


<?php
$news_query = new WP_Query([
  'post_type'      => 'news',
  'posts_per_page' => $posts_per_page,
  'paged'          => 1,
  'post__not_in'   => $featured_id ? [$featured_id] : []
]);
?>
<section class="bg-beige py-12 lg:py-24">
  <div class="container mx-auto px-4 grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-10 lg:col-start-2">
      <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4 border-b pb-4 border-blue/10">
        <div class="prose flex items-start">
          <h2 class="mb-0">Nieuws</h2>
          <div class="text-blue text-lg px-2 py-1 font-heading">
            <?= $news_query->found_posts; ?>
          </div>
        </div>

        <div class="flex flex-wrap gap-1">
          <?php
          $news_archive_url = get_post_type_archive_link('news');
          $current_filter = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';
          $news_terms = get_terms(['taxonomy' => 'news_category', 'hide_empty' => true]);
          $news_filters = ['Alles' => 'all'];

          if ($news_terms && !is_wp_error($news_terms)) {
            foreach ($news_terms as $term) {
              $news_filters[$term->name] = $term->slug;
            }
          }

          foreach ($news_filters as $label => $slug):
            $is_active = ($slug === $current_filter);

            $active_class = $is_active
              ? 'bg-blue text-white'
              : 'bg-white text-blue border-blue/10 hover:bg-blue hover:text-white';

            $url = ($slug === 'all') ? $news_archive_url : add_query_arg('category', $slug, $news_archive_url);
          ?>
            <a href="<?= esc_url($url); ?>"
              class="px-3 py-1 rounded-lg border font-bold text-xs transition-all <?= $active_class; ?>"
              data-slug="<?= esc_attr($slug); ?>">
              <?= esc_html($label); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <div data-results="news-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if ($news_query->have_posts()) : ?>
          <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
            <?php get_template_part('components/news-card', null, ['post_id' => get_the_ID()]); ?>
          <?php endwhile;
          wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>

      <?php if ($news_query->max_num_pages > 1): ?>
        <div class="flex justify-center mt-16">
          <?php
          get_template_part('components/button', null, [
            'color'      => 'ghost-dark',
            'text'       => 'Meer nieuws',
            'icon'       => 'custom',
            'rotation'   => '0deg',
            'customIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 14 14" fill="none"><path d="M6.75391 0V13.5078" stroke="currentColor" stroke-width="1.5"/><path d="M13.5078 6.75391L6.10352e-05 6.75391" stroke="currentColor" stroke-width="1.5"/></svg>',
            'data' => [
              'logic'        => 'load-more',
              'action'       => 'load_more_news',
              'target'       => 'news-grid',
              'page'         => 1,
              'max'          => $news_query->max_num_pages,
              'filter-value' => 'all'
            ]
          ]);
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
$knowledge_query = new WP_Query([
  'post_type'      => 'knowledge',
  'post_status'    => 'publish',
  'posts_per_page' => 5,
  'paged'          => 1,
]);
?>
<section id="knowledge" class="bg-beige py-12 lg:py-24">
  <div class="container mx-auto px-4 grid grid-cols-12 gap-4">
    <div class="col-span-12 md:col-span-10 md:col-start-2 lg:col-span-6 lg:col-start-4">
      <div class="border-b pb-5 border-blue/10 flex items-center justify-center">
        <div class="prose flex items-start">
          <h2 class="mb-0">Kennisartikelen</h2>
          <div class="text-blue text-lg px-2 py-1 mb-4 font-heading">
            <?= $knowledge_query->found_posts; ?>
          </div>
        </div>
      </div>

      <div data-results="knowledge-list" class="flex flex-col">
        <?php if ($knowledge_query->have_posts()) : ?>
          <?php while ($knowledge_query->have_posts()) : $knowledge_query->the_post();
            $dutch_date = mb_strtoupper(get_the_date('j M Y'));
          ?>

            <a href="<?php the_permalink(); ?>" class="group/btn grid grid-cols-2 lg:grid-cols-6 gap-y-4 lg:gap-x-4 items-center py-6 px-4 -mx-4 border-b border-blue/10 transition-all duration-300 hover:bg-white rounded-xl focus:outline-none">

              <div class="col-span-2 lg:col-span-4">
                <h3 class="text-1.5xl text-blue font-heading mr-10 transition-colors">
                  <?php the_title(); ?>
                </h3>
              </div>

              <div class="col-span-1 lg:col-span-1">
                <span class="text-xs font-semibold text-blue/40 uppercase">
                  <?= $dutch_date; ?>
                </span>
              </div>

              <div class="col-span-1 lg:col-span-1 flex justify-end">
                <?php
                get_template_part('components/button', null, [
                  'type'       => 'only-icon',
                  'color'      => 'green',
                  'rotation'   => '0deg'
                ]);
                ?>
              </div>

            </a>

          <?php endwhile;
          wp_reset_postdata(); ?>
        <?php else : ?>
          <p class="text-blue/70 px-4">Er zijn momenteel geen kennisartikelen beschikbaar.</p>
        <?php endif; ?>
      </div>

      <?php if ($knowledge_query->max_num_pages > 1): ?>
        <div class="flex justify-center mt-12">
          <?php
          get_template_part('components/button', null, [
            'color'      => 'ghost-dark',
            'text'       => 'Meer artikelen',
            'icon'       => 'custom',
            'rotation'   => '0deg',
            'customIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 14 14" fill="none"><path d="M6.75391 0V13.5078" stroke="currentColor" stroke-width="1.5"/><path d="M13.5078 6.75391L6.10352e-05 6.75391" stroke="currentColor" stroke-width="1.5"/></svg>',
            'data' => [
              'logic'        => 'load-more',
              'action'       => 'load_more_knowledge',
              'target'       => 'knowledge-list',
              'page'         => 1,
              'max'          => $knowledge_query->max_num_pages,
              'filter-value' => 'all'
            ]
          ]);
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
$video_query = new WP_Query([
  'post_type'      => 'video',
  'posts_per_page' => 4,
  'paged'          => 1,
]);

$total_videos = $video_query->found_posts;
$max_pages = ceil(($total_videos - 1) / 3);
?>
<section id="videos" class="bg-beige py-12 lg:py-24">
  <div class="container mx-auto px-4 grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-10 lg:col-start-2">
      <div class="mb-10 border-b pb-4 border-blue/10">
        <div class="prose flex items-start">
          <h2 class="mb-0">Video's</h2>
        </div>
      </div>

      <div data-results="video-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if ($video_query->have_posts()) : ?>
          <?php while ($video_query->have_posts()) : $video_query->the_post();
            $is_featured = ($video_query->current_post === 0);
            $wrapper_classes = $is_featured ? 'md:col-span-2 lg:col-span-3' : 'col-span-1';
          ?>
            <div class="<?= $wrapper_classes; ?>">
              <?php get_template_part('components/video-card', null, [
                'post_id'     => get_the_ID(),
                'is_featured' => $is_featured
              ]); ?>
            </div>
          <?php endwhile;
          wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>

      <?php if ($max_pages > 1): ?>
        <div class="flex justify-center mt-16">
          <?php
          get_template_part('components/button', null, [
            'color'      => 'ghost-dark',
            'text'       => 'Meer video\'s',
            'icon'       => 'custom',
            'rotation'   => '0deg',
            'customIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 14 14" fill="none"><path d="M6.75391 0V13.5078" stroke="currentColor" stroke-width="1.5"/><path d="M13.5078 6.75391L6.10352e-05 6.75391" stroke="currentColor" stroke-width="1.5"/></svg>',
            'data' => [
              'logic'        => 'load-more',
              'action'       => 'load_more_videos',
              'target'       => 'video-grid',
              'page'         => 1,
              'max'          => $max_pages,
              'filter-value' => 'all'
            ]
          ]);
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>