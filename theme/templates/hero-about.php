<?php
$queried_object = get_queried_object();
$title      = get_field('hero_title', $queried_object);
$txt        = get_field('hero_txt', $queried_object);
$img        = get_field('hero_img', $queried_object);
$usps_group = get_field('usps', $queried_object);
$usps       = $usps_group['usp'] ?? false;

if ($title) {
  $display_title = $title;
} else {
  $display_title = '<h1>' . get_the_title() . '</h1>';
}
?>

<section class="pt-23 pb-12 overflow-hidden breadcrumb-dark bg-linear-to-b from-white to-beige">
  <div class="container">
    <div class="grid grid-cols-12 w-full">
      <div class="col-span-12">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
      </div>
      <div class="col-span-12 pb-6 border-b border-stone-medium/30 prose mt-5 mb-8">
        <?= $display_title; ?>
      </div>
    </div>

    <div class="grid grid-cols-12 gap-8 mt-6 mb-4">
      <article class="col-span-11 lg:col-span-8 prose max-w-105">
        <?php if ($txt): ?>
          <?= $txt; ?>
        <?php endif; ?>
      </article>

      <div class="col-span-1 col-start-12 flex items-start justify-end">
        <?php
        get_template_part('components/button', null, array(
          'link'     => '#content-start',
          'color'    => 'blue',
          'type'     => 'only-icon',
          'rotation' => '90deg'
        ));
        ?>
      </div>
    </div>

    <?php if ($img): ?>
      <div class="grid grid-cols-12 mt-11 mb-section lg:mb-section-lg">
        <div class="col-span-12 overflow-visible w-full relative">
          <div class="absolute top-0 right-0 aspect-square h-auto w-2/3 lg:w-202 lg:h-202 bg-radial from-green/30 via-transparent to-transparent pointer-events-none z-0 translate-x-1/2 -translate-y-1/3"></div>

          <?php
          echo wp_get_attachment_image($img, 'wide-hero', false, [
            'class' => 'w-full h-auto aspect-video rounded-card overflow-hidden lg:aspect-auto block object-cover',
            'alt'   => strip_tags($display_title)
          ]);
          ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="container">
    <?php
    get_template_part('templates/txt-features', null, [
      'txt'       => get_field('txt', $queried_object),
      'features'  => get_field('features', $queried_object),
      'is_nested' => true
    ]);
    ?>
  </div>

  <div class="container mt-20 lg:mt-44">
    <?php if ($usps): ?>
      <div class="grid grid-cols-12 gap-4 mt-12">
        <div class="col-span-12 lg:col-span-10 lg:col-start-2 flex flex-col xl:flex-row gap-4 justify-between">

          <?php foreach ($usps as $usp):
            $number   = $usp['number'] ?? '';
            $unit     = $usp['unit'] ?? '';
            $unit_pos = $usp['unit_position'] ?? 'default';
            $usp_txt  = $usp['txt'] ?? '';
          ?>
            <div class="flex-1 bg-white rounded-usp-md p-usp-card flex flex-col gap-9.5 justify-between items-start">

              <?php if ($number): ?>
                <div class="flex text-blue font-heading font-light leading-none">
                  <span class="text-5.5xl">
                    <?= esc_html($number); ?>
                  </span>

                  <?php if ($unit): ?>
                    <?php if ($unit_pos === 'top'): ?>
                      <span class="text-2xl ml-1 pt-1">
                        <?= esc_html($unit); ?>
                      </span>
                    <?php elseif ($unit_pos === 'bottom'): ?>
                      <span class="text-3xl ml-1 mt-auto pb-1">
                        <?= esc_html($unit); ?>
                      </span>
                    <?php else: ?>
                      <span class="text-5.5xl">
                        <?= esc_html($unit); ?>
                      </span>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if ($usp_txt): ?>
                <div class="prose text-black prose-p:mb-0">
                  <?= wp_kses_post($usp_txt); ?>
                </div>
              <?php endif; ?>

            </div>
          <?php endforeach; ?>

        </div>
      </div>
    <?php endif; ?>

  </div>
</section>