<?php

$post_id     = $args['post_id'] ?? get_the_ID();
$is_featured = $args['is_featured'] ?? false;
$location = get_field('location', $post_id);
$contract = get_field('contract_hours', $post_id);
$salary   = get_field('salary', $post_id);

$loc_icon    = file_get_contents(get_theme_file_path('/assets/media/location.svg'));
$salary_icon = file_get_contents(get_theme_file_path('/assets/media/salary.svg'));
$time_icon   = file_get_contents(get_theme_file_path('/assets/media/time.svg'));

if ($is_featured) : ?>
  <a href="<?php echo get_permalink($post_id); ?>" class="group/btn bg-white ring-2 ring-offset-2 ring-transparent hover:ring-green rounded-card overflow-hidden grid grid-cols-1 lg:grid-cols-10 h-full transition-all duration-300">
    <div class="lg:col-span-5 p-6 lg:p-10 flex flex-col justify-center">
      <div class="flex flex-wrap gap-2 mb-7">
        <?php if ($location): ?>
          <span class="bg-blue/5 text-blue py-1.5 px-3 rounded-lg text-2xs font-bold uppercase tracking-wider flex items-center gap-1">
            <span class="w-3.5 h-3.5 flex items-center justify-center text-blue fill-current"><?= $loc_icon; ?></span>
            <?= esc_html($location); ?>
          </span>
        <?php endif; ?>
        <?php if ($contract): ?>
          <span class="bg-blue/5 text-blue py-1.5 px-3 rounded-lg text-2xs font-bold uppercase tracking-wider flex items-center gap-1">
            <span class="w-3.5 h-3.5 flex items-center justify-center text-blue fill-current"><?= $time_icon; ?></span>
            <?= esc_html($contract); ?>
          </span>
        <?php endif; ?>
        <?php if ($salary): ?>
          <span class="bg-blue/5 text-blue py-1.5 px-3 rounded-lg text-2xs font-bold uppercase tracking-wider flex items-center gap-1">
            <span class="w-3.5 h-3.5 flex items-center justify-center text-blue fill-current"><?= $salary_icon; ?></span>
            <?= esc_html($salary); ?>
          </span>
        <?php endif; ?>
      </div>

      <h2 class="text-3xl lg:text-4xl text-blue font-heading mb-6"><?php echo get_the_title($post_id); ?></h2>

      <p class="text-black font-medium text-sm mb-16">
        <?php echo get_the_excerpt($post_id); ?>
      </p>

      <div class="mt-auto">
        <?php
        get_template_part('components/button', null, [
          'text' => 'Ontdek de vacature',
          'color' => 'blue',
          'type' => 'with-icon',
          'iconColor' => 'text-green'
        ]);
        ?>
      </div>
    </div>
    <div class="col-span-12 lg:col-span-5 w-full block p-xs">
      <div class="relative overflow-hidden rounded-2xl h-full">
        <?php if (has_post_thumbnail($post_id)) : ?>
          <?php echo get_the_post_thumbnail($post_id, 'thumbnail', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover/btn:scale-105']); ?>
        <?php else : ?>
          <div class="w-full h-full bg-blue/5 flex items-center justify-center text-blue/20 italic">Geen afbeelding</div>
        <?php endif; ?>
      </div>

    </div>

  </a>

<?php else : ?>
  <a href="<?php echo get_permalink($post_id); ?>" class="group/btn ring-2 ring-offset-2 2xl:aspect-11/10 ring-transparent hover:ring-green w-full flex flex-col bg-white rounded-card h-full transition-all duration-300  overflow-hidden">
    <div class="p-5 flex flex-col grow">
      <div class="flex flex-wrap gap-2 mb-6">
        <?php if ($location): ?>
          <span class="bg-blue/5 text-blue py-1.5 px-3 rounded-lg text-2xs font-bold uppercase tracking-wider flex items-center gap-2">
            <span class="w-3.5 h-3.5 flex items-center justify-center text-blue fill-current"><?= $loc_icon; ?></span>
            <?= esc_html($location); ?>
          </span>
        <?php endif; ?>
        <?php if ($contract): ?>
          <span class="bg-blue/5 text-blue py-1.5 px-3 rounded-lg text-2xs font-bold uppercase tracking-wider flex items-center gap-1">
            <span class="w-3.5 h-3.5 flex items-center justify-center text-blue fill-current"><?= $time_icon; ?></span>
            <?= esc_html($contract); ?>
          </span>
        <?php endif; ?>
      </div>

      <h3 class="text-2xl lg:text-3xl text-blue font-heading mb-4"><?php echo get_the_title($post_id); ?></h3>

      <div class="mt-auto flex justify-between items-center">
        <span class="text-blue font-bold text-sm">Bekijk vacature</span>
        <?php
        get_template_part('components/button', null, [
          'type' => 'only-icon',
          'color' => 'blue',
          'rotation' => '0deg'
        ]);
        ?>
      </div>
    </div>
  </a>
<?php endif; ?>