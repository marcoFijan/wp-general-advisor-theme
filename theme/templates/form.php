<?php
$bg_color_val = get_sub_field('bg_color');
$txt          = get_sub_field('txt');
$form_title   = get_sub_field('form_title');
$form_id      = get_sub_field('form');

$bg_map = [
  'beige'      => 'bg-beige',
  'white'      => 'bg-white',
  'light_blue' => 'bg-blue-lightest',
  'blue'       => 'bg-blue text-white',
];

$bg_class = $bg_map[$bg_color_val] ?? 'bg-white';

$intro_prose_class = ($bg_color_val === 'blue') ? 'prose-white' : 'prose-blue';
?>

<section id="form" class="py-12 md:py-20 <?= esc_attr($bg_class); ?>">
  <div class="container">
    <div class="grid grid-cols-12">

      <div class="col-span-12 lg:col-span-6 lg:col-start-4">

        <?php if ($txt): ?>
          <div class="wysiwyg prose max-w-none mb-10 md:mb-12 <?= $intro_prose_class; ?>">
            <?= $txt; ?>
          </div>
        <?php endif; ?>

        <div class="bg-white rounded-card py-12 px-6 md:px-10 text-blue">

          <?php if ($form_title): ?>
            <div class="prose prose-blue max-w-none mb-13">
              <?= $form_title; ?>
            </div>
          <?php endif; ?>

          <?php if ($form_id): ?>
            <div class="form-wrapper">
              <?= do_shortcode('[contact-form-7 id="' . $form_id . '"]'); ?>
            </div>
          <?php endif; ?>

        </div>

      </div>

    </div>
  </div>
</section>