<?php
$txt_left    = get_sub_field('txt_left');
$txt_right   = get_sub_field('txt_right');
$employees   = get_sub_field('employees');
$intro_title = get_sub_field('intro_title');
$intro_txt   = get_sub_field('intro_txt');
$link        = get_sub_field('link');

if ($txt_left || $txt_right || $employees || $intro_title) : ?>
  <section class="my-12 overflow-hidden">
    <div class="container mb-9">
      <div class="grid grid-cols-12 gap-8 items-start 2xl:mx-14">
        <div class="col-span-12 lg:col-span-6 prose">
          <?php if ($txt_left) : ?>
            <?= $txt_left; ?>
          <?php endif; ?>
        </div>

        <div class="col-span-12 lg:col-span-5 lg:col-start-8 flex flex-col gap-8">
          <div class="prose">
            <?php if ($txt_right) : ?>
              <?= $txt_right; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="w-full flex justify-center md:justify-end mt-4">
        <?php if ($employees && count($employees) > 1) : ?>
          <div class="flex gap-2">
            <?php get_template_part('components/button', null, [
              'type'         => 'only-icon',
              'color'        => 'blue',
              'rotation'     => '180deg',
              'iconColor'    => 'text-white',
              'extraClasses' => 'swiper-prev',
            ]); ?>

            <?php get_template_part('components/button', null, [
              'type'         => 'only-icon',
              'color'        => 'blue',
              'rotation'     => '0deg',
              'iconColor'    => 'text-white',
              'extraClasses' => 'swiper-next',
            ]); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($employees || $intro_title || $intro_txt) : ?>
      <div class="container flex flex-col-reverse lg:flex-row gap-4">
        <?php if ($intro_title || $intro_txt || $link) : ?>
          <div class="shrink-0 h-auto w-full lg:w-98 inline-block relative z-20 after:hidden lg:after:block after:bg-white after:w-screen after:h-full after:absolute after:top-0 after:z-10 after:right-30">
            <div class="relative z-30 rounded-usp-md overflow-hidden bg-blue prose prose-white p-6 lg:aspect-[24/29.5] flex flex-col justify-between">
              <?php if ($intro_title) : ?>
                <div class="text-1.5xl font-semibold mb-4">
                  <?= esc_html($intro_title); ?>
                </div>
              <?php endif; ?>

              <div class="mt-auto flex flex-col items-start gap-4">
                <?php if ($intro_txt) : ?>
                  <div class="text-md font-medium">
                    <?= nl2br(esc_html($intro_txt)); ?>
                  </div>
                <?php endif; ?>

                <?php if ($link) : ?>
                  <?php get_template_part('components/button', null, [
                    'type'  => 'without-icon',
                    'color' => 'ghost-light',
                    'link'  => $link
                  ]); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="w-full">
          <div class="block">
            <div class="swiper min-w-0 flex-1 overflow-visible">
              <div class="swiper-wrapper">
                <?php if ($employees) :
                  $double_employees = array_merge($employees, $employees);

                  foreach ($double_employees as $post_id) :
                    $name     = get_the_title($post_id);
                    $job      = get_field('jobtitle', $post_id);
                    $img_data = get_field('img', $post_id);
                    $image_id = $img_data['id'] ?? '';
                    $linkedin = get_field('linkedin_url', $post_id);
                    $email    = get_field('mail', $post_id);
                ?>
                    <div class="swiper-slide h-auto w-full md:w-80 lg:w-98">
                      <div class="relative rounded-usp-md overflow-hidden bg-blue-lighter pt-6 aspect-[24/29.5]">
                        <?php if ($image_id) : ?>
                          <?= wp_get_attachment_image($image_id, 'portrait', false, [
                            'class' => 'w-full h-full block object-cover'
                          ]); ?>
                        <?php endif; ?>

                        <div class="absolute inset-0 flex flex-col justify-end p-6 bg-linear-to-t from-black/40 via-transparent to-transparent">
                          <div class="flex justify-between items-end w-full gap-2">
                            <div class="flex flex-col items-start gap-1">
                              <div class="flex gap-1 shrink-0">
                                <?php if ($name) : ?>
                                  <span class="text-white text-1.2xs font-semibold leading-tight p-1.5 pr-4 bg-blue rounded-full flex gap-1.5 justify-start items-center w-max">
                                    <div class="bg-white rounded-full aspect-square w-[1.6rem] flex items-center justify-center overflow-hidden text-blue">
                                      <?php
                                      $compass_path = get_theme_file_path('/assets/media/compass-large.svg');
                                      if (file_exists($compass_path)) {
                                        echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full p-1"', file_get_contents($compass_path));
                                      }
                                      ?>
                                    </div>
                                    <?= esc_html($name); ?>
                                  </span>
                                <?php endif; ?>
                                <?php if ($linkedin) : ?>
                                  <a href="<?= esc_url($linkedin); ?>" target="_blank" class="w-10 h-10 p-2.5 rounded-full bg-white flex items-center justify-center text-green hover:bg-green hover:text-white transition-all duration-200">
                                    <?php
                                    $li_path = get_theme_file_path('/assets/media/linkedIn.svg');
                                    if (file_exists($li_path)) {
                                      echo file_get_contents($li_path);
                                    }
                                    ?>
                                  </a>
                                <?php endif; ?>
                                <?php if ($email) : ?>
                                  <a href="mailto:<?= antispambot($email); ?>" class="w-10 h-10 rounded-full bg-white flex items-center justify-center stroke-white hover:stroke-green text-green hover:bg-green hover:text-white transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5" viewBox="0 0 15 15" fill="none">
                                      <path d="M15 1.97377H0.000244141V13.0262H15V1.97377Z" fill="currentColor" stroke-miterlimit="10" />
                                      <path d="M0.000244141 1.97377L7.50012 7.5L15 1.97377" fill="currentColor" />
                                      <path d="M0.000244141 1.97377L7.50012 7.5L15 1.97377" stroke-miterlimit="10" />
                                    </svg>
                                  </a>
                                <?php endif; ?>
                              </div>

                              <?php if ($job) : ?>
                                <p class="text-white/90 text-1.2xs px-2.5 font-semibold mt-1">
                                  <?= esc_html($job); ?>
                                </p>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <div class="swiper-pagination relative bottom-0"></div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>