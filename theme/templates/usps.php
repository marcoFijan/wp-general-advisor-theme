<?php
$bg_image_id = get_sub_field('bg_image');
$title       = get_sub_field('title');
$usps        = get_sub_field('usps');

if ($usps): ?>
  <section class="container my-12 lg:my-12">
    <div class="px-5 sm:px-10 lg:px-0 py-section-lg relative">
      <?php if ($bg_image_id): ?>
        <div class="absolute inset-0 z-0 rounded-card overflow-hidden">
          <?php
          echo wp_get_attachment_image($bg_image_id, 'wide', false, [
            'class' => 'w-full h-full object-cover'
          ]);
          ?>
          <div class="absolute inset-0 bg-black/20"></div>
        </div>
      <?php else: ?>
        <div class="absolute inset-0 bg-blue z-0 rounded-card"></div>
      <?php endif; ?>

      <div class="grid grid-cols-12 gap-x-4">
        <div class="col-span-12 lg:col-span-10 lg:col-start-2 relative z-10 text-white prose prose-white">
          <?php if ($title): ?>
            <h2 class="max-w-184 mb-12 pl-usp-card">
              <?php echo esc_html($title); ?>
            </h2>
          <?php endif; ?>
        </div>
        <div class="col-span-12 lg:col-span-10 lg:col-start-2 flex flex-col mt-12 xl:flex-row gap-4 justify-between relative z-10">
          <?php foreach ($usps as $usp):
            $number   = $usp['number'] ?? '';
            $unit     = $usp['number_unit'] ?? '';
            $unit_pos = $usp['number_unit_position'] ?? 'default';
            $text     = $usp['txt'] ?? '';
          ?>
            <div class="flex-1 bg-white rounded-usp-md p-usp-card flex flex-col gap-9.5 justify-between items-start">
              <?php if ($number): ?>
                <div class="flex text-blue font-heading font-light leading-none">
                  <span class="text-5.5xl">
                    <?php echo esc_html($number); ?>
                  </span>
                  <?php if ($unit): ?>
                    <?php if ($unit_pos === 'top'): ?>
                      <span class="text-2xl ml-1 pt-1">
                        <?php echo esc_html($unit); ?>
                      </span>
                    <?php elseif ($unit_pos === 'bottom'): ?>
                      <span class="text-3xl ml-1 mt-auto pb-1">
                        <?php echo esc_html($unit); ?>
                      </span>
                    <?php else: ?>
                      <span class="text-5.5xl">
                        <?php echo esc_html($unit); ?>
                      </span>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <?php if ($text): ?>
                <div class="prose text-sm text-black prose-p:mb-0 [&_p.font-semibold]:text-md [&_p.font-bold]:text-md"> <?php echo $text; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>