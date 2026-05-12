<?php
get_header(); ?>

<?php
if (have_rows('services_overview', 'service_archive')):
  while (have_rows('services_overview', 'service_archive')): the_row();
    if (have_rows('services')): ?>
      <section class="services-overview-section py-section lg:py-section-lg bg-linear-to-b from-transparent to-beige">
        <div class="container mx-auto px-4 flex flex-col gap-12">
          <?php while (have_rows('services')): the_row();
            $icon_id     = get_sub_field('icon');
            $term_id     = get_sub_field('service');
            $img_id      = get_sub_field('img');
            $overlay_txt = get_sub_field('txt');
            $term_desc   = get_sub_field('term_desc');

            $term = get_term($term_id, 'service_type');
            $term_link = !is_wp_error($term) && $term ? get_term_link($term) : '#';

            $term_posts = [];
            if (!is_wp_error($term) && $term) {
              $term_posts = get_posts([
                'post_type'      => 'service',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order title',
                'order'          => 'ASC',
                'tax_query'      => [
                  [
                    'taxonomy' => 'service_type',
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                  ],
                ],
              ]);
            }
          ?>
            <div class="bg-white rounded-card grid grid-cols-12 gap-0 overflow-hidden">
              <div class="col-span-12 lg:col-span-6 flex flex-col justify-between py-14 px-6 md:px-12">
                <div>
                  <?php if ($icon_id): ?>
                    <div class="w-24.5 aspect-square mb-8">
                      <?= wp_get_attachment_image($icon_id, 'thumbnail', false, ['class' => 'w-full h-full object-contain']); ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="flex flex-col">
                  <?php if (!is_wp_error($term) && $term): ?>
                    <a href="<?= esc_url($term_link); ?>" class="flex group/btn justify-between items-center text-2xl md:text-3xl font-semibold text-blue hover:text-blue-hover transition-colors duration-300 mb-2.5">
                      <?= esc_html($term->name); ?>
                      <?php
                      get_template_part('components/button', null, array(
                        'color'    => 'blue',
                        'type'     => 'only-icon',
                        'rotation' => '0deg'
                      ));
                      ?>
                    </a>
                  <?php endif; ?>
                  <?php if ($term_desc): ?>
                    <div class="text-black prose text-sm max-w-none mb-8 line-clamp-4">
                      <?= $term_desc; ?>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($term_posts)): ?>
                    <div class="border-t border-blue-light pt-6">
                      <div class="flex flex-wrap gap-2">
                        <?php foreach ($term_posts as $post_item): ?>
                          <a href="<?= esc_url(get_permalink($post_item->ID)); ?>" class="inline-block cursor-pointer select-none rounded-lg font-bold uppercase text-3xs py-2 px-3 bg-white border border-blue/10 text-blue transition-colors duration-300 hover:bg-blue/10 has-checked:bg-blue has-checked:text-white">
                            <?= esc_html(get_the_title($post_item->ID)); ?>
                          </a>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-span-12 lg:col-span-6 my-md mr-md relative flex flex-col overflow-hidden">
                <?php if ($img_id): ?>
                  <div class="w-full h-full min-h-75 lg:min-h-0 lg:aspect-67/45 overflow-hidden rounded-usp-md flex">
                    <?= wp_get_attachment_image($img_id, 'landscape', false, ['class' => 'w-full h-full object-cover']); ?>
                  </div>
                <?php endif; ?>
                <?php if ($overlay_txt): ?>
                  <div class="absolute bottom-0 right-0 z-10 m-4 lg:m-6 bg-white/90 rounded-usp-xs p-4 md:p-6 backdrop-blur-sm max-w-[80%]">
                    <div class="prose max-w-none text-black prose-p:text-xs prose-p:md:text-sm prose-li:text-xs prose-li:md:text-sm prose-li:pl-6 prose-li:before:w-3 prose-li:before:bg-size-[80%] prose-li:before:h-3">
                      <?= $overlay_txt; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </section>
<?php endif;
  endwhile;
endif; ?>

<?php get_template_part('templates/flexible-content'); ?>
<?php get_footer(); ?>