<?php
$txt_left   = get_sub_field('txt_left');
$txt_right  = get_sub_field('txt_right');
$link       = get_sub_field('link');
$link_color = get_sub_field('link_color');
$bg_color_array = get_sub_field('bg_color');
$bg_color = get_sub_field('bg_color') ?: 'white';

$bg_classes = [
  'white'      => 'bg-white my-section lg:my-section-lg',
  'beige'      => 'bg-beige py-section lg:py-section-lg',
  'light_blue' => 'bg-blue-lighter py-section lg:py-section-lg',
  'blue'       => 'bg-blue text-white py-section lg:py-section-lg'
];

$selected_bg = $bg_classes[$bg_color] ?? $bg_classes['white'];
$prose_class = ($bg_color === 'blue') ? 'prose-white' : '';

if ($txt_left || $txt_right): ?>

  <section class="<?= esc_attr($selected_bg); ?>">
    <div class="container mx-auto grid grid-cols-12 gap-4">

      <article class="col-span-12 lg:col-span-5 xl:col-span-4 xl:col-start-2 prose max-w-none <?= $prose_class; ?>">
        <?php echo $txt_left; ?>
      </article>

      <article class="col-span-12 lg:col-span-6 lg:col-start-7 xl:col-span-5 xl:col-start-7 prose max-w-none <?= $prose_class; ?>">
        <?php echo $txt_right; ?>

        <?php if ($link): ?>
          <div class="mt-8">
            <?php get_template_part('components/button', null, array(
              'link'  => $link,
              'color' => ($bg_color === 'blue') ? 'green' : ($link_color ?: 'blue'),
            )); ?>
          </div>
        <?php endif; ?>
      </article>
    </div>
  </section>
<?php endif; ?>