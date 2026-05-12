<section class="bg-blue-lighter pb-section lg:pb-section-lg">
  <div class="container grid grid-cols-12 gap-4">
    <div class="bg-white col-span-12 lg:col-span-10 lg:col-start-2 rounded-card grid grid-cols-12 lg:grid-cols-10 gap-4 py-10 lg:py-18">
      <div class="col-span-10 col-start-2 lg:col-span-6 grid grid-cols-10 lg:grid-cols-6 gap-4 lg:col-start-3">

        <?php
        $similar_services_txt = get_sub_field('similar_services_txt') ?: get_field('similar_services_txt');

        if ($similar_services_txt) : ?>
          <article class="col-span-10 lg:col-span-6 prose mb-10">
            <?php echo $similar_services_txt; ?>
          </article>
        <?php endif; ?>

        <?php
        $similar_services = get_sub_field('similar_services_services') ?: get_field('similar_services_services');

        if ($similar_services) :
          foreach ($similar_services as $service_id) : ?>

            <a href="<?php echo esc_url(get_permalink($service_id)); ?>" class="text-black hover:bg-blue transition-colors duration-300 hover:text-white col-span-10 md:col-span-5 lg:col-span-3 w-full flex justify-between items-center bg-blue-lighter p-xs pl-5 rounded-usp-xs">
              <span class="block text-sm font-semibold ">
                <?php echo esc_html(get_the_title($service_id)); ?>
              </span>
              <span class="bg-white rounded-usp-xs p-2  w-7 aspect-square text-black">
                <?php
                $path = get_theme_file_path('/assets/media/compass-small.svg');
                if (file_exists($path)) {
                  $svg = file_get_contents($path);
                  echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
                }
                ?>
              </span>
            </a>

          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>