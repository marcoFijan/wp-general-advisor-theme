<?php

/**
 * Steps Component (Stappenplan)
 */

$has_context = !empty($args);

$text       = $has_context ? ($args['txt'] ?? '') : (get_sub_field('txt') ?: get_field('txt'));
$steps_list = $has_context ? ($args['steps'] ?? []) : (get_sub_field('steps') ?: get_field('steps'));

if ($text || !empty($steps_list)):
  $total_steps = is_array($steps_list) ? count($steps_list) : 0;
?>
  <section class="steps-section my-section relative z-0 lg:my-section-lg after:content-[''] after:absolute after:bg-beige after:left-0 after:top-0 after:w-full after:h-full after:-z-20" data-steps-container>
    <div class="pointer-events-none absolute inset-0 -z-10 bg-linear-to-b from-white to-beige h-176"></div>
    <div class="container mx-auto px-4">

      <div class="relative w-full pb-24 pt-16 lg:pb-32 flex flex-col">
        <?php if ($text): ?>
          <div class="relative z-20 max-w-120 mx-auto w-full mb-4">
            <div class="prose text-center">
              <?php echo $text; ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="grid items-start grid-cols-12 gap-4 relative z-10">
          <?php if ($total_steps > 0): ?>
            <div class="sticky grow lg:grow-0 top-0 z-20 flex flex-row gap-4 overflow-x-auto py-4 col-span-12 lg:col-span-1 lg:top-[50vh] lg:-translate-y-1/2 lg:flex-col lg:overflow-visible lg:bg-transparent lg:py-0">
              <?php for ($i = 0; $i < $total_steps; $i++): ?>
                <div
                  class="flex lg:aspect-square shrink-0 items-center size-10 lg:size-auto lg:w-max font-heading justify-center rounded-usp-md bg-white p-3 text-1.5xl font-normal text-gray-900 ring-1 ring-gray-100 transition-all duration-300 <?php echo $i === 0 ? 'scale-110 opacity-100 ' : 'opacity-30'; ?>"
                  data-step-tracker
                  data-step="<?php echo $i; ?>">
                  <?php echo $i + 1; ?>
                </div>
              <?php endfor; ?>
            </div>

            <div class="flex w-full flex-col gap-4 col-span-12 lg:col-span-10 lg:col-start-2">

              <?php foreach ($steps_list as $index => $step):
                $step_txt          = $step['content']['txt'] ?? '';
                $relevant_services = $step['content']['relevant_services'] ?? [];
                $step_img          = $step['img'] ?? '';

                if (!$step_txt && !$step_img) continue;

                $variant         = $index % 3;
                $card_classes    = '';
                $counter_classes = '';
                $prose_classes   = '';
                $link_bg_class   = ($variant === 0) ? 'bg-blue-lightest' : 'bg-white';

                if ($variant === 0) {
                  $card_classes    = 'bg-white';
                  $counter_classes = 'text-black';
                  $prose_classes   = 'text-black prose-headings:text-green prose-p:text-black prose-strong:text-black';
                } elseif ($variant === 1) {
                  $card_classes    = 'bg-blue';
                  $counter_classes = 'text-green';
                  $prose_classes   = 'text-white prose-headings:text-white prose-p:text-white prose-strong:text-white';
                } else {
                  $card_classes    = 'bg-green';
                  $counter_classes = 'text-blue';
                  $prose_classes   = 'text-white prose-headings:text-blue prose-p:text-white prose-strong:text-white';
                }
              ?>

                <div
                  class="sticky flex w-full flex-col rounded-usp-md p-8 transition-all duration-300 md:p-12 <?php echo $card_classes; ?> top-(--mobile-top) lg:top-(--desktop-top)"
                  style="--mobile-top: <?php echo 7 + $index; ?>rem; --desktop-top: <?php echo ($index * 1.5) + 7; ?>rem;"
                  data-step-card
                  data-step="<?php echo $index; ?>">
                  <div class="grid w-full flex-1 grid-cols-1 gap-4 <?php echo $step_img ? 'lg:grid-cols-10' : ''; ?>">
                    <div class="flex h-full w-full flex-col justify-between <?php echo $step_img ? 'lg:col-span-5' : ''; ?>">
                      <div class="mb-8 flex w-full items-center gap-4 text-md font-semibold <?php echo $counter_classes; ?>">
                        <span class="shrink-0">Stap <?php echo $index + 1; ?></span>
                        <div class="w-20 border-t-2 border-current opacity-40"></div>
                        <span class="shrink-0"><?php echo $total_steps; ?></span>
                      </div>

                      <div class="prose max-w-none <?php echo $prose_classes; ?>">
                        <?php if ($step_txt): ?>
                          <article><?php echo $step_txt; ?></article>
                        <?php endif; ?>

                        <?php if (!empty($relevant_services) && is_array($relevant_services)): ?>
                          <div class="not-prose mt-8 flex flex-wrap gap-2">
                            <?php foreach ($relevant_services as $service_id):
                              $service_title = get_the_title($service_id);
                              $service_link  = get_permalink($service_id);
                              if ($service_title && $service_link):
                            ?>
                                <a
                                  href="<?php echo esc_url($service_link); ?>"
                                  class="inline-flex items-center rounded-label <?php echo $link_bg_class; ?> text-blue px-4 py-1.5 text-sm font-bold transition-opacity hover:opacity-70">
                                  <?php echo esc_html($service_title); ?>
                                </a>
                            <?php
                              endif;
                            endforeach; ?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>

                    <?php if ($step_img): ?>
                      <div class="hidden w-full lg:block col-span-4 col-start-7">
                        <?php echo wp_get_attachment_image($step_img, 'portrait-lg', false, [
                          'class' => 'w-full h-auto rounded-usp-md'
                        ]); ?>
                      </div>
                    <?php endif; ?>

                  </div>

                </div>

              <?php endforeach; ?>

            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>
<?php endif; ?>