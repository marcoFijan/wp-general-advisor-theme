<?php
$case_id = $args['case_id'] ?? get_the_ID();

$get_case_data = function ($field_name, $post_id) {
  $sub = get_sub_field($field_name, $post_id);
  if ($sub) return $sub;
  return get_field($field_name, $post_id);
};


$sector_id = $get_case_data('sector', $case_id);
$sector_name = $sector_id ? get_the_title($sector_id) : '';

$thumb_id = get_post_thumbnail_id($case_id);
?>

<a href="<?= get_permalink($case_id); ?>"
  class="group relative block overflow-hidden rounded-card shadow-sm aspect-3/4 transition-all duration-300 hover:shadow-lg">

  <div class="absolute inset-0 z-0 bg-blue">
    <?php if ($thumb_id) : ?>
      <?= wp_get_attachment_image($thumb_id, 'large', false, [
        'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110',
      ]); ?>
    <?php else : ?>
      <div class="w-full h-full bg-blue-dark/20 flex items-center justify-center">
        <span class="text-white/20 text-4xl">?</span>
      </div>
    <?php endif; ?>
  </div>

  <div class="relative z-10 h-full w-full flex flex-col justify-between p-7.5">

    <div class="self-start">
      <?php if ($sector_name) : ?>
        <span class="bg-white/65 text-blue-dark py-2 px-3 flex gap-1 items-center rounded-lg text-xs font-semibold backdrop-blur-sm">
          <span class="w-4 -rotate-35 -mt-1">
            <?php
            $path = get_theme_file_path('/assets/media/compass-small.svg');
            if (file_exists($path)) {
              echo file_get_contents($path);
            }
            ?>
          </span>
          <?= esc_html($sector_name); ?>
        </span>
      <?php endif; ?>
    </div>

    <div class="absolute -bottom-20 left-0 w-full overflow-visible p-usp-card bg-linear-to-t from-blue via-blue/80 to-transparent pt-36">
      <h3 class="text-white text-3xl mb-20 font-medium leading-tight">
        <?= get_the_title($case_id); ?>
      </h3>
    </div>

  </div>
</a>