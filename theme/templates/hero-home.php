<?php

$title_left  = get_field('title_left');
$title_right = get_field('title_right');
$text     = get_field('txt');
$img         = get_field('img');
$primary_link   = get_field('primary_link');
$primary_color  = get_field('primary_link_color');
$secondary_link = get_field('secondary_link');

$piechart  = get_field('piechart');
$big_usp   = get_field('big_usp');
$txt_usp_1 = get_field('txt_usp_1');
$txt_usp_2 = get_field('txt_usp_2');
$barchart  = get_field('barchart');

function hero_icon(string $icon, string $color = '#87BD25'): string
{
  $icons = [
    'chevron_up'   => get_theme_file_path('/assets/media/chevron-up.svg'),
    'chevron_down' => get_theme_file_path('/assets/media/chevron-down.svg'),
    'cross'        => get_theme_file_path('/assets/media/cross.svg'),
    'compass'      => get_theme_file_path('/assets/media/compass-small.svg'),
  ];

  $path = $icons[$icon] ?? '';
  $svg  = ($path && file_exists($path)) ? file_get_contents($path) : '';

  return '
    <div class="rounded-lg p-2 aspect-square flex items-center justify-center " style="background-color:' . esc_attr($color) . '1A; color:' . esc_attr($color) . ';">
      ' . $svg . '
    </div>
  ';
}

function hero_icon_raw(string $icon, string $color = '#87BD25'): string
{
  $icons = [
    'chevron_up'   => get_theme_file_path('/assets/media/chevron-up.svg'),
    'chevron_down' => get_theme_file_path('/assets/media/chevron-down.svg'),
    'cross'        => get_theme_file_path('/assets/media/cross.svg'),
    'compass'      => get_theme_file_path('/assets/media/compass-small.svg'),
  ];

  $path = $icons[$icon] ?? '';
  $svg  = ($path && file_exists($path)) ? file_get_contents($path) : '';

  return '<span style="color:' . esc_attr($color) . ';">' . $svg . '</span>';
}
?>

