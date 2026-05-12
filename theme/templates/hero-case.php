<?php
$custom_title = get_field('title');
$intro_text   = get_field('txt_intro');
$advantages   = get_field('txt_advantages');

$display_title = $custom_title ?: get_the_title();
?>

<section class="hero-case bg-linear-to-b from-blue to-blue-dark text-white pt-23 pb-12 rounded-b-hero">
  <div class="container mx-auto">
    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    <div class="grid grid-cols-12 mb-12 border-b border-stone-medium w-full">
      <div class="col-span-12 lg:col-span-8 md:col-span-10 ">
        <h1 class="text-5xl md:text-8xl font-[425] mt-5 mb-13">
          <?php echo esc_html($display_title); ?>
        </h1>
      </div>
    </div>

    <div class="grid grid-cols-12 gap-8 mt-12">
      <article class="col-span-12 md:col-span-6 prose prose-white">
        <?php if ($intro_text): ?>
          <?php echo $intro_text; ?>
        <?php endif; ?>
      </article>

      <article class="col-span-11 lg:col-span-3 lg:col-start-8 prose prose-white prose-p:mb-0">
        <?php if ($advantages): ?>
          <?php echo $advantages; ?>
        <?php endif; ?>
      </article>
      <div class="col-span-1 lg:col-span-2 flex w-full items-start justify-end">
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
  </div>
</section>