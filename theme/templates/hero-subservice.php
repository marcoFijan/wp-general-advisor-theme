<?php
$custom_title = get_field('title');
$intro_text   = get_field('txt');
$image_id     = get_field('img');

$display_title = $custom_title ?: '<h1>' . get_the_title() . '</h1>';
?>

<section class="hero-case bg-linear-to-b from-blue to-blue-dark text-white pt-23 pb-12 rounded-b-hero">
  <div class="container mx-auto">

    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

    <div class="grid grid-cols-12 mb-6 border-b border-stone-medium/30 w-full">
      <div class="col-span-12 lg:col-span-10 prose prose-white mt-5 mb-13">
        <?= $display_title; ?>
      </div>
    </div>

    <div class="grid grid-cols-12 gap-8 mt-6 mb-14">
      <article class="col-span-11 lg:col-span-4 prose prose-white">
        <?php if ($intro_text): ?>
          <?= $intro_text; ?>
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

    <?php if ($image_id): ?>
      <div class="col-span-12">
        <div class="rounded-card overflow-hidden w-full">
          <?php
          echo wp_get_attachment_image($image_id, 'wide-hero', false, [
            'class' => 'w-full h-auto block object-cover',
            'alt'   => strip_tags($display_title)
          ]);
          ?>
        </div>
      </div>
    <?php endif; ?>

  </div>
</section>