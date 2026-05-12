<?php get_header(); ?>

<?php
global $wp_query;

$total_videos = $wp_query->found_posts;
$max_pages    = ceil(($total_videos - 1) / 3);
?>

<section id="videos" class="bg-beige pb-12 lg:pb-24">
  <div class="container mx-auto px-4 grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-10 lg:col-start-2">

      <div data-results="video-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post();
            $is_featured = ($wp_query->current_post === 0);
            $wrapper_classes = $is_featured ? 'md:col-span-2 lg:col-span-3' : 'col-span-1';
          ?>
            <div class="<?= $wrapper_classes; ?>">
              <?php get_template_part('components/video-card', null, [
                'post_id'     => get_the_ID(),
                'is_featured' => $is_featured
              ]); ?>
            </div>
          <?php endwhile; ?>
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