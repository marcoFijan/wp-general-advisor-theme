<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
  <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    $case_id   = get_the_ID();
    $location  = get_field('location');
    $year      = get_field('year');
    $duration  = get_field('duration');
    $services  = get_field('services');
    $thumbnail = get_post_thumbnail_id();
    $sector_id   = get_field('sector', $case_id);
    $sector_name = $sector_id ? get_the_title($sector_id) : '';
    $sector_url  = $sector_id ? get_permalink($sector_id) : '';
    ?>

    <div class="project-info-section mt-10 lg:mt-14">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-12 gap-y-12 lg:gap-y-0 items-center">

          <div class="col-span-12 md:col-span-10 md:col-start-2 lg:col-span-4 lg:col-start-2">
            <span class="block text-1.5xl font-semibold mb-5 text-blue tracking-tight">Projectdetails</span>
            <div class="project-details-list">

              <?php if ($sector_name): ?>
                <div class="py-details flex items-start justify-between border-b border-stone-medium text-black">
                  <span class="text-base font-medium">Sector</span>
                  <span class="text-base font-semibold text-right">
                    <?php if ($sector_url) : ?>
                      <a href="<?= esc_url($sector_url); ?>" class="hover:text-blue transition-colors">
                        <?= esc_html($sector_name); ?>
                      </a>
                    <?php else : ?>
                      <?= esc_html($sector_name); ?>
                    <?php endif; ?>
                  </span>
                </div>
              <?php endif; ?>

              <?php if ($location): ?>
                <div class="py-details flex items-start justify-between border-b border-stone-medium text-black">
                  <span class="text-base font-medium">Locatie</span>
                  <span class="text-base font-semibold text-right"><?= esc_html($location); ?></span>
                </div>
              <?php endif; ?>

              <?php if ($year): ?>
                <div class="py-details flex items-start justify-between border-b border-stone-medium text-black">
                  <span class="text-base font-medium">Jaartal</span>
                  <span class="text-base font-semibold text-right"><?= esc_html($year); ?></span>
                </div>
              <?php endif; ?>

              <?php if ($duration): ?>
                <div class="py-details flex items-start justify-between border-b border-stone-medium text-black">
                  <span class="text-base font-medium">Doorlooptijd</span>
                  <span class="text-base font-semibold text-right"><?= esc_html($duration); ?></span>
                </div>
              <?php endif; ?>

              <?php if ($services): ?>
                <div class="py-details flex items-start justify-between text-black border-b border-stone-medium">
                  <span class="text-base font-medium block mb-4">Diensten</span>
                  <ul class="gap-y-3 flex flex-col items-end">
                    <?php foreach ($services as $service): ?>
                      <li class="flex items-center gap-1.5">
                        <span class="w-1.25 h-1.25 rounded-full bg-green shrink-0"></span>
                        <a href="<?= get_permalink($service->ID); ?>" class="text-base font-semibold hover:text-blue hover:underline transition-colors">
                          <?= get_the_title($service->ID); ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

            </div>
          </div>

          <div class="col-span-12 lg:col-span-5 lg:col-start-7">
            <?php if ($thumbnail) : ?>
              <div class="rounded-card overflow-hidden shadow-sm">
                <?= wp_get_attachment_image($thumbnail, 'square', false, [
                  'class' => 'w-full h-auto object-cover block'
                ]); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; ?>

<?php get_template_part('templates/flexible-content');
$featured = get_field('featured_cases_group');
if ($featured) :
  get_template_part('templates/featured-cases', null, $featured);
endif;

get_footer(); ?>