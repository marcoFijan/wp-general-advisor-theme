<?php
$has_context = !empty($args);
$advantage_label = $has_context ? ($args['advantage_label'] ?? '') : (get_sub_field('advantage_label') ?: get_field('advantage_label'));
$advantage_txt   = $has_context ? ($args['advantage_txt'] ?? '') : (get_sub_field('advantage_txt') ?: get_field('advantage_txt'));
$advantage_intro = $has_context ? ($args['advantage_intro'] ?? '') : (get_sub_field('advantage_intro') ?: get_field('advantage_intro'));
$advantages      = $has_context ? ($args['advantages'] ?? []) : (get_sub_field('advantages') ?: get_field('advantages'));

if ($advantage_txt || !empty($advantages)): ?>
  <section class="advantage-section my-section lg:my-section-lg">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-0">

        <div class="lg:col-span-5 lg:col-start-2">
          <?php if ($advantage_label): ?>
            <span class="bg-green text-white flex items-center gap-1 w-max rounded-lg py-2 px-3 mb-5 text-1.2xs font-semibold">
              <span class="w-3.5 -rotate-40 -mt-1">
                <?php $path = get_theme_file_path('/assets/media/compass-small.svg');
                if (file_exists($path)) {
                  echo file_get_contents($path);
                } ?>
              </span>
              <?php echo esc_html($advantage_label); ?>
            </span>
          <?php endif; ?>
          <?php if ($advantage_txt): ?>
            <div class="prose max-w-none">
              <?php echo $advantage_txt; ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="lg:col-span-4 lg:col-start-8">
          <article class="rounded-usp-md bg-blue-lighter p-12 prose">
            <?php if ($advantage_intro): ?>
              <section class="mb-6 max-w-none text-black pt-5 px-5">
                <?php echo $advantage_intro; ?>
              </section>
            <?php endif; ?>
            <?php if (!empty($advantages) && is_array($advantages)): ?>
              <ul class="flex flex-col gap-1 compass-blue">
                <?php foreach ($advantages as $advantage):
                  $item = $advantage['advantage_single'] ?? '';
                  if (!$item) continue;
                ?>
                  <li class="flex items-start gap-3 before:ml-xs text-1.2xs before:mt-0.5 bg-white rounded-usp-xs py-2 px-xs before:w-4! before:h-4!">
                    <span class="ml-7 block"><?php echo esc_html($item); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </article>
        </div>

      </div>
    </div>
  </section>
<?php endif; ?>