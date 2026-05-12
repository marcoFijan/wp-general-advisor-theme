<section class="w-full overflow-hidden bg-beige relative py-12 lg:py-20">
  <div class="container mx-auto px-4 2xl:h-90 relative">

    <div class="cards-grid group 
                grid grid-cols-12 gap-4 
                2xl:absolute 2xl:top-0 2xl:left-1/2 2xl:w-[125vw] 2xl:-translate-x-1/2 2xl:flex 2xl:flex-nowrap 2xl:justify-center 2xl:gap-2"
      data-cards-grid>

      <?php if (have_rows('cards')) : ?>
        <?php $card_index = 0; ?>
        <?php while (have_rows('cards')) : the_row();
          $type = get_sub_field('type_card');
        ?>

          <div data-card-item
            class="relative card-item col-span-12 md:col-span-6 lg:col-span-4 2xl:w-[350px] 2xl:shrink-0 
                   <?php echo ($type === 'img') ? 'z-0' : 'z-10'; ?> 
                   transform-[translate(var(--tx,0px),var(--ty,0px))_rotate(var(--rot,0deg))_scale(var(--scale,1))] 
                   transition-[transform] duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] 
                   delay-[calc(var(--card-index)*80ms)] will-change-transform group-[.is-visible]:!transform-none"
            style="--card-index: <?php echo $card_index; ?>;">

            <?php if ($type === 'img') : ?>
              <?php $img = get_sub_field('img');
              if ($img) : ?>
                <div class="card w-full card--image overflow-hidden rounded-card h-full aspect-square shadow-sm">
                  <?php echo wp_get_attachment_image($img['ID'], 'medium', false, [
                    'class'   => 'w-full h-full object-cover block',
                    'loading' => 'lazy',
                  ]); ?>
                </div>
              <?php endif; ?>

            <?php elseif ($type === 'link') :
              $link_card    = get_sub_field('link_card');
              $color        = $link_card['card_color'] ?? '';
              $detailed_img = $link_card['detailed_img'] ?? [];
              $number       = $link_card['number'] ?? '';
              $unit         = $link_card['unit'] ?? '';
              $txt          = $link_card['txt'] ?? '';
              $label        = $link_card['label'] ?? '';

              $link_data = $link_card['link'] ?? '';

              if (is_array($link_data)) {
                $link_url    = $link_data['url'] ?? '#';
                $link_title  = $link_data['title'] ?? '';
                $link_target = $link_data['target'] ?? '_self';
              } else {
                $link_url    = !empty($link_data) ? $link_data : '#';
                $link_title  = '';
                $link_target = '_self';
              }

              $color_classes = [
                'green' => 'bg-green hover:bg-green-dark text-white border-color-white/80',
                'blue'  => 'bg-blue hover:bg-blue-dark text-white border-color-white/80',
                'white' => 'bg-white hover:bg-grey text-blue border-color-blue/80',
              ];
              $color_class = $color_classes[$color] ?? 'bg-white';
            ?>

              <a href="<?php echo esc_url($link_url); ?>"
                target="<?php echo esc_attr($link_target); ?>"
                class="card rounded-card py-6 flex flex-col gap-4 h-full no-underline transition-colors relative z-10 <?php echo esc_attr($color_class); ?>">

                <?php if ($link_title || $label) : ?>
                  <div class="flex items-center justify-between px-6 gap-4">
                    <div class="flex items-center gap-2 flex-wrap">
                      <?php if ($label) : ?>
                        <span class="text-xs font-semibold tracking-wide py-1 px-3 rounded-lg border w-max">
                          <?php echo esc_html($label); ?>
                        </span>
                      <?php endif; ?>

                      <?php if ($link_title) : ?>
                        <span class="text-xs font-semibold tracking-wide py-1 px-3 rounded-lg border w-max">
                          <?php echo esc_html($link_title); ?>
                        </span>
                      <?php endif; ?>
                    </div>

                    <span class="w-4.5 block shrink-0 ml-auto">
                      <?php $path = get_theme_file_path('/assets/media/compass-small.svg');
                      if (file_exists($path)) {
                        echo file_get_contents($path);
                      } ?>
                    </span>
                  </div>
                <?php endif; ?>

                <?php if ($detailed_img) : ?>
                  <div class="mt-auto overflow-hidden rounded-lg">
                    <?php echo wp_get_attachment_image($detailed_img['ID'], 'medium', false, [
                      'class'   => 'w-full h-full object-cover block',
                      'loading' => 'lazy',
                    ]); ?>
                  </div>
                <?php elseif ($number || $unit) : ?>
                  <div class="flex items-baseline gap-1 px-6 mt-auto">
                    <?php if ($number) : ?>
                      <span class="text-5xl <?php echo $unit ? 'font-light' : 'font-regular'; ?>">
                        <?php echo esc_html($number); ?>
                      </span>
                    <?php endif; ?>
                    <?php if ($unit) : ?>
                      <span class="text-2xl font-light"><?php echo esc_html($unit); ?></span>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>

                <?php if ($txt) : ?>
                  <p class="text-sm px-6 font-medium"><?php echo esc_html($txt); ?></p>
                <?php endif; ?>
              </a>
            <?php endif; ?>
          </div>

        <?php $card_index++;
        endwhile; ?>
      <?php endif; ?>

    </div>
  </div>
  </div>
</section>