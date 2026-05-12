<?php
$logos = get_sub_field('logos');

if ($logos):
  $logo_set = array_merge($logos, $logos);
?>
  <section class="my-section lg:my-section-lg overflow-hidden bg-white relative">
    <div class="flex overflow-hidden">
      <div class="flex flex-none items-center animate-[marquee_40s_linear_infinite] whitespace-nowrap">

        <div class="flex items-center gap-25 pr-25">
          <?php foreach ($logo_set as $logo_id): ?>
            <div class="shrink-0 h-20">
              <?php echo wp_get_attachment_image($logo_id, 'medium', false, [
                'class' => 'h-20 w-auto object-contain'
              ]); ?>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="flex items-center gap-16 pr-16" aria-hidden="true">
          <?php foreach ($logo_set as $logo_id): ?>
            <div class="shrink-0 h-20">
              <?php echo wp_get_attachment_image($logo_id, 'medium', false, [
                'class' => 'h-20 w-auto object-contain'
              ]); ?>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </section>
<?php endif; ?>