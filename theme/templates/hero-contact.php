<?php
$queried_object = get_queried_object_id();
$intro_txt      = get_field('intro_txt', $queried_object);
$txt            = get_field('txt', $queried_object);
$tel_title      = get_field('tel_title', $queried_object);
$tel            = get_field('tel', $queried_object);
$mail_title     = get_field('mail_title', $queried_object);
$mail           = get_field('mail', $queried_object);
$address_title  = get_field('address_title', $queried_object);
$address        = get_field('address', $queried_object);
$address_link   = get_field('address_link', $queried_object);
$img_id         = get_field('img', $queried_object);
$hidden_mobile  = get_field('hidden_mobile', $queried_object);

$display_title  = '<h1>' . get_the_title($queried_object) . '</h1>';
?>

<section class="container pt-23 pb-12">

  <div class="grid grid-cols-12">
    <div class="col-span-12 lg:col-span-10 lg:col-start-2">
      <div class="flex justify-center mb-6 breadcrumb-dark-no-bg">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
      </div>

      <div class="flex flex-col items-center text-center mb-12 pb-8">
        <?php if ($intro_txt): ?>
          <div class="prose mb-2">
            <?= $intro_txt; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="grid grid-cols-12 gap-8 lg:gap-10 mt-6 mb-12">
        <article class="col-span-12 lg:col-span-6 flex flex-col gap-8 lg:mt-4">
          <?php if ($txt): ?>
            <article class="prose max-w-none">
              <?= $txt; ?>
            </article>
          <?php endif; ?>
          <div class="flex flex-col gap-y-8">
            <?php if ($tel): ?>
              <div class="flex flex-col items-start">
                <span class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none">
                  <?= esc_html($tel_title); ?>
                </span>
                <a href="tel:<?= preg_replace('/[^0-9]/', '', $tel); ?>" class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200">
                  <?= esc_html($tel); ?>
                </a>
              </div>
            <?php endif; ?>

            <?php if ($mail): ?>
              <div class="flex flex-col items-start">
                <span class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none">
                  <?= esc_html($mail_title); ?>
                </span>
                <a href="mailto:<?= antispambot($mail); ?>" class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200">
                  <?= esc_html($mail); ?>
                </a>
              </div>
            <?php endif; ?>

            <?php if ($address): ?>
              <div class="flex flex-col items-start">
                <span class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none">
                  <?= esc_html($address_title); ?>
                </span>
                <?php if ($address_link): ?>
                  <a href="<?= esc_url($address_link); ?>" target="_blank" rel="noopener" class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200">
                    <?= nl2br(esc_html($address)); ?>
                  </a>
                <?php else: ?>
                  <span class="inline-block text-black font-semibold text-1.5sm">
                    <?= nl2br(esc_html($address)); ?>
                  </span>
                <?php endif; ?>
              </div>
            <?php endif; ?>

          </div>
        </article>

        <div class="col-span-12 lg:col-span-6 block lg:ml-10">
          <?php if ($img_id): ?>
            <div class="w-full rounded-card overflow-hidden">
              <?= wp_get_attachment_image($img_id, 'portrait-xl', false, ['class' => 'w-full h-auto object-cover']); ?>
            </div>
          <?php endif; ?>
        </div>

      </div>

    </div>
  </div>

</section>