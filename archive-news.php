<?php get_header(); ?>

<?php
global $wp_query;

$archive_id  = 'option';
$max_pages   = $wp_query->max_num_pages;
?>

<section class="py-section lg:py-section-lg bg-beige">
  <div class="container mx-auto px-4 grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-10 lg:col-start-2">

      <div class="flex flex-col md:flex-row md:items-end justify-end mb-10 gap-4 border-b pb-10 border-blue/10">
        <div id="news-filters" class="flex flex-wrap gap-1">
          <?php
          $terms = get_terms(['taxonomy' => 'news_category', 'hide_empty' => true]);
          $filters = ['Alles' => 'all'];
          if ($terms) foreach ($terms as $term) $filters[$term->name] = $term->slug;

          foreach ($filters as $label => $slug):
            $is_active = ($slug === 'all');
            $active_class = $is_active ? 'bg-blue text-white' : 'bg-white text-blue border-blue/10 hover:bg-blue hover:text-white';
          ?>
            <button
              data-slug="<?= esc_attr($slug); ?>"
              class="news-filter-btn px-3 py-1 rounded-lg border font-bold text-xs transition-all <?= $active_class; ?>">
              <?= esc_html($label); ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <div data-results="news-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('components/news-card'); ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <div id="news-load-more-container" class="flex justify-center mt-16 <?= ($max_pages <= 1) ? 'hidden' : ''; ?>">
        <?php $current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';

        get_template_part('components/button', null, [
          'color'      => 'white-outline',
          'text'       => 'Laad meer nieuws',
          'icon'       => 'custom',
          'rotation'   => '0deg',
          'customIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M6.75391 0V13.5078" stroke="currentColor" stroke-width="1.5"/><path d="M13.5078 6.75391L6.10352e-05 6.75391" stroke="currentColor" stroke-width="1.5"/></svg>',
          'data' => [
            'logic'        => 'load-more',
            'action'       => 'load_more_news',
            'target'       => 'news-grid',
            'page'         => 1,
            'max'          => $max_pages,
            'filter-value' => $current_category
          ]
        ]);
        ?>
      </div>

    </div>
  </div>
</section>

<?php
get_template_part('templates/flexible-content', null, ['post_id' => 'post_type_archive_news']);
?>

<?php get_footer(); ?>