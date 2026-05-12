<?php
get_header(); ?>

<?php get_template_part('templates/flexible-content'); ?>

<?php
$open_vacancy = get_field('open_vacancy', 'vacancy_archive');

if ($open_vacancy):
  $txt        = $open_vacancy['txt'] ?? '';
  $tel_title  = $open_vacancy['tel_title'] ?: 'Bellen';
  $tel        = $open_vacancy['tel'] ?? '';
  $mail_title = $open_vacancy['mail_title'] ?: 'E-mailen';
  $mail       = $open_vacancy['mail'] ?? '';
  $form_id    = $open_vacancy['form'] ?? '';
?>

  <section id="form" class="my-16 bg-white">
    <div class="container mx-auto px-4 grid grid-cols-12 gap-4">
      <div class="col-span-12 lg:col-span-10 lg:col-start-2 grid grid-cols-1 lg:grid-cols-10 gap-x-4 gap-y-12 bg-white py-0 px-0 xl:px-14 lg:py-20 rounded-card">
        <div class="lg:col-span-3 flex flex-col">
          <?php if ($txt): ?>
            <div class="prose mb-12">
              <?= $txt; ?>
            </div>
          <?php endif; ?>
          <div class="flex flex-row flex-wrap lg:flex-col lg:flex-nowrap gap-7">
            <?php if ($tel) : ?>
              <div class="flex flex-col items-start">
                <span class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none">
                  <?= esc_html($tel_title); ?>
                </span>

                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $tel); ?>" class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200">
                  <?= esc_html($tel); ?>
                </a>
              </div>
            <?php endif; ?>
            <?php if ($mail) : ?>
              <div class="flex flex-col items-start">
                <span class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none">
                  <?= esc_html($mail_title); ?>
                </span>
                <a href="mailto:<?= antispambot($mail); ?>" class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200">
                  <?= esc_html($mail); ?>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="lg:col-span-6 lg:col-start-5">
          <?php if ($form_id): ?>
            <div class="w-full">
              <?= do_shortcode('[contact-form-7 id="' . esc_attr($form_id) . '"]'); ?>
            </div>
          <?php else: ?>
            <p class="text-blue/50 italic">Selecteer een formulier in de backend.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>

<?php get_footer(); ?>