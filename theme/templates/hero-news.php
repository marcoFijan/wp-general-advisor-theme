<?php
$queried_object = get_queried_object();

$custom_title = get_field('hero_title', $queried_object);
$intro_text   = get_field('hero_txt', $queried_object);
$image          = get_field('img', $queried_object);

if ($custom_title) {
  $display_title = $custom_title;
} elseif (is_post_type_archive()) {
  $display_title = '<h1>' . post_type_archive_title('', false) . '</h1>';
} elseif (is_tax() || is_category() || is_tag()) {
  $display_title = '<h1>' . single_term_title('', false) . '</h1>';
} else {
  $display_title = '<h1>' . get_the_title() . '</h1>';
}
?>

<section class="pt-23 pb-12 breadcrumb-dark bg-beige">
  <div class="container">
    <div class="grid grid-cols-12 w-full">
      <div class="col-span-12 lg:col-span-10 lg:col-start-2">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
      </div>

      <div class="col-span-12 lg:col-span-10 pb-6 lg:col-start-2  border-b border-stone-medium/30 prose mt-5 mb-8">
        <h1><?= $display_title; ?></h1>
      </div>
    </div>

    <div class="grid grid-cols-12 gap-8 mt-6 mb-4">
      <article class="col-span-11 lg:col-span-6 lg:col-start-2 prose">
        <?php if ($intro_text): ?>
          <?= $intro_text; ?>
        <?php endif; ?>
      </article>

      <div class="col-span-1 col-start-12 lg:col-start-11 flex items-start justify-end">
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
    <?php if ($image): ?>
      <div class="col-span-12 mt-11">
        <div class="rounded-card overflow-hidden w-full">
          <?php
          echo wp_get_attachment_image($image, 'wide-hero', false, [
            'class' => 'w-full h-auto block object-cover',
            'alt'   => strip_tags($display_title)
          ]);
          ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>