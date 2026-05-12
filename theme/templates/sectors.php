<?php
$txt_left  = get_sub_field('sectors_txt_left');
$txt_right = get_sub_field('sectors_txt_right');
?>

<section class="sectors-overview-section my-section lg:my-section-lg bg-white">
  <div class="container mx-auto px-4">

    <?php if ($txt_left || $txt_right): ?>
      <div class="grid grid-cols-12 gap-4 mb-12 lg:mb-22 items-center">
        <div class="col-span-12 lg:col-span-6 prose lg:mr-10">
          <?php echo $txt_left; ?>
        </div>
        <div class="col-span-12 lg:col-span-5 lg:col-start-8 lg:mr-10 prose">
          <?php echo $txt_right; ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if (have_rows('sectors')): ?>
      <div class="grid grid-cols-12 gap-4">
        <?php while (have_rows('sectors')): the_row();
          $sector_id = get_sub_field('sector');
          if (!$sector_id) continue;

          $sector_url   = get_permalink($sector_id);
          $sector_title = get_the_title($sector_id);

          $icon_id    = get_sub_field('icon');
          $icon_color = get_sub_field('icon_color');
          $txt        = get_sub_field('txt');
          $txt_link   = get_sub_field('txt_link');

          $bg_color_style = $icon_color ? $icon_color . '1A' : 'rgba(0,0,0,0.1)';
        ?>

          <a href="<?php echo esc_url($sector_url); ?>"
            class="group/card group/btn relative col-span-12 md:col-span-6 lg:col-span-4 bg-beige p-5 rounded-card flex flex-col justify-between overflow-hidden transition-all duration-300 after:absolute after:inset-0 after:bg-transparent hover:after:bg-black/10 after:transition-colors after:pointer-events-none">

            <div class="relative z-10">
              <div class="inline-flex items-center bg-white rounded-label p-1 pr-4 mb-8">
                <?php if ($icon_id): ?>
                  <div class="w-11 h-11 rounded-label flex items-center justify-center mr-3" style="background-color: <?php echo esc_attr($bg_color_style); ?>; color: <?php echo esc_attr($icon_color); ?>;">
                    <?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, [
                      'class' => 'w-5 h-5 object-contain fill-current'
                    ]); ?>
                  </div>
                <?php endif; ?>

                <?php if ($sector_title) : ?>
                  <span class="text-blue font-semibold text-1.2xs">
                    <?php echo esc_html($sector_title); ?>
                  </span>
                <?php endif; ?>
              </div>

              <?php if ($txt): ?>
                <div class="prose mb-16">
                  <?php echo $txt; ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="relative z-10 flex items-center justify-between">
              <span class="text-blue font-semibold text-1.2xs">
                <?php echo $txt_link ?: 'Ontdek sector'; ?>
              </span>

              <?php
              get_template_part('components/button', null, array(
                'color'        => 'blue',
                'type'         => 'only-icon',
                'rotation'     => '0deg',
                'extraClasses' => 'group-hover/card:bg-blue-dark'
              ));
              ?>
            </div>

          </a>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</section>