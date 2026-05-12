<?php
$img              = get_sub_field('img');
$title_left       = get_sub_field('title_left');
$scrollable_title = get_sub_field('scrollable_title') ?: [];
$txt              = get_sub_field('txt');
$show_all_cases   = get_sub_field('show_all_cases');
$selected_cases   = get_sub_field('cases');
$txt_bottom       = get_sub_field('txt_bottom');

$final_cases = [];
if ($show_all_cases) {
  $final_cases = get_posts(['post_type' => 'case', 'posts_per_page' => -1]);
} else {
  if ($selected_cases) {
    $final_cases = is_array($selected_cases) ? $selected_cases : [$selected_cases];
  }
}

$count = count($final_cases);
$scroll_word_count = count($scrollable_title);
?>

<div class="relative w-full bg-white">
  <?php if ($img || $title_left || $scrollable_title) : ?>
    <div class="absolute top-0 left-0 w-full h-[60vh] min-h-100 lg:h-200 z-0 pointer-events-none overflow-hidden">
      <?php if ($img) : ?>
        <div class="absolute inset-0 bg-black/20 z-10"></div>
        <?= wp_get_attachment_image($img, 'landscape-xl', false, ['class' => 'w-full h-full object-cover z-0']); ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="relative z-10 flex flex-col w-full min-h-[60vh] lg:min-h-200">
    <div class="grow flex flex-wrap justify-center items-center text-white text-5xl lg:text-8xl xl:text-9xl font-normal font-heading leading-tight gap-x-3 py-16 min-h-62.5 lg:min-h-100">
      <?php if ($title_left) : ?>
        <span><?= esc_html($title_left); ?> </span>
      <?php endif; ?>

      <?php if ($scroll_word_count > 0) : ?>
        <span data-scroll-container class="inline-grid overflow-hidden h-[1.2em] align-bottom justify-items-start text-left">
          <?php foreach ($scrollable_title as $index => $row) : ?>
            <span data-scroll-word class="col-start-1 row-start-1 whitespace-nowrap transition-all duration-500 ease-in-out <?= $index === 0 ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0' ?>">
              &nbsp;<?= esc_html($row['title']); ?>&nbsp;
            </span>
          <?php endforeach; ?>
        </span>
      <?php endif; ?>
    </div>

    <div class="container relative z-20 bg-white rounded-t-card pt-8 shrink-0">
      <div class="grid grid-cols-12 gap-4 px-8 lg:px-12">
        <?php if ($txt) : ?>
          <article class="prose max-w-4xl col-span-12 lg:col-span-6">
            <?= wp_kses_post($txt); ?>
          </article>
        <?php endif; ?>

        <?php if ($count > 0) : ?>
          <div class="flex flex-col md:flex-row md:flex-wrap justify-end md:items-end gap-6 col-span-12 lg:col-span-6">
            <?php if ($count >= 3) : ?>
              <div class="flex gap-2">
                <?php get_template_part('components/button', null, [
                  'type'         => 'only-icon',
                  'color'        => 'blue',
                  'icon'         => 'default',
                  'rotation'     => '180deg',
                  'iconColor'    => 'text-white',
                  'extraClasses' => 'swiper-prev',
                ]); ?>

                <?php get_template_part('components/button', null, [
                  'type'         => 'only-icon',
                  'color'        => 'blue',
                  'icon'         => 'default',
                  'rotation'     => '0deg',
                  'iconColor'    => 'text-white',
                  'extraClasses' => 'swiper-next',
                ]); ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php if ($count > 0) : ?>
    <div class="relative overflow-hidden z-20 bg-white py-16 lg:py-20">
      <div class="container">
        <?php if ($count < 3) : ?>
          <div class="grid grid-cols-12 gap-4">
            <?php foreach ($final_cases as $case) :
              $case_id = is_object($case) ? $case->ID : $case; ?>
              <div class="col-span-12 md:col-span-6 lg:col-span-4">
                <?php get_template_part('templates/case-card', null, ['case_id' => $case_id]); ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else : ?>
          <div data-swiper="featured-cases" class="swiper overflow-visible lg:-translate-x-[calc(16.666%+0.5rem)]">
            <div class="swiper-wrapper">
              <?php foreach ($final_cases as $case) :
                $case_id = is_object($case) ? $case->ID : $case; ?>
                <div class="swiper-slide h-auto">
                  <?php get_template_part('templates/case-card', null, ['case_id' => $case_id]); ?>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-pagination relative bottom-0 m-0"></div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="container grid grid-cols-12 gap-1">
    <?php if ($txt_bottom) : ?>
      <div class="col-span-12 lg:col-span-6 lg:col-start-4  text-center flex flex-col items-center justify-center ">
        <article class="prose mb-5 mx-auto md:px-10 lg:px-16 xl:px-26">
          <?= wp_kses_post($txt_bottom); ?>
        </article>
      </div>
    <?php endif; ?>
    <?php
    $archive_link = get_post_type_archive_link('case');
    if ($archive_link) : ?>
      <div class="col-span-12 lg:col-span-6 lg:col-start-4 flex items-center justify-center ">
        <?php get_template_part('components/button', null, [
          'type' => 'without-icon',
          'text' => 'Alle cases',
          'url'  => $archive_link,
          'color' => 'white-border'
        ]); ?>
      </div>
    <?php endif; ?>
  </div>
  </section>