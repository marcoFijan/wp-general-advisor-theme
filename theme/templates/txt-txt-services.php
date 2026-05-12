<?php
$txt_left  = get_sub_field('txt_left');
$txt_right = get_sub_field('txt_right');
$sector_title = get_sub_field('sector_title');
$sector_txt = get_sub_field('sector_txt');

if (!have_rows('services') && !have_rows('sectors')) return;

$compass_path = get_theme_file_path('/assets/media/compass-small.svg');
$compass_svg = file_exists($compass_path)
  ? file_get_contents($compass_path)
  : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>';
?>

<section class="mt-section lg:mt-section-lg">
  <div class="container mx-auto px-4">

    <?php if ($txt_left || $txt_right) : ?>
      <div class="grid grid-cols-12 gap-8 mb-12 items-end 2xl:mx-14">
        <?php if ($txt_left) : ?>
          <div class="col-span-12 lg:col-span-6 prose prose-h1:text-blue prose-h1:text-5xl prose-h1:mb-0 max-w-none text-blue">
            <?= wp_kses_post($txt_left); ?>
          </div>
        <?php endif; ?>
        <?php if ($txt_right) : ?>
          <div class="col-span-12 lg:col-span-5 lg:col-start-8 prose max-w-none text-black/80 font-medium pb-2">
            <?= wp_kses_post($txt_right); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-12 gap-6">
      <?php
      if (have_rows('services')) :
        $service_count = 0;
        while (have_rows('services')) : the_row();
          if ($service_count >= 3) break;
          $service_count++;

          $term_id = get_sub_field('service');
          $icon    = get_sub_field('icon');
          $icon_id = is_array($icon) ? ($icon['ID'] ?? $icon['id'] ?? '') : $icon;
          $title   = get_sub_field('title');
          $intro   = get_sub_field('intro');

          $term      = get_term($term_id, 'service_type');
          $term_name = (!is_wp_error($term) && $term) ? $term->name : '';
          $term_link = (!is_wp_error($term) && $term) ? get_term_link($term) : '#';

          $linked_posts = [];
          if ($term_id) {
            $linked_posts = get_posts([
              'post_type'      => 'service',
              'posts_per_page' => -1,
              'post_status'    => 'publish',
              'tax_query'      => [[
                'taxonomy' => 'service_type',
                'field'    => 'term_id',
                'terms'    => $term_id,
              ]],
            ]);
          }
      ?>
          <div class="col-span-12 md:col-span-6 2xl:col-span-3 w-full bg-blue-lighter lg:min-h-88 rounded-usp-md p-6 flex flex-col">
            <?php if ($icon_id) : ?>
              <div class="mb-12 flex items-start justify-start">
                <?= wp_get_attachment_image($icon_id, 'full', false, [
                  'class' => 'h-24 w-auto object-contain max-w-none'
                ]); ?>
              </div>
            <?php endif; ?>

            <div class="flex flex-col h-full mt-auto">
              <a href="<?= esc_url($term_link); ?>" class="group/link flex items-center justify-between w-full text-left gap-1 mb-3 cursor-pointer transition-all duration-200">
                <h3 class="text-1.5xl font-semibold text-blue m-0">
                  <?= esc_html($title ?: $term_name); ?>
                </h3>
                <div class="flex items-center justify-center rounded-usp-xs p-2 transition-colors duration-200 bg-white text-blue group-hover/link:bg-blue group-hover/link:text-white shrink-0">
                  <span class="w-4 aspect-square flex items-center justify-center svg-container">
                    <?= $compass_svg; ?>
                  </span>
                </div>
              </a>

              <?php if ($intro) : ?>
                <div class="text-sm text-black/80 font-medium mb-5 line-clamp-3">
                  <?= nl2br(esc_html($intro)); ?>
                </div>
              <?php endif; ?>

              <?php if ($linked_posts) : ?>
                <div class="flex flex-wrap gap-1">
                  <?php foreach ($linked_posts as $p) : ?>
                    <a href="<?= get_permalink($p->ID); ?>"
                      class="relative inline-block overflow-hidden text-blue font-semibold bg-white px-2 py-1.5 rounded-label text-3xs transition-all after:absolute after:inset-0 after:bg-transparent hover:after:bg-black/10 after:transition-colors after:pointer-events-none">
                      <span class="relative z-10"><?= esc_html(get_the_title($p->ID)); ?></span>
                    </a>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
      <?php endwhile;
      endif; ?>


      <?php
      if (have_rows('sectors')) : ?>
        <div class="col-span-12 md:col-span-6 2xl:col-span-3 w-full bg-blue-lighter lg:min-h-88 rounded-usp-md p-5 flex gap-2 flex-col justify-between">
          <div>
            <?php if ($sector_title) : ?>
              <h3 class="text-blue font-semibold text-1.5xl leading-snug">
                <?= wp_kses_post($sector_title); ?>
              </h3>
            <?php endif; ?>

            <?php if ($sector_txt) : ?>
              <p class="text-black font-normal text-sm mt-2">
                <?= wp_kses_post($sector_txt); ?>
              </p>
            <?php endif; ?>
          </div>

          <div class="flex flex-col gap-3 mt-8">
            <?php
            while (have_rows('sectors')) : the_row();
              $sector_post_id = get_sub_field('sector');
              $icon           = get_sub_field('icon');
              $icon_id        = is_array($icon) ? ($icon['ID'] ?? $icon['id'] ?? '') : $icon;
              $icon_color     = get_sub_field('icon_color') ?: '#222C78';
              $custom_title   = get_sub_field('title');

              if (!$sector_post_id) continue;

              $post_url   = get_permalink($sector_post_id);
              $post_title = get_the_title($sector_post_id);
              $bg_color_style = $icon_color . '1A';
            ?>
              <a href="<?= esc_url($post_url); ?>" class="group/link bg-white rounded-usp-xs py-2.5 pl-2 pr-5 flex items-center gap-2">
                <?php if ($icon_id) : ?>
                  <div class="w-10 h-10 shrink-0 rounded-label flex items-center justify-center" style="background-color: <?= esc_attr($bg_color_style) ?>; color: <?= esc_attr($icon_color) ?>;">
                    <?= wp_get_attachment_image($icon_id, 'thumbnail', false, [
                      'class' => 'w-5 h-5 object-contain fill-current'
                    ]); ?>
                  </div>
                <?php endif; ?>

                <div class="flex flex-col">
                  <span class="text-black font-bold text-sm leading-tight transition-colors">
                    <?= esc_html($custom_title ?: $post_title); ?>
                  </span>
                  <?php if ($custom_title) : ?>
                    <span class="text-blue-light font-semibold text-3xs mt-0.5">
                      <?= esc_html($post_title); ?>
                    </span>
                  <?php endif; ?>
                </div>

                <div class="flex ml-auto items-center justify-center rounded-usp-xs border border-blue-lighter p-2 transition-colors duration-200 bg-white text-blue group-hover/link:bg-blue group-hover/link:border-blue group-hover/link:text-white shrink-0">
                  <span class="w-4 aspect-square flex items-center justify-center svg-container">
                    <?= $compass_svg; ?>
                  </span>
                </div>
              </a>
            <?php endwhile; ?>
          </div>

        </div>
      <?php endif; ?>

    </div>
  </div>
</section>