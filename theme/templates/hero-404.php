<section class="pt-23 pb-56">
  <div class="container mx-auto grid grid-cols-12">
    <div class="col-span-12 lg:col-span-6 lg:col-start-4 text-center">
      <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

      <article class="prose prose-white my-5">
        <?php the_field('txt', 'options_404'); ?>
      </article>

      <div class="mt-12">
        <?php
        get_template_part('components/button', null, array(
          'text' => 'Terug naar de homepage',
          'link'  => home_url('/'),
          'color' => 'white',
        ));
        ?>

      </div>
    </div>
</section>