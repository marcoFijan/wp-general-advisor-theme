<?php
$queried_object = get_queried_object_id();
$txt        = get_field('txt', $queried_object);
$img_id     = get_field('img', $queried_object);
$subtitle   = get_field('subtitle', $queried_object);
$sub_txt    = get_field('sub_txt', $queried_object);
$location   = get_field('location', $queried_object);
$contract   = get_field('contract_hours', $queried_object);
$salary     = get_field('salary', $queried_object);

$display_title = '<h1>' . get_the_title($queried_object) . '</h1>';

$loc_icon    = file_get_contents(get_theme_file_path('/assets/media/location.svg'));
$salary_icon = file_get_contents(get_theme_file_path('/assets/media/salary.svg'));
$time_icon   = file_get_contents(get_theme_file_path('/assets/media/time.svg'));

$meta_data = [
  ['label' => 'Locatie', 'value' => $location, 'icon' => $loc_icon],
  ['label' => 'Dienstverband', 'value' => $contract, 'icon' => $time_icon],
  ['label' => 'Salaris', 'value' => $salary, 'icon' => $salary_icon],
];
?>

<section class="container pt-23 pb-12 breadcrumb-dark-no-bg">

  <div class="grid grid-cols-12">
    <div class="col-span-12 lg:col-span-10 lg:col-start-2">

      <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

      <div class="grid grid-cols-10 items-end mb-8 border-b border-stone-medium/30 w-full pb-8">

        <div class="col-span-10 lg:col-span-6 prose mt-5">
          <?= $display_title; ?>
        </div>

        <div class="col-span-10 lg:col-span-4 lg:col-start-7 lg:ml-10 flex flex-wrap items-end gap-2 mb-2">
          <?php foreach ($meta_data as $meta): if (!$meta['value']) continue; ?>
            <span class="bg-blue/5 text-blue py-2 px-3 rounded-lg text-1.2xs font-semibold flex items-center gap-2">
              <span class="w-3.5 h-3.5 flex items-center justify-center text-blue fill-current">
                <?= $meta['icon']; ?>
              </span>
              <?= esc_html($meta['value']); ?>
            </span>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="grid grid-cols-12 gap-8 mt-6 mb-12">
        <div class="col-span-12 lg:col-span-5">
          <?php
          get_template_part('components/button', null, array(
            'link'      => '#form',
            'color'     => 'green',
            'text'      => 'Soliciteer direct',
            'iconColor' => 'text-blue'
          ));
          ?>
        </div>
        <article class="col-span-12 lg:col-span-5 lg:ml-10 lg:col-start-8 prose">
          <?= $txt; ?>
        </article>
      </div>

    </div>
  </div>

  <?php if ($img_id): ?>
    <div class="w-full aspect-[1360/471] rounded-card overflow-hidden mb-16">
      <?= wp_get_attachment_image($img_id, 'full', false, ['class' => 'w-full h-full object-cover']); ?>
    </div>
  <?php endif; ?>

  <div class="grid grid-cols-12">
    <div class="col-span-12 lg:col-span-10 lg:col-start-2">

      <?php if ($subtitle): ?>
        <div class="prose mb-17">
          <?= $subtitle; ?>
        </div>
      <?php endif; ?>

      <div class="grid grid-cols-12 gap-y-12">

        <div class="col-span-12 lg:col-span-3 flex flex-col gap-2">
          <h6 class="text-lg font-semibold font-heading text-blue mb-0">
            De vacature
          </h6>
          <?php foreach ($meta_data as $meta): if (!$meta['value']) continue; ?>
            <div class="flex flex-col gap-2">
              <span class="bg-blue/5 text-blue py-2 px-3 rounded-lg text-1.2xs font-semibold flex items-center gap-2 w-max">
                <span class="w-3.5 h-3.5 flex items-center justify-center text-blue fill-current">
                  <?= $meta['icon']; ?>
                </span>
                <?= esc_html($meta['value']); ?>
              </span>
            </div>
          <?php endforeach; ?>

          <div>
            <?php
            get_template_part('components/button', null, array(
              'link'      => '#form',
              'color'     => 'green',
              'text'      => 'Soliciteer direct',
              'iconColor' => 'text-blue'
            ));
            ?>
          </div>
        </div>

        <div class="col-span-12 lg:col-span-8 lg:ml-10 lg:col-start-5 prose max-w-none">
          <?= $sub_txt; ?>
        </div>

      </div>
    </div>
  </div>

</section>