<?php
$term = $args['term'] ?? get_queried_object();
$display_title = get_field('title', $term) ?: '<h1>' . single_term_title('', false) . '</h1>';
$text          = get_field('txt', $term);
$intro_text   = get_field('txt_intro', $term);
$img_text     = get_field('txt_img', $term);
$image_id     = get_field('img', $term);
$advantages   = get_field('txt_advantages', $term);
$usps         = get_field('usps', $term);

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
        <?php if ($text): ?>
          <?= $text; ?>
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
        <div class="rounded-card overflow-hidden w-full relative">
          <?php
          echo wp_get_attachment_image($image_id, 'wide-hero', false, [
            'class' => 'w-full h-auto block object-cover',
            'alt'   => strip_tags($display_title)
          ]);
          ?>
          <?php if ($img_text): ?>
            <article class="absolute bottom-0 left-0 right-0 p-6 lg:p-9 from-black/80 prose prose-white max-w-170 to-transparent">
              <h2><?php echo $img_text; ?></h2>
            </article>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-12 gap-6 lg:gap-y-0 mt-22">
      <article class="col-span-12 lg:col-span-5 lg:col-start-2 prose prose-white">
        <?php if ($intro_text): ?>
          <?php echo $intro_text; ?>
        <?php endif; ?>
      </article>

      <article class="col-span-12 lg:col-start-8 lg:col-span-4  prose prose-white text-black prose-p:mb-0">
        <?php if ($advantages): ?>
          <?php echo $advantages; ?>
        <?php endif; ?>
      </article>
      <?php
      if ($usps) : ?>
        <div class="col-span-12 lg:col-span-10 lg:col-start-2 flex flex-col lg:flex-row gap-4 mt-section lg:mt-section-lg ">
          <?php
          foreach ($usps as $usp):
            $number = $usp['number'] ?? '';
            $text   = $usp['txt'] ?? ''; ?>
            <div class=" bg-white/5 text-white prose prose-white rounded-usp-md p-usp-card flex flex-col gap-9.5 justify-between items-start">
              <?php if ($number): ?>
                <span class="text-5.5xl font-heading font-light">
                  <?php echo esc_html($number); ?>
                </span>
              <?php endif; ?>

              <?php if ($text): ?>
                <div class="prose">
                  <?php echo $text; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>