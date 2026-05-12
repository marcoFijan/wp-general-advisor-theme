<?php get_header(); ?>

<?php
global $wp_query;

$total_found = $wp_query->found_posts;
$max_pages   = $wp_query->max_num_pages;

$all_sectors = get_posts([
  'post_type'      => 'sectors',
  'posts_per_page' => -1,
  'orderby'        => 'title',
  'order'          => 'ASC',
  'post_status'    => 'publish'
]);
?>

<section class="my-section lg:my-18">
  <div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-5 gap-4 border-b pb-4 border-stone-medium/50">
      <div class="flex items-center">
        <h2 class="text-4xl md:text-6xl text-blue font-heading">Cases</h2>
        <div id="case-count" class="text-blue text-lg px-2 py-1 rounded-md mb-4 font-heading"><?= $total_found; ?></div>
      </div>

      <div id="sector-filters" class="flex flex-wrap gap-1">
        <button data-slug="all" class="filter-btn px-3 py-1 rounded-lg border font-bold text-3xs uppercase transition-all bg-blue text-white">
          Alles
        </button>

        <?php if ($all_sectors) : foreach ($all_sectors as $sector) : ?>
            <button
              data-slug="<?= $sector->post_name; ?>"
              class="filter-btn px-3 py-1 rounded-lg border font-bold text-3xs uppercase transition-all bg-blue-light/50 text-blue border-transparent hover:bg-blue hover:text-white">
              <?= esc_html($sector->post_title); ?>
            </button>
        <?php endforeach;
        endif; ?>
      </div>
    </div>

    <div id="case-results" data-results="case-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('templates/case-card', null, ['case_id' => get_the_ID()]); ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

    <div id="load-more-container" class="flex justify-center mt-12 <?= ($max_pages <= 1) ? 'hidden' : ''; ?>">
      <?php
      get_template_part('components/button', null, [
        'id'    => 'load-more-btn',
        'color' => 'white-outline',
        'text'  => 'Laad meer cases',
        'icon'  => 'custom',
        'data'  => [
          'logic'        => 'load-more',
          'target'       => 'case-grid',
          'action'       => 'load_more_cases',
          'page'         => 1,
          'max'          => $max_pages,
          'filter-value' => 'all',
        ]
      ]);
      ?>
    </div>
  </div>
</section>

<?php get_template_part('templates/flexible-content'); ?>


<?php get_footer(); ?>