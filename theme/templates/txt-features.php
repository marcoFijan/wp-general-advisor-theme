<?php
$intro_text = $args['txt'] ?? get_sub_field('txt');
$features   = $args['features'] ?? get_sub_field('features');
$is_nested  = $args['is_nested'] ?? false;

$wrapper_start = $is_nested ? '' : '<section class="my-section lg:my-section-lg"><div class="container mx-auto px-4">';
$wrapper_end   = $is_nested ? '' : '</div></section>';
?>

<?= $wrapper_start; ?>

<div class="grid grid-cols-1 md:grid-cols-12 gap-4 <?php echo $is_nested ? 'w-full' : ''; ?>">

  <?php if ($intro_text): ?>
    <div class="col-span-1 md:col-span-12 lg:col-span-10 lg:col-start-2 prose max-w-none mb-12">
      <?php echo wp_kses_post($intro_text); ?>
    </div>
  <?php endif; ?>

  <?php if ($features): ?>
    <div class="col-span-1 md:col-span-12 grid grid-cols-1 md:grid-cols-12 gap-y-8 md:gap-y-12 items-start">
      <?php foreach ($features as $feature): ?>
        <div class="col-span-1 md:col-span-12 grid grid-cols-1 md:grid-cols-12 gap-4">

          <div class="col-span-1 md:col-span-4 lg:col-span-3 lg:col-start-2 prose">
            <?php echo wp_kses_post($feature['title']); ?>
          </div>

          <div class="col-span-1 md:col-span-8 lg:col-span-5 lg:col-start-5 prose prose-slate">
            <?php echo wp_kses_post($feature['txt']); ?>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</div>

<?= $wrapper_end; ?>