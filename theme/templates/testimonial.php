<?php
$testimonial_ids = get_sub_field('testimonials');

if ($testimonial_ids && !is_array($testimonial_ids)) {
  $testimonial_ids = [$testimonial_ids];
}

if ($testimonial_ids): ?>
  <section class="my-section lg:my-section-lg bg-white">
    <div class="container mx-auto px-4">
      <div class="flex flex-col gap-16 lg:gap-24">

        <?php foreach ($testimonial_ids as $post_id):
          $quote = get_field('quote', $post_id);
          $term_id = get_field('customer', $post_id);

          $icon    = get_field('img', 'klant_' . $term_id);
          $author  = get_field('author', 'klant_' . $term_id);
          $company = get_field('company', 'klant_' . $term_id);

          if (empty($quote)) continue;
        ?>

          <div class="grid grid-cols-12">
            <div class="col-span-12 md:col-span-10 md:col-start-2 lg:col-span-6 lg:col-start-4">

              <blockquote class="text-center text-black mx-10">
                <p class="text-2xl lg:text-4xl font-medium text-black mb-8 leading-normal">
                  <?= esc_html($quote); ?>
                </p>

                <footer class="flex items-center justify-center gap-4">
                  <?php if ($icon): ?>
                    <div class="w-14 h-14 rounded-full overflow-hidden bg-white shrink-0 border border-blue/10">
                      <?= wp_get_attachment_image($icon, 'thumbnail', false, [
                        'class' => 'w-full h-full object-cover'
                      ]); ?>
                    </div>
                  <?php endif; ?>

                  <div class="text-left">
                    <cite class="block not-italic font-heading text-base font-medium text-black leading-tight">
                      <?= esc_html($author ?: get_the_title($post_id)); ?>
                    </cite>

                    <?php if ($company): ?>
                      <span class="block font-heading text-sm font-normal text-black/40">
                        <?= esc_html($company); ?>
                      </span>
                    <?php endif; ?>
                  </div>
                </footer>
              </blockquote>

            </div>
          </div>

        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>