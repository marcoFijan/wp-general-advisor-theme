<?php
$get_data = function ($field_name) use ($args) {
  if (!empty($args) && array_key_exists($field_name, $args)) {
    return $args[$field_name];
  }
  $sub = get_sub_field($field_name);
  if ($sub !== false && $sub !== null) return $sub;
  return get_field($field_name);
};

$title       = $get_data('featured_cases_title');
$auto_cases  = $get_data('auto_cases');
$service     = $get_data('service');
$bg_color    = $get_data('bg_color') ?: 'blue';
$final_cases = [];
$get_data = function ($field_name) {
  return get_sub_field($field_name) ?: get_field($field_name);
};

if ($auto_cases && $service) {
  $service_id = is_object($service[0]) ? $service[0]->ID : $service[0];

  $all_cases = get_posts(['post_type' => 'case', 'posts_per_page' => -1]);
  $final_cases = array_filter($all_cases, function ($case) use ($service_id) {
    $services = get_field('services', $case->ID);
    if (!$services) return false;
    foreach ($services as $s) {
      $id = is_object($s) ? $s->ID : $s;
      if ((int)$id === (int)$service_id) return true;
    }
    return false;
  });
  $final_cases = array_slice(array_values($final_cases), 0, 6);
} elseif (!$auto_cases) {
  $cases = $get_data('cases');
  if ($cases) {
    $final_cases = array_slice($cases, 0, 6);
  }
}

$count = count($final_cases);
$bg_color_class = ($bg_color === 'blue') ? 'bg-blue' : (($bg_color === 'white') ? 'bg-white' : 'bg-blue');
$text_color_class = ($bg_color === 'blue') ? 'text-white' : 'text-blue';

if ($count > 0) : ?>
  <section class="py-16 lg:py-28 <?= $bg_color_class ?> overflow-hidden">
    <div class="container mb-12 lg:mb-20 lg:mx-14 flex flex-col md:flex-row md:flex-wrap justify-between md:items-end gap-6">
      <?php if ($title) : ?>
        <h2 class=" <?= $text_color_class ?> text-4xl lg:text-6xl font-normal font-heading max-w-3xl leading-tight">
          <?= esc_html($title); ?>
        </h2>
      <?php endif; ?>

      <?php if ($count >= 3) : ?>
        <div class="flex gap-2 mb-4">
          <?php get_template_part('components/button', null, [
            'type'         => 'only-icon',
            'color'        => $bg_color === 'blue' ? 'white' : 'blue',
            'icon'         => 'default',
            'rotation'     => '180deg',
            'iconColor'    => $bg_color === 'blue' ? 'text-blue' : 'text-white',
            'extraClasses' => 'swiper-prev',
          ]); ?>

          <?php get_template_part('components/button', null, [
            'type'         => 'only-icon',
            'color'        => $bg_color === 'blue' ? 'white' : 'blue',
            'icon'         => 'default',
            'rotation'     => '0deg',
            'iconColor'    => $bg_color === 'blue' ? 'text-blue' : 'text-white',
            'extraClasses' => 'swiper-next',
          ]); ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="container">
      <?php if ($count < 3) : ?>
        <div class="grid grid-cols-12 gap-4">
          <?php foreach ($final_cases as $case) :
            $case_id = is_object($case) ? $case->ID : $case; ?>
            <div class="col-span-12 md:col-span-6 lg:col-span-4">
              <?php get_template_part('templates/case-card', null, ['case_id' => $case_id]); ?>
            </div>
          <?php endforeach; ?>
        </div>

      <?php else : ?>
        <div data-swiper="featured-cases" class="swiper overflow-visible lg:-translate-x-[calc(16.666%+0.5rem)]">
          <div class="swiper-wrapper">
            <?php foreach ($final_cases as $case) :
              $case_id = is_object($case) ? $case->ID : $case; ?>
              <div class="swiper-slide  h-auto">
                <?php get_template_part('templates/case-card', null, ['case_id' => $case_id]); ?>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="swiper-pagination relative bottom-0 mt-12"></div>
        </div>

      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>