<?php

/**
 * Template part for the Zoeken Page content
 */
?>

<section class="pt-section lg:pb-section-lg -mt-24">
  <div class="container grid grid-cols-12">
    <div class="col-span-12 lg:col-span-8 lg:col-start-3">

      <?php if (have_posts() && get_search_query()) : ?>
        <div class="prose prose-white text-center mb-12">
          <h2><?php printf(_n('%d resultaat gevonden', '%d resultaten gevonden', $wp_query->found_posts), $wp_query->found_posts); ?></h2>
        </div>

        <div class="grid gap-6">
          <?php while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="group/btn ring-2 ring-transparent hover:ring-green w-full flex flex-col bg-white rounded-card h-full transition-all duration-300 overflow-hidden">
              <div class="p-5 flex flex-col grow">

                <div class="flex flex-wrap gap-2 mb-6">
                  <span class="bg-blue/5 text-blue py-1.5 px-3 rounded-lg text-2xs font-bold uppercase tracking-wider flex items-center">
                    <?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?>
                  </span>
                </div>

                <h3 class="text-2xl lg:text-3xl text-blue font-heading mb-4">
                  <?php the_title(); ?>
                </h3>

                <div class="text-black/70 leading-relaxed line-clamp-2 mb-6">
                  <?php the_excerpt(); ?>
                </div>

                <div class="mt-auto flex justify-between items-center">
                  <span class="text-blue font-bold text-sm">Lees meer</span>
                  <?php
                  get_template_part('components/button', null, [
                    'type'     => 'only-icon',
                    'color'    => 'blue',
                    'rotation' => '0deg'
                  ]);
                  ?>
                </div>

              </div>
            </a>
          <?php endwhile; ?>
        </div>

        <div class="mt-12">
          <?php the_posts_pagination(); ?>
        </div>

      <?php elseif (get_search_query()) : ?>
        <div class="text-center py-12">
          <p class="text-xl text-black/60">Helaas, geen resultaten gevonden voor "<strong><?php echo get_search_query(); ?></strong>".</p>
          <p class="mt-2">Probeer een andere zoekterm of kijk bij onze diensten.</p>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>