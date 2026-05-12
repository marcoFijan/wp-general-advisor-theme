<?php
$main_txt = get_sub_field('txt');
$open_vac = get_sub_field('open_vacancy');
$args = [
  'post_type'      => 'vacancy',
  'posts_per_page' => -1,
  'post_status'    => 'publish'
];
$vacancy_query = new WP_Query($args);

$total_vacancies = $vacancy_query->found_posts;
$md_classes = [
  0 => 'md:col-span-12',
  1 => 'md:col-span-6',
];

$xl_classes = [
  0 => 'xl:col-span-12',
  1 => 'xl:col-span-8',
  2 => 'xl:col-span-4',
];

$md_span_class = $md_classes[$total_vacancies % 2];
$xl_span_class = $xl_classes[$total_vacancies % 3];

$loc_icon  = file_get_contents(get_theme_file_path('/assets/media/location.svg'));
$time_icon = file_get_contents(get_theme_file_path('/assets/media/time.svg'));
?>

<section class="vacancy-list-section py-section lg:py-section-lg bg-beige">
  <div class="container mx-auto px-4 grid grid-cols-12 gap-4">

    <?php if ($main_txt): ?>
      <div class="col-span-12 lg:col-span-10 lg:col-start-2 mb-8 prose">
        <?= $main_txt; ?>
      </div>
    <?php endif; ?>

    <div class="col-span-12 lg:col-span-10 lg:col-start-2 grid grid-cols-12 gap-4">

      <?php if ($vacancy_query->have_posts()): ?>
        <?php while ($vacancy_query->have_posts()): $vacancy_query->the_post(); ?>

          <div class="col-span-12 md:col-span-6 xl:col-span-4 flex">
            <?php
            get_template_part('components/vacancy-card', null, [
              'post_id'     => get_the_ID(),
              'is_featured' => false
            ]);
            ?>
          </div>

        <?php endwhile;
        wp_reset_postdata(); ?>
      <?php endif; ?>


      <?php if ($open_vac):
        $title    = $open_vac['title'] ?? '';
        $txt      = $open_vac['txt'] ?? '';
        $loc      = $open_vac['location'] ?? '';
        $contract = $open_vac['contract_hours'] ?? '';
        $link_txt = $open_vac['link_txt'] ?? 'Open sollicitatie';

        $archive_link = get_post_type_archive_link('vacancy') . '#form';
      ?>

        <a href="<?= esc_url($archive_link); ?>" class="group/btn col-span-12 <?= $md_span_class; ?> <?= $xl_span_class; ?> bg-blue text-white rounded-card p-5 flex flex-col h-full ring-2 ring-offset-2 ring-transparent hover:ring-green transition-all duration-300">
          <div class="flex flex-col max-w-100">
            <?php if ($title): ?>
              <h2 class="text-3xl lg:text-4xl text-white font-heading mb-5">
                <?= $title; ?>
              </h2>
            <?php endif; ?>

            <?php if ($txt): ?>
              <p class="text-white font-medium text-md mb-5">
                <?= $txt; ?>
              </p>
            <?php endif; ?>
          </div>

          <div class="flex flex-wrap gap-2 mb-6">
            <?php if ($loc): ?>
              <span class="bg-white/10 text-white py-1.5 px-3 rounded-lg text-2xs font-bold uppercase tracking-wider flex items-center gap-2">
                <span class="w-3.5 h-3.5 flex items-center justify-center fill-current"><?= $loc_icon; ?></span>
                <?= esc_html($loc); ?>
              </span>
            <?php endif; ?>

            <?php if ($contract): ?>
              <span class="bg-white/10 text-white py-1.5 px-3 rounded-lg text-2xs font-bold uppercase tracking-wider flex items-center gap-1">
                <span class="w-3.5 h-3.5 flex items-center justify-center fill-current"><?= $time_icon; ?></span>
                <?= esc_html($contract); ?>
              </span>
            <?php endif; ?>
          </div>

          <div class="mt-auto flex justify-between items-center w-full">
            <span class="text-white font-bold text-sm">
              <?= esc_html($link_txt); ?>
            </span>
            <?php
            get_template_part('components/button', null, [
              'type'  => 'only-icon',
              'color' => 'white',
              'iconColor' => 'text-green',
              'rotation' => '0deg'
            ]);
            ?>
          </div>
        </a>
      <?php endif; ?>

    </div>
  </div>
</section>