<?php
$is_vacancy_archive = is_post_type_archive('vacancy');
$is_service_archive = is_post_type_archive('service');
$is_case_archive    = is_post_type_archive('case');
$is_video_archive    = is_post_type_archive('video');
$is_knowledge_archive    = is_post_type_archive('knowledge');
$is_sector_archive  = is_post_type_archive('sectors');
$is_werken_bij      = is_page_template('template-werken-bij.php');

if ($is_vacancy_archive) {
  $queried_object = 'vacancy_archive';
} elseif ($is_case_archive) {
  $queried_object = 'case_archive';
} elseif ($is_service_archive) {
  $queried_object = 'service_archive';
} elseif ($is_sector_archive) {
  $queried_object = 'sectors_archive';
} elseif ($is_knowledge_archive) {
  $queried_object = 'knowledge_archive';
} elseif ($is_video_archive) {
  $queried_object = 'video_archive';
} else {
  $queried_object = get_queried_object();
}

$custom_title = get_field('hero_title', $queried_object);
$intro_text   = get_field('hero_txt', $queried_object);

if ($is_vacancy_archive) {
  $section_classes = 'bg-linear-to-b from-blue to-blue-dark text-white pb-16';
} elseif ($is_knowledge_archive || $is_video_archive) {
  $section_classes = 'bg-linear-to-b from-white to-beige breadcrumb-dark';
} else {
  $section_classes = 'breadcrumb-dark-no-bg';
}
$prose_classes   = $is_vacancy_archive ? 'prose prose-white' : 'prose';
$border_classes  = $is_vacancy_archive ? 'border-white/20' : 'border-stone-medium/30';
$btn_color       = $is_vacancy_archive ? 'white' : 'blue';

$loc_icon    = file_get_contents(get_theme_file_path('/assets/media/location.svg'));
$salary_icon = file_get_contents(get_theme_file_path('/assets/media/salary.svg'));
$time_icon   = file_get_contents(get_theme_file_path('/assets/media/time.svg'));

if ($custom_title) {
  $display_title = $custom_title;
} elseif (is_post_type_archive()) {
  $display_title = '<h1>' . post_type_archive_title('', false) . '</h1>';
} else {
  $display_title = '<h1>' . get_the_title() . '</h1>';
}
?>
<section class="<?= $section_classes; ?> pt-23 <?= $is_werken_bij ? 'pb-0' : 'pb-12' ?> overflow-hidden">
  <div class="container grid grid-cols-12 gap-4 ">
    <div class="col-span-12 <?= ($is_service_archive || $is_case_archive || $is_werken_bij) ? 'lg:col-span-12' : 'lg:col-start-2 lg:col-span-10'; ?>"> <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
      <div class="grid grid-cols-12 lg:grid-cols-7 mb-6 border-b <?= $border_classes; ?> w-full">
        <div class="col-span-12 lg:col-span-10 <?= $prose_classes; ?> mt-5 mb-13">
          <?= $display_title; ?>
        </div>
      </div>

      <div class="grid grid-cols-12 lg:grid-cols-10 gap-4 mt-6">
        <article class="col-span-11 lg:col-span-6 <?= $prose_classes; ?>">
          <?php if ($intro_text): ?>
            <?= $intro_text; ?>
          <?php endif; ?>

          <?php
          if ($is_werken_bij):
          ?>
            <div class="mt-8 flex">
              <?php
              get_template_part('components/button', null, [
                'link'  => get_post_type_archive_link('vacancy'),
                'text'  => 'Alle vacatures',
                'color' => 'blue',
                'iconColor' => 'text-green'
              ]);
              ?>
            </div>
          <?php endif; ?>
        </article>

        <?php if (! $is_knowledge_archive && ! $is_video_archive) : ?>
          <div class="col-span-1 col-start-12 lg:col-start-11 flex items-start justify-end">
            <?php
            get_template_part('components/button', null, [
              'link'     => $is_werken_bij ? '#vacancy-list' : '#content-start',
              'color'    => 'blue',
              'type'     => 'only-icon',
              'rotation' => '90deg'
            ]);
            ?>
          </div>
        <?php endif; ?>

        <?php if ($is_vacancy_archive): ?>
          <div id="vacancy-list" class="col-span-12 lg:col-span-10 grid grid-cols-12 gap-4 mt-16">
            <?php
            $args = [
              'post_type'      => 'vacancy',
              'posts_per_page' => -1,
            ];
            $vacancy_query = new WP_Query($args);

            if ($vacancy_query->have_posts()):
              $count = 0;
              while ($vacancy_query->have_posts()): $vacancy_query->the_post();
                $is_featured = ($count === 0);
            ?>
                <div class="col-span-12 <?= $is_featured ? '' : 'md:col-span-6 lg:col-span-4'; ?>">
                  <?php
                  get_template_part('components/vacancy-card', null, [
                    'post_id'     => get_the_ID(),
                    'is_featured' => $is_featured
                  ]);
                  ?>
                </div>

            <?php
                $count++;
              endwhile;
              wp_reset_postdata();
            endif;
            ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>