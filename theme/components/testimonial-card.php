<?php
$sector_id   = $args['sector'] ?? null;
$sector_name = $args['sector_name'] ?? ($sector_id ? get_the_title($sector_id) : '');

$quote   = $args['quote']   ?? '';
$img_id  = $args['img_id']  ?? null;
$name    = $args['name']    ?? '';
$company = $args['company'] ?? '';
?>

<div class="bg-blue-lighter px-7.5 py-5 rounded-usp-md flex flex-col gap-6 h-full">

  <div class="flex justify-start">
    <?php if ($sector_name) : ?>
      <span class="bg-blue/5 text-blue-dark py-2 px-3 flex gap-1 items-center rounded-lg text-sm font-semibold backdrop-blur-sm">
        <span class="w-4 h-4 -rotate-35 -mt-1">
          <?php
          $path = get_theme_file_path('/assets/media/compass-small.svg');
          if (file_exists($path)) {
            $svg = file_get_contents($path);
            echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
          }
          ?>
        </span>
        <?= esc_html($sector_name); ?>
      </span>
    <?php endif; ?>
  </div>

  <?php if ($quote) : ?>
    <div class="flex-1">
      <p class="text-sm leading-relaxed mb-10 text-black">
        <?= nl2br(esc_html($quote)); ?>
      </p>
    </div>
  <?php endif; ?>

  <div class="flex items-center gap-4 mt-auto">
    <?php if ($img_id) : ?>
      <div class="w-12.5 h-12.5 rounded-full overflow-hidden bg-white shrink-0 border border-transparent">
        <?= wp_get_attachment_image($img_id, 'thumbnail', false, [
          'class' => 'w-full h-full object-cover',
          'alt'   => esc_attr($name),
        ]); ?>
      </div>
    <?php endif; ?>

    <div>
      <?php if ($name) : ?>
        <p class="font-normal text-base text-black leading-none font-heading">
          <?= esc_html($name); ?>
        </p>
      <?php endif; ?>
      <?php if ($company) : ?>
        <p class="text-black/40 text-2xs font-normal font-heading">
          <?= esc_html($company); ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</div>