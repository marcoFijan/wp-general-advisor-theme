<?php
$img              = get_sub_field('img');
$title_left       = get_sub_field('title_left');
$scrollable_title = get_sub_field('scrollable_title') ?: [];
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
  </div>

  </section>