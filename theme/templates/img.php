<?php
$has_context = !empty($args);

$img = get_sub_field('img');
$txt = get_sub_field('txt');

if ($img || $txt):
  $img_id  = is_array($img) ? $img['ID'] : $img;
?>
  <section class="my-section lg:my-section-lg">
    <div class="container mx-auto px-4">

      <div class="relative overflow-hidden rounded-usp-md">
        <?php if ($img_id): ?>
          <?php echo wp_get_attachment_image($img_id, 'wide-lg', false, [
            'class' => 'w-full h-auto object-contain inset-0',
          ]); ?>
        <?php endif; ?>

        <?php if ($txt): ?>
          <div class="absolute pl-12 pb-16 z-10 bottom-0 left-0 max-w-260">
            <div class="prose prose-white">
              <?php echo $txt; ?>
            </div>
          </div>
        <?php endif; ?>

      </div>

    </div>
  </section>
<?php endif; ?>