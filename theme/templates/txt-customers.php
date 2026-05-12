<?php
$txt       = get_sub_field('txt');
$customers = get_sub_field('customers');

if ($txt || $customers) : ?>
  <section class="my-12 overflow-hidden" data-swiper="customers">

    <?php if ($txt) : ?>
      <div class="container mb-9">
        <div class="grid grid-cols-12">
          <div class="col-span-12 lg:col-span-6 lg:col-start-4 py-5 prose text-center mx-auto">
            <?= $txt; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($customers) : ?>
      <div class="container flex flex-col items-center gap-8">
        <div class="swiper customers-swiper w-full overflow-visible">
          <div class="swiper-wrapper">
            <?php foreach ($customers as $row) :
              $is_existing = $row['exsisting_testimonial'];
              $card_data = [];

              if ($is_existing && !empty($row['selected_testimonial'])) {
                $p_id        = $row['selected_testimonial'];
                $term_id     = get_field('customer', $p_id);
                $sector_id   = get_field('sector', $p_id);
                $sector_term = get_term($sector_id);

                $card_data = [
                  'quote'       => get_field('quote', $p_id),
                  'sector_name' => ($sector_term && !is_wp_error($sector_term)) ? $sector_term->name : '',
                  'img_id'      => get_field('img', 'klant_' . $term_id),
                  'name'        => get_field('author', 'klant_' . $term_id),
                  'company'     => get_field('company', 'klant_' . $term_id),
                ];
              } else {
                $custom      = $row['custom_testimonial'];
                $sector_id   = $custom['sector'];
                $sector_term = get_term($sector_id);

                $card_data = [
                  'quote'       => $custom['txt'],
                  'sector_name' => ($sector_term && !is_wp_error($sector_term)) ? $sector_term->name : '',
                  'img_id'      => $custom['img'],
                  'name'        => $custom['customer_name'],
                  'company'     => $custom['customer_company'],
                ];
              }
              if (empty($card_data['quote'])) continue;
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

          <?php if (count($customers) > 1) : ?>
            <div class="flex gap-2">
              <?php
              get_template_part('components/button', null, [
                'type'         => 'only-icon',
                'color'        => 'blue',
                'rotation'     => '180deg',
                'iconColor'    => 'text-white',
                'extraClasses' => 'customers-swiper-prev',
              ]);
              get_template_part('components/button', null, [
                'type'         => 'only-icon',
                'color'        => 'blue',
                'rotation'     => '0deg',
                'iconColor'    => 'text-white',
                'extraClasses' => 'customers-swiper-next',
              ]);
              ?>
            </div>
          <?php endif; ?>

          <div class="swiper-pagination customers-swiper-pagination"></div>
        </div>

      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>