<section class="pt-21 lg:pt-36 bg-linear-to-b from-white to-beige overflow-hidden">
  <div class="hero-home container mx-auto">
    <article class="grid grid-cols-12 gap-2 prose">
      <div class="col-span-12 text-center mb-8">
        <h1 class="text-5xl md:text-6xl lg:text-7xl flex flex-col lg:flex-row items-center justify-center gap-4">
          <?php if ($title_left): ?>
            <span class="block md:text-right"><?php echo esc_html($title_left); ?></span>
          <?php endif; ?>
          <div class="compass-icon h-17 w-17 flex items-center justify-center">
            <?php
            $path = get_theme_file_path('/assets/media/compass-large.svg');
            if (file_exists($path)) {
              echo file_get_contents($path);
            }
            ?>
          </div>
          <?php if ($title_right): ?>
            <span class="block md:text-left"><?php echo esc_html($title_right); ?></span>
          <?php endif; ?>
        </h1>
      </div>

      <?php if ($text): ?>
        <div class="col-span-12 lg:col-span-6 lg:col-start-4 text-center mb-10">
          <div class="prose prose-lg max-w-none">
            <?php echo $text; ?>
          </div>
        </div>
      <?php endif; ?>

    </article>

    <?php if ($primary_link || $secondary_link): ?>
      <div class="flex flex-wrap justify-center gap-4 mb-12 mt-6">

        <?php if ($primary_link): ?>
          <?php get_template_part('components/button', null, array(
            'link'  => $primary_link,
            'color' => $primary_color,
            'iconColor' => 'text-blue'
          )); ?>
        <?php endif; ?>

        <?php if ($secondary_link): ?>
          <?php get_template_part('components/button', null, array(
            'link'  => $secondary_link,
            'color' => 'white-outline',
            'type'  => 'without-icon',
          )); ?>
        <?php endif; ?>

      </div>
    <?php endif; ?>

    <div class="relative w-full lg:pt-12 lg:pb-0 h-auto">
      <div class="absolute top-0 right-0 aspect-square h-auto w-2/3 lg:w-202 lg:h-202 bg-radial from-green/30 via-transparent to-transparent pointer-events-none z-0 translate-x-1/2 -translate-y-1/3"></div>
      <?php if ($img): ?>
        <div class="w-full overflow-hidden rounded-card relative z-10 mb-4 lg:mb-0">
          <?php
          echo wp_get_attachment_image($img['ID'], 'wijd', false, [
            'class'   => 'w-full aspect-video lg:aspect-auto lg:h-auto object-cover block',
            'loading' => 'eager',
          ]);
          ?>
        </div>
      <?php endif; ?>

      <?php
      $has_any_usp = !empty($piechart['has_piechart'])
        || !empty($big_usp['has_big_usp'])
        || !empty($txt_usp_1['has_txt_usp_1'])
        || !empty($txt_usp_2['has_txt_usp_2'])
        || !empty($barchart['has_barchart']);

      if ($has_any_usp):
      ?>

        <?php if (!empty($piechart['has_piechart']) && isset($piechart['piechart_percentage'])): ?>
          <?php
          $pct           = (int) $piechart['piechart_percentage'];
          $radius        = 46;
          $circumference = round(2 * M_PI * $radius, 2);
          $green_length  = round($circumference * $pct / 100, 2);

          $blue_length       = round($circumference * (100 - $pct) / 100 * 2 / 3, 2);
          $blue_start_offset = -$green_length;
          ?>
          <div class="absolute top-0 left-4 hidden lg:flex md:left-8 lg:left-26 bg-white/90 backdrop-blur-md rounded-card shadow-lg p-6 flex-col items-center gap-2 z-20">
            <div class="relative w-24 h-24">
              <svg viewBox="0 0 120 120" class="w-full h-full -rotate-90" aria-hidden="true">
                <circle cx="60" cy="60" r="<?php echo $radius; ?>"
                  fill="none" stroke="#DFE1EC" stroke-width="28" />
                <circle cx="60" cy="60" r="<?php echo $radius; ?>"
                  fill="none" stroke="#87BD25" stroke-width="28"
                  stroke-linecap="butt"
                  stroke-dasharray="<?php echo $green_length . ' ' . $circumference; ?>"
                  stroke-dashoffset="0" />
                <circle cx="60" cy="60" r="<?php echo $radius; ?>"
                  fill="none" stroke="#222C78" stroke-width="28"
                  stroke-linecap="butt"
                  stroke-dasharray="<?php echo $blue_length . ' ' . $circumference; ?>"
                  stroke-dashoffset="<?php echo $blue_start_offset; ?>" />
                <circle cx="60" cy="60" r="<?php echo $radius - 14; ?>"
                  fill="white" stroke="none" />
              </svg>
              <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-base font-title font-light leading-none"><?php echo $pct; ?>%</span>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if (!empty($big_usp['has_big_usp'])): ?>
          <div class="absolute top-0 hidden lg:flex right-8 bg-white/90 backdrop-blur-md rounded-usp-md shadow-lg p-8 max-w-70 gap-4 z-20">
            <div class="grid grid-cols-3 gap-px shrink-0">
              <div class="w-usp-block aspect-square bg-green rounded-usp-xs"></div>
              <div class="w-usp-block aspect-square bg-green/40 rounded-usp-xs"></div>
              <div class="w-usp-block aspect-square bg-green/15 rounded-usp-xs"></div>

              <div class="w-usp-block aspect-square bg-green rounded-usp-xs"></div>
              <div class="w-usp-block aspect-square bg-green rounded-usp-xs"></div>
              <div class="w-usp-block aspect-square bg-green/30 rounded-usp-xs"></div>

              <div class="w-usp-block aspect-square bg-green rounded-usp-xs"></div>
              <div class="w-usp-block aspect-square bg-green rounded-usp-xs"></div>
              <div class="w-usp-block aspect-square bg-green rounded-usp-xs"></div>
            </div>
            <div class="flex flex-col justify-between gap-2">
              <?php if (!empty($big_usp['big_usp_label'])): ?>
                <span class="text-sm font-medium text-black">
                  <?php echo esc_html($big_usp['big_usp_label']); ?>
                </span>
              <?php endif; ?>
              <div class="flex items-center gap-2">
                <?php if (!empty($big_usp['big_usp_icon'])): ?>
                  <span class="w-5 shrink-0">
                    <?php echo hero_icon_raw($big_usp['big_usp_icon'], $big_usp['big_usp_color'] ?? '#87BD25'); ?>
                  </span>
                <?php endif; ?>
                <?php if (isset($big_usp['big_usp_number']) && $big_usp['big_usp_number'] !== ''): ?>
                  <span class="text-4.5xl font-heading  font-light leading-none">
                    <?php echo esc_html($big_usp['big_usp_number']); ?>%
                  </span>
                <?php endif; ?>
              </div>
            </div>

          </div>
        <?php endif; ?>

        <?php if (!empty($txt_usp_1['has_txt_usp_1']) && !empty($txt_usp_1['txt_usp_1_txt'])): ?>
          <div class="absolute -top-4 lg:top-44 left-8 bg-white/90 backdrop-blur-md rounded-usp-sm px-3 py-2 flex items-center gap-3 z-20">
            <?php if (!empty($txt_usp_1['txt_usp_1_icon'])): ?>
              <span class="w-7 h-7 shrink-0">
                <?php echo hero_icon($txt_usp_1['txt_usp_1_icon'], $txt_usp_1['txt_usp_1_color'] ?? '#FF0000'); ?>
              </span>
            <?php endif; ?>
            <span class="font-regular font-heading text-smx pr-2"><?php echo esc_html($txt_usp_1['txt_usp_1_txt']); ?></span>
          </div>
        <?php endif; ?>

        <?php if (!empty($txt_usp_2['has_txt_usp_2']) || !empty($barchart['has_barchart'])): ?>
          <div class="absolute -bottom-4 lg:bottom-auto lg:top-58 right-8 bg-white/90 backdrop-blur-md rounded-usp-sm  px-3 py-2 flex items-center gap-3 z-20">
            <?php if (!empty($txt_usp_2['has_txt_usp_2']) && !empty($txt_usp_2['txt_usp_2_txt'])): ?>
              <?php if (!empty($txt_usp_2['txt_usp_2_icon'])): ?>
                <span class="w-7 h-7 shrink-0">
                  <?php echo hero_icon($txt_usp_2['txt_usp_2_icon'], $txt_usp_2['txt_usp_2_color'] ?? '#FF9027'); ?>
                </span>
              <?php endif; ?>
              <span class="font-regular font-heading text-smx pr-2"><?php echo esc_html($txt_usp_2['txt_usp_2_txt']); ?></span>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($barchart['has_barchart'])): ?>
          <?php $bar_color = $barchart['barchart_color'] ?? '#222C78'; ?>

          <div class="absolute bottom-0 lg:bottom-8 hidden lg:flex left-10 bg-white/90 backdrop-blur-md rounded-usp-sm p-6 pb-3 flex-col gap-3 z-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="171" height="73" fill="none" viewBox="0 0 171 73">
              <rect width="4.909" height="34.438" x="0" y="38.562" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="43.977" x="6.606" y="29.023" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="57.701" x="13.211" y="15.299" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="50.163" x="19.817" y="22.837" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="43.977" x="26.423" y="29.023" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="49.253" x="33.028" y="23.747" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="47.07" x="39.634" y="25.93" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="54.529" x="46.24" y="18.471" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="42.34" x="52.845" y="30.66" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="36.7" x="59.451" y="36.3" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="30.332" x="66.057" y="42.668" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="32.561" x="72.662" y="40.439" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="34.438" x="79.268" y="38.562" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="51.416" x="85.874" y="21.584" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="57.701" x="92.479" y="15.299" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="63.986" x="99.085" y="9.014" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="67.811" x="105.691" y="5.189" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="60.533" x="112.296" y="12.467" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="51.416" x="118.902" y="21.584" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="47.07" x="125.508" y="25.93" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="55.985" x="132.113" y="17.015" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="63.986" x="138.719" y="9.014" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="72.327" x="145.325" y="0.673" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="67.811" x="151.93" y="5.189" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="72.327" x="158.536" y="0.673" fill="<?php echo $bar_color; ?>" rx="1" />
              <rect width="4.909" height="57.701" x="165.142" y="15.299" fill="<?php echo $bar_color; ?>" rx="1" />
            </svg>
            <?php if (!empty($barchart['barchart_txt'])): ?>
              <span class="text-smx text-black font-heading leading-none"><?php echo esc_html($barchart['barchart_txt']); ?></span>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
  .hero-icon svg {
    width: 100%;
    height: 100%;
    stroke: currentColor;
  }
</style>