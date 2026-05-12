<?php
$testimonial_ids = get_sub_field('testimonials');
$focus_text      = get_sub_field('focus');

if ($testimonial_ids) : ?>
  <section class="bg-beige overflow-hidden relative">
    <div class="container mx-auto px-4 relative py-section lg:py-40 <?php echo ($focus_text) ? 'pb-60 2xl:pb-40' : ''; ?>">
      <div class="grid grid-cols-12" data-tabs-container>

        <div class="col-span-12 lg:col-span-3 lg:col-start-2 flex flex-col gap-2.5 lg:mx-7.5">
          <?php foreach ($testimonial_ids as $index => $post_id) :
            $term_id = get_field('customer', $post_id);
            $icon    = get_field('img', 'klant_' . $term_id);
            $company = get_field('company', 'klant_' . $term_id);
            $is_active = ($index === 0);
          ?>
            <button
              data-tab-index="<?php echo $index; ?>"
              class="tab-trigger group flex cursor-pointer items-center gap-2.5 p-2.5 pr-5 w-full transition-all duration-300 text-left rounded-xl bg-transparent ring-2 ring-transparent hover:ring-white aria-selected:bg-white"
              aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">

              <?php if ($icon) : ?>
                <div class="w-12.5 h-12.5 rounded-full overflow-hidden bg-white shrink-0 group-aria-selected:border-blue/10 border border-transparent">
                  <?php echo wp_get_attachment_image($icon, 'thumbnail', false, [
                    'class' => 'w-full h-full object-cover'
                  ]); ?>
                </div>
              <?php endif; ?>

              <span class="font-normal font-heading text-base">
                <?php echo esc_html($company ?: get_the_title($post_id)); ?>
              </span>

              <span class="text-base font-heading ml-auto font-normal text-blue-light">
                <?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
              </span>
            </button>
          <?php endforeach; ?>
        </div>

        <div class="col-span-12 lg:col-span-6 lg:col-start-6 lg:mx-7.5 mt-10 lg:mt-0">
          <?php foreach ($testimonial_ids as $index => $post_id) :
            $quote   = get_field('quote', $post_id);
            $term_id = get_field('customer', $post_id);

            $icon    = get_field('img', 'klant_' . $term_id);
            $author  = get_field('author', 'klant_' . $term_id);
            $company = get_field('company', 'klant_' . $term_id);

            $is_active = ($index === 0);
          ?>
            <div
              id="tab-content-<?php echo $index; ?>"
              data-tab-content="<?php echo $index; ?>"
              class="tab-content space-y-8 transition-opacity relative duration-300 aria-hidden:opacity-0 aria-hidden:invisible aria-hidden:absolute"
              aria-hidden="<?php echo $is_active ? 'false' : 'true'; ?>">

              <h2 class="text-3xl md:text-5xl font-light leading-normal text-black">
                "<?php echo esc_html($quote); ?>"
              </h2>

              <div class="flex items-center gap-4">
                <?php if ($icon) : ?>
                  <div class="w-12.5 h-12.5 rounded-full overflow-hidden bg-white shrink-0 border border-transparent">
                    <?php echo wp_get_attachment_image($icon, 'thumbnail', false, [
                      'class' => 'w-full h-full object-cover'
                    ]); ?>
                  </div>
                <?php endif; ?>
                <div>
                  <p class="font-normal text-md text-black leading-none font-heading">
                    <?php echo esc_html($author); ?>
                  </p>
                  <p class="text-black/40 mt-1 text-sm font-normal font-heading">
                    <?php echo esc_html($company); ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <?php if ($focus_text) : ?>
        <div class="absolute bottom-10 right-10 lg:bottom-20 lg:right-20 max-w-40 rotate-8 pointer-events-none">
          <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 lg:w-30 lg:h-30 text-green mb-2" fill="none" viewBox="0 0 118 118">
              <g clip-path="url(#a)">
                <path fill="currentColor" d="m23.253.54-1.485 3.768-2.129.782c6.196.772 6.994 10.906 12.3 14.347 1.6 1.036 2.334-.95 1.92-1.69-.1-.182-2.101-1.23-3.14-2.764-.883-1.32-5.234-7.34-3.997-8.366 15.394 4.95 29.01 11.814 40.971 22.835 24.38 22.44 33.297 55.498 29.018 88.045C108.82 70.668 78.123 21.243 33.027 6.88c1.637-2.445 9.651 2.259 9.982-2.108L23.264.542z" />
              </g>
              <defs>
                <clipPath id="a">
                  <path fill="transparent" d="M0 96.783 20.73 0l96.782 20.73-20.73 96.783z" />
                </clipPath>
              </defs>
            </svg>
            <span class="inline-flex rotate-5 items-center text-center text-green font-regular text-3.2xl text-logimas leading-tight font-logimas">
              <?php echo esc_html($focus_text); ?>
            </span>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>