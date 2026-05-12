<?php
$txt_left  = get_sub_field('txt_left');
$txt_right = get_sub_field('txt_right');
$gallery   = get_sub_field('gallery');

if ($txt_left || $txt_right || $gallery) : ?>
  <section class="py-16 bg-blue overflow-hidden">
    <div class="container mb-9">
      <div class="grid grid-cols-12 gap-8 items-start 2xl:mx-14">
        <div class="col-span-12 lg:col-span-6 prose prose-white">
          <?php if ($txt_left) : ?>
            <?= $txt_left; ?>
          <?php endif; ?>
        </div>

        <div class="col-span-12 lg:col-span-5 lg:col-start-8 flex flex-col gap-8">
          <div class="prose prose-white">
            <?php if ($txt_right) : ?>
              <?= $txt_right; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="w-full flex justify-end">
        <?php if ($gallery && count($gallery) > 1) : ?>
          <div class="flex gap-2">
            <?php get_template_part('components/button', null, [
              'type'         => 'only-icon',
              'color'        => 'white',
              'rotation'     => '180deg',
              'iconColor'    => 'text-blue',
              'extraClasses' => 'swiper-prev',
            ]); ?>

            <?php get_template_part('components/button', null, [
              'type'         => 'only-icon',
              'color'        => 'white',
              'rotation'     => '0deg',
              'iconColor'    => 'text-blue',
              'extraClasses' => 'swiper-next',
            ]); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($gallery) : ?>
      <div class="container">
        <div class="swiper overflow-visible">
          <div class="swiper-wrapper">
            <?php foreach ($gallery as $image_id) : ?>
              <div class="swiper-slide h-auto w-full md:w-90 lg:w-152">
                <div class="rounded-usp-md overflow-hidden w-full">
                  <?php
                  echo wp_get_attachment_image($image_id, 'landscape-slider', false, [
                    'class' => 'w-full h-auto object-cover object-center  aspect-301/241'
                  ]);
                  ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="swiper-pagination relative bottom-0 mt-12"></div>
        </div>
      </div>
    <?php endif; ?>

  </section>
<?php endif; ?>