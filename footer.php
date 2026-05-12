</main>
<?php $queried_object = '';

if (is_post_type_archive('service')) {
  $queried_object = 'service_archive';
} elseif (is_post_type_archive('case')) {
  $queried_object = 'case_archive';
} elseif (is_tax('service_type')) {
  $term = get_queried_object();
  $queried_object = 'term_' . $term->term_id;
} elseif (is_singular('service') || is_singular('case')) {
  $queried_object = get_the_ID();
} else {
  $queried_object = get_queried_object();
}

$show_marque = get_field('show_contact_marque', $queried_object); ?>

<footer class="pb-4 <?php echo ($show_marque) ? 'bg-blue-lighter' : ''; ?>">
  <?php

  if ($show_marque !== false && $show_marque !== null) :
    $contact_slider = get_field('contact_slider', 'option');
    $marque_text    = $contact_slider['txt'] ?? '';
    $primary_link   = $contact_slider['link'] ?? null;

    if ($marque_text || $primary_link) : ?>
      <section class="relative group/marque w-full overflow-hidden py-10 hover-pause">
        <div class="flex w-max animate-marquee group-hover/marque:[animation-play-state:paused]">
          <div class="flex items-center shrink-0">
            <?php for ($i = 0; $i < 2; $i++) : ?>
              <div class="flex items-center gap-10 px-5 shrink-0">
                <div class="w-12 h-12 text-blue shrink-0">
                  <?php
                  $path = get_theme_file_path('/assets/media/compass-large.svg');
                  if (file_exists($path)) {
                    $svg = file_get_contents($path);
                    echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
                  }
                  ?>
                </div>
                <span class="text-blue font-normal font-heading text-3.2xl whitespace-nowrap">
                  <?php echo esc_html($marque_text); ?>
                </span>
                <?php if ($primary_link) : ?>
                  <div class="shrink-0 group ml-4">
                    <?php get_template_part('components/button', null, array(
                      'link'  => $primary_link,
                      'color' => 'green',
                      'type'  => 'without-icon'
                    )); ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endfor; ?>
          </div>

          <div class="flex items-center shrink-0" aria-hidden="true">
            <?php for ($i = 0; $i < 2; $i++) : ?>
              <div class="flex items-center gap-10 px-5 shrink-0">
                <div class="w-12 h-12 text-blue shrink-0">
                  <?php
                  if (file_exists($path)) {
                    echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
                  }
                  ?>
                </div>
                <span class="text-blue font-normal font-heading text-3.2xl whitespace-nowrap">
                  <?php echo esc_html($marque_text); ?>
                </span>
                <?php if ($primary_link) : ?>
                  <div class="shrink-0 group ml-4">
                    <?php get_template_part('components/button', null, array(
                      'link'  => $primary_link,
                      'color' => 'green',
                      'type'  => 'without-icon'
                    )); ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endfor; ?>
          </div>
        </div>
      </section>
  <?php endif;
  endif; ?>

  <?php
  $footer_data = get_field('footer', 'option');
  if ($footer_data) :
    $form_title     = $footer_data['form_title'];
    $form_id        = $footer_data['form'];
    $nav_title      = $footer_data['nav_title'];
    $service_title  = $footer_data['service_title'];
    $sector_title   = $footer_data['sector_title'];
    $contact_title  = $footer_data['contact_title'];
    $mail           = $footer_data['mail'];
    $tel            = $footer_data['tel'];
    $address        = $footer_data['adress'];
    $linkedin       = $footer_data['linkedin_link'];
    $extra_links    = $footer_data['extra_links'];
  ?>
    <div class="bg-blue rounded-card mx-4 py-12 px-8 lg:px-15 text-white">
      <div class="flex flex-col lg:flex-row justify-between gap-20 lg:mr-8">
        <div class="flex items-end gap-1 self-start">
          <div class="w-12 h-12 bg-white rounded-full p-1">
            <?php
            $path = get_theme_file_path('/assets/media/compass-large.svg');
            if (file_exists($path)) {
              $svg = file_get_contents($path);
              echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
            }
            ?>
          </div>
          <span class="font-heading text-5.5xl font-normal leading-none lowercase">gydz</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:flex md:flex-wrap gap-x-20 gap-y-10">

          <div class="flex flex-col gap-2 text-white font-medium text-1.5sm lg:w-auto">
            <span class="block text-white/60"><?= esc_html($nav_title); ?></span>

            <?php
            $footer_items = get_menu('footer');

            if (!empty($footer_items)) : ?>
              <nav class="flex flex-col gap-2">
                <?php foreach ($footer_items as $item) : ?>
                  <a href="<?= esc_url($item['url']); ?>"
                    <?= $item['target'];
                    ?>
                    class="relative w-fit block <?= esc_attr($item['classes']); ?>
                  after:content-[''] after:absolute after:left-0 after:bottom-0 
                  after:h-px after:w-full after:bg-green 
                  after:origin-left after:scale-x-0 after:transition-transform after:duration-300 
                  hover:after:scale-x-100">

                    <?php if ($item['icon']) : ?>
                      <span class="menu-icon"><?= $item['icon']; ?></span>
                    <?php endif; ?>

                    <?= esc_html($item['title']); ?>
                  </a>
                <?php endforeach; ?>
              </nav>
            <?php endif; ?>
          </div>

          <div class="flex flex-col gap-2 text-white font-medium text-1.5sm lg:w-auto">
            <span class="block text-white/60"><?= esc_html($service_title); ?></span>
            <?php
            $service_types = get_terms(array('taxonomy' => 'service_type', 'hide_empty' => false));
            foreach ($service_types as $type) : ?>
              <a href="<?= get_term_link($type); ?>"
                class="group relative w-fit transition-all duration-300">
                <?= esc_html($type->name); ?>
                <span class="absolute left-0 bottom-0 h-px w-full bg-green origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
              </a>
            <?php endforeach; ?>
          </div>

          <div class="flex flex-col gap-2 text-white font-medium text-1.5sm lg:w-auto">
            <span class="block text-white/60"><?= esc_html($sector_title); ?></span>
            <?php
            $sectors = get_posts(array(
              'post_type'      => 'sectors',
              'posts_per_page' => -1,
              'orderby'        => 'title',
              'order'          => 'ASC',
            ));

            if (!empty($sectors)) :
              foreach ($sectors as $post) :
                setup_postdata($post);
            ?>
                <a href="<?= get_permalink($post->ID); ?>" class="group relative w-fit transition-all duration-300">
                  <?= esc_html(get_the_title($post->ID)); ?>
                  <span class="absolute left-0 bottom-0 h-px w-full bg-green origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
                </a>
            <?php endforeach;
              wp_reset_postdata();
            endif; ?>
          </div>

          <address class="flex flex-col gap-2 text-white not-italic font-medium text-1.5sm lg:w-auto">
            <span class="block text-white/60"><?= esc_html($contact_title); ?></span>

            <?php if ($tel) : ?>
              <a href="tel:<?= preg_replace('/[^0-9+]/', '', $tel); ?>"
                class="group relative w-fit transition-all duration-300">
                <?= esc_html($tel); ?>
                <span class="absolute left-0 bottom-0 h-px w-full bg-green origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
              </a>
            <?php endif; ?>

            <?php if ($mail) : ?>
              <a href="mailto:<?= antispambot($mail); ?>"
                class="group relative w-fit transition-all duration-300 overflow-hidden text-ellipsis">
                <?= antispambot($mail); ?>
                <span class="absolute left-0 bottom-0 h-px w-full bg-green origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
              </a>
            <?php endif; ?>

            <?php if ($address) : ?>
              <p class="whitespace-pre-line opacity-80"><?= esc_html($address); ?></p>
            <?php endif; ?>
          </address>

        </div>
      </div>

      <div class="flex flex-col lg:flex-row justify-between lg:items-end gap-10 mb-8 pt-16">
        <div class="w-full md:max-w-78 lg:-mb-4">
          <?php if ($form_title) : ?>
            <span class="flex gap-1 itmes-center mb-md">
              <span class="w-4 h-4 text-green">
                <?php
                $path = get_theme_file_path('/assets/media/compass-green.svg');
                if (file_exists($path)) {
                  $svg = file_get_contents($path);
                  echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
                }
                ?>
              </span>
              <h2 class="text-lg font-heading mb-2 leading-none"><?= esc_html($form_title); ?></h2>
            </span>

          <?php endif; ?>
          <?php
          if ($form_id) {
            echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
          }
          ?>
        </div>

        <div class="flex shrink-0">
          <?php
          if ($linkedin) {
            get_template_part('components/button', null, array(
              'link'  => $linkedin,
              'color' => 'white',
              'icon'  => 'linkedIn',
              'rotation' => '0deg',
              'extraClasses' => '!border-white'
            ));
          }
          ?>
        </div>
      </div>

      <div class="flex flex-col lg:flex-row justify-end sm:items-center gap-x-8 gap-y-4 text-sm">

        <?php if ($extra_links) : ?>
          <div class="flex flex-col sm:flex-row flex-wrap gap-x-6 gap-y-2">
            <div class="flex items-center gap-0.75 mr-auto lg:mr-0 opacity-60">
              <span>&copy;</span>
              <span>Gydz</span>
              <span><?= date('Y'); ?></span>
            </div>
            <?php foreach ($extra_links as $row) :
              $link = $row['link'];
              if ($link) : ?>
                <a class="text-white/60 transition-colors hover:text-white" href="<?= esc_url($link['url']); ?>" target="<?= esc_attr($link['target']); ?>"><?= esc_html($link['title']); ?></a>
            <?php endif;
            endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  <?php endif; ?>
</footer>

<?php wp_footer(); ?>
</body>

</html>