<?php
$testimonial_ids = get_sub_field('testimonials');

if ($testimonial_ids && is_array($testimonial_ids)) : ?>
  <section class="my-12 lg:my-section-lg overflow-x-clip overflow-y-visible testimonial-slider" data-swiper="testimonials">
    <div class="container flex flex-col items-center gap-8">
      <div class="swiper customers-swiper w-full overflow-visible">
        <div class="swiper-wrapper">
          <?php foreach ($testimonial_ids as $testimonial) :
            $p_id = (is_object($testimonial)) ? $testimonial->ID : $testimonial;
            $sector_id   = get_field('sector', $p_id);
            $sector_name = $sector_id ? get_the_title($sector_id) : '';
            $term_id = get_field('customer', $p_id);
            $quote   = get_field('quote', $p_id);

            if (empty($quote)) continue;
            $card_data = [
              'quote'       => $quote,
              'sector_name' => $sector_name,
              'img_id'      => get_field('img', 'klant_' . $term_id),
              'name'        => get_field('author', 'klant_' . $term_id) ?: get_the_title($p_id),
              'company'     => get_field('company', 'klant_' . $term_id),
            ];
          ?>
            <div class="swiper-slide w-76 shrink-0 h-auto">
              <?php get_template_part('components/testimonial-card', null, $card_data); ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="flex flex-col items-center gap-6 w-full">
        <div class="customers-swiper-progressbar w-full max-w-50 h-2 bg-black/10 rounded-full overflow-hidden">
          <div class="customers-swiper-progressbar-fill h-full bg-blue rounded-full w-0 transition-[width] duration-300 ease-out"></div>
        </div>
        <div class="swiper-pagination customers-swiper-pagination"></div>
      </div>
    </div>
  </section>
<?php endif; ?>