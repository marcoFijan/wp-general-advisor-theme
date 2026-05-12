<?php
$get_data = function ($field_name) use ($args) {
  if (isset($args[$field_name]) && !empty($args[$field_name])) {
    return $args[$field_name];
  }
  return get_sub_field($field_name) ?: get_field($field_name);
};

$options           = $get_data('options');
$bg_color          = $options['bg_color'] ?? 'transparent';
$selected_employee = $options['selected_employee'] ?? false;

$bg_classes = [
  'white'       => 'bg-white my-section lg:my-section-lg',
  'light_blue'  => 'bg-blue-lighter py-12 lg:py-25',
  'transparent' => 'bg-transparent py-12 lg:py-25',
];

$selected_bg = $bg_classes[$bg_color] ?? $bg_classes['transparent'];
$image_wrapper_bg = ($bg_color === 'light_blue') ? 'bg-white' : 'bg-blue-lighter';

if ($selected_employee) {
  $employee_post = $get_data('employee');
  if ($employee_post) {
    $p_id     = is_object($employee_post) ? $employee_post->ID : $employee_post;
    $name     = get_the_title($p_id);
    $job      = get_field('jobtitle', $p_id);
    $tel      = get_field('tel', $p_id);
    $mail     = get_field('mail', $p_id);
    $emp_img  = get_field('img', $p_id);
    $image_id = is_array($emp_img) ? ($emp_img['ID'] ?? null) : $emp_img;
  }
} else {
  $name     = $get_data('name');
  $job      = $get_data('job_title');
  $tel      = $get_data('tel');
  $mail     = $get_data('mail');
  $emp_img  = $get_data('img');
  $image_id = is_array($emp_img) ? ($emp_img['ID'] ?? null) : $emp_img;
}

$main_title = $get_data('title');
$main_text  = $get_data('txt');
?>

<section class="<?= esc_attr($selected_bg); ?>">
  <div class="container grid grid-cols-12 gap-x-4 gap-y-10 items-start">
    <div class="col-span-12 lg:col-span-3 lg:col-start-2">
      <div class="relative rounded-card overflow-hidden <?= $image_wrapper_bg; ?>">
        <?php if ($image_id) : ?>
          <?= wp_get_attachment_image($image_id, 'portrait', false, [
            'class' => 'w-full h-full block object-cover border-none border-0'
          ]); ?>
        <?php endif; ?>

        <div class="absolute inset-0 flex flex-col justify-end p-6 bg-linear-to-t from-black/20 via-transparent to-transparent">
          <?php if ($name) : ?>

            <span class="text-white text-1.2xs font-semibold leading-tight p-1.5 pr-4 bg-blue rounded-full flex gap-1.5 justify-start items-center w-max ">
              <div class="bg-white rounded-full aspect-square w-[1.6rem]">
                <?php $path = get_theme_file_path('/assets/media/compass-large.svg');
                if (file_exists($path)) {
                  $svg = file_get_contents($path);
                  echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
                } ?>
              </div>
              <?= esc_html($name); ?>
            </span>
          <?php endif; ?>
          <?php if ($job) : ?>
            <p class="text-white/90 text-1.2xs font-semibold mt-1">
              <?= esc_html($job); ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <article class="col-span-12 lg:col-span-7 grid grid-cols-12 lg:grid-cols-7 gap-x-4 lg:gap-y-8 prose">
      <?php if ($main_title) : ?>
        <article class="prose leading-tight col-span-12 lg:col-span-7 lg:ml-18 mb-8">
          <?= $main_title; ?>
        </article>
      <?php endif; ?>
      <div class="col-span-12 lg:col-span-3 lg:ml-18 ">
        <p class="text-black text-1.5xl mb-5 font-semibold">Contact</p>
        <div class="flex flex-col gap-y-8">
          <?php if ($tel) : ?>
            <div class="flex flex-col items-start">
              <span class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none">
                Bellen
              </span>

              <a href="tel:<?= preg_replace('/[^0-9]/', '', $tel); ?>" class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200">
                <?= esc_html($tel); ?>
              </a>
            </div>
          <?php endif; ?>

          <?php if ($mail) : ?>
            <div class="flex flex-col items-start">
              <span class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none">
                E-mailen
              </span>

              <a href="mailto:<?= antispambot($mail); ?>" class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200">
                <?= esc_html($mail); ?>
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-span-12 lg:col-span-4 mt-8 lg:mt-0">
        <?php if ($main_text) : ?>
          <article class="prose">
            <?= $main_text; ?>
          </article>
        <?php endif; ?>
      </div>

    </article>
  </div>
</section>