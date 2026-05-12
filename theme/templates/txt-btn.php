<?php
$label = get_sub_field('label');
$txt   = get_sub_field('txt');
$link  = get_sub_field('link');

if ($label || $txt || $link) : ?>
  <section class="py-section lg:py-section-lg lg:pb-40 bg-linear-to-b from-white to-beige overflow-hidden">
    <div class="container">
      <div class="grid grid-cols-12 gap-4">

        <article class="col-span-12 lg:col-span-6 lg:col-start-4 flex flex-col items-center text-center">

          <?php if ($label) : ?>
            <span class="block text-1.2xs font-semibold bg-green/20 text-green py-1.5 mb-4 px-3 rounded-lg">
              <?= esc_html($label); ?>
            </span>
          <?php endif; ?>

          <?php if ($txt) : ?>
            <div class="prose mb-4 lg:px-10">
              <?= wp_kses_post($txt); ?>
            </div>
          <?php endif; ?>

          <?php if ($link && is_array($link)) : ?>
            <?php get_template_part('components/button', null, [
              'type'      => 'primary',
              'color'     => 'green',
              'text'      => $link['title'],
              'url'       => $link['url'],
              'target'    => $link['target'] ?: '_self',
              'iconColor' => 'text-blue'
            ]); ?>
          <?php endif; ?>

        </article>

      </div>
    </div>
  </section>
<?php endif; ?>