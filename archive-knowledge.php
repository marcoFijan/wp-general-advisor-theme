<?php get_header(); ?>

<?php
global $wp_query;
$total_found = $wp_query->found_posts;
$max_pages   = $wp_query->max_num_pages;
?>

<section id="knowledge" class="bg-beige py-12 lg:py-24">
  <div class="container mx-auto px-4 grid grid-cols-12 gap-4">
    <div class="col-span-12 md:col-span-10 md:col-start-2 lg:col-span-6 lg:col-start-4">

      <div class="border-b pb-5 border-blue/10 flex items-center justify-center">
        <div class="prose flex items-start">
          <h2 class="mb-0">Artikelen</h2>
          <div class="text-blue text-lg px-2 py-1 mb-4 font-heading">
            <?= $total_found; ?>
          </div>
        </div>
      </div>

      <div data-results="knowledge-list" class="flex flex-col">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post();
            $dutch_date = mb_strtoupper(get_the_date('j M Y'));
          ?>
            <a href="<?php the_permalink(); ?>" class="group/btn grid grid-cols-2 lg:grid-cols-6 gap-y-4 lg:gap-x-4 items-center py-6 px-4 -mx-4 border-b border-blue/10 transition-all duration-300 hover:bg-white hover:rounded-xl focus:outline-none">
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
          <?php endwhile; ?>
        <?php else : ?>
          <p class="text-blue/70 px-4">Er zijn momenteel geen kennisartikelen beschikbaar.</p>
        <?php endif; ?>
      </div>

      <?php if ($max_pages > 1): ?>
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