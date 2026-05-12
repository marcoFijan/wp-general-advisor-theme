<?php
$post_id     = $args['post_id'] ?? get_the_ID();
$is_featured = $args['is_featured'] ?? false;
$thumb_id = get_field('video_thumbnail', $post_id);
$yt_id    = get_field('yt_id', $post_id);
$post_terms  = get_the_terms($post_id, 'news_category');

$img_html = '';
if ($thumb_id) {
  $img_html = wp_get_attachment_image($thumb_id, 'large', false, ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105']);
} elseif ($yt_id) {
  $yt_thumb = "https://img.youtube.com/vi/" . esc_attr($yt_id) . "/maxresdefault.jpg";
  $img_html = '<img src="' . esc_url($yt_thumb) . '" alt="' . esc_attr(get_the_title($post_id)) . '" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">';
} else {
  $img_html = '<div class="w-full h-full bg-blue/10"></div>';
}

$card_layout   = $is_featured ? 'flex flex-col gap-6 p-xs' : 'flex flex-col gap-4 p-xs';
$thumb_layout  = 'w-full aspect-video shrink-0';
$title_size    = $is_featured ? 'text-3xl md:text-4xl pb-10' : 'text-2.5xl pb-4';
$text_margins  = $is_featured ? 'mx-xs md:mx-10' : 'mx-xs';
$play_btn_size = $is_featured ? 'w-20 h-20 md:w-30 md:h-30' : 'w-20 h-20';
?>

<div class="bg-white rounded-card h-full <?= $card_layout; ?>">

  <div class="<?= $thumb_layout; ?> rounded-usp-md overflow-hidden relative bg-stone-medium/20 group cursor-pointer"
    onclick="this.innerHTML = '<iframe width=\'100%\' height=\'100%\' src=\'https://www.youtube.com/embed/<?= esc_attr($yt_id) ?>?autoplay=1&rel=0\' frameborder=\'0\' allow=\'autoplay; encrypted-media\' allowfullscreen class=\'absolute inset-0 w-full h-full\'></iframe>'">
    <?= $img_html; ?>
    <div class="absolute inset-0 bg-blue/40 pointer-events-none transition-opacity duration-300"></div>
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
      <div class="<?= $play_btn_size; ?> transition-transform duration-300 group-hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 176 176" fill="none" class="w-full h-full">
          <circle data-figma-bg-blur-radius="10" cx="87.5527" cy="87.5527" r="87.5527" fill="white" fill-opacity="1" />
          <path d="M108.053 83.2226C111.386 85.1471 111.386 89.9584 108.053 91.8829L81.0527 107.471C77.7194 109.396 73.5527 106.99 73.5527 103.141L73.5527 71.9643C73.5527 68.1153 77.7194 65.7096 81.0527 67.6341L108.053 83.2226Z" fill="#87BD25" />
          <defs>
            <clipPath id="bgblur_0_2507_5568_clip_path" transform="translate(10 10)">
              <circle cx="87.5527" cy="87.5527" r="87.5527" />
            </clipPath>
          </defs>
        </svg>
      </div>
    </div>
  </div>

  <div class="flex flex-col justify-center grow mt-2 <?= $text_margins; ?>">

    <?php if ($is_featured): ?>

      <div class="flex flex-col-reverse md:flex-row md:justify-between items-start md:gap-6">
        <h3 class="text-blue font-heading <?= $title_size; ?> md:w-2/3 md:mb-0 mt-0">
          <?php echo get_the_title($post_id); ?>
        </h3>

        <div class="w-full flex flex-wrap gap-2 mb-4 md:mb-0 md:w-1/3 md:justify-end">
          <?php if ($post_terms && !is_wp_error($post_terms)): ?>
            <?php foreach ($post_terms as $term): ?>
              <span class="bg-blue/5 text-blue py-2 px-3 flex gap-2 items-center rounded-lg text-sm font-bold shrink-0">
                <?= esc_html($term->name); ?>
              </span>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

    <?php else: ?>

      <div class="w-full mb-4 flex flex-wrap gap-2">
        <?php if ($post_terms && !is_wp_error($post_terms)): ?>
          <?php foreach ($post_terms as $term): ?>
            <span class="bg-blue/5 text-blue py-2 px-3 flex gap-2 items-center rounded-lg text-sm font-bold">
              <?= esc_html($term->name); ?>
            </span>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <h3 class="text-blue font-heading <?= $title_size; ?>">
        <?php echo get_the_title($post_id); ?>
      </h3>

    <?php endif; ?>

  </div>
</div>