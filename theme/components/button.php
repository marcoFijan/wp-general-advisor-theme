<?php
$color        = $args['color']        ?? 'green';
$type         = $args['type']         ?? 'with-icon';
$link_arg     = $args['link']         ?? $args['url'] ?? null;
$iconType     = $args['icon']         ?? 'default';
$iconColor    = $args['iconColor']    ?? 'text-white';
$rotation     = $args['rotation']     ?? '-40deg';
$text         = $args['text']         ?? 'Button Text';
$customIcon   = $args['customIcon']   ?? '';
$target       = $args['target']       ?? '_self';
$extraClasses = $args['extraClasses'] ?? '';
$data         = $args['data']         ?? [];

$url = null;
if (is_array($link_arg)) {
  $url    = $link_arg['url']    ?? null;
  $text   = $link_arg['title']  ?? $text;
  $target = $link_arg['target'] ?? $target;
} elseif (is_string($link_arg) && !empty($link_arg)) {
  $url = $link_arg;
}

$colorClasses = [
  'green'         => 'bg-green text-white border-transparent',
  'blue'          => 'bg-blue text-white border-transparent',
  'white-border'  => 'bg-white text-blue border-gray-200',
  'white'         => 'bg-white text-blue border-0',
  'white-outline' => 'bg-white text-blue border-stone-medium/30',
  'ghost-light'   => 'bg-transparent text-white border-grey',
  'ghost-dark'    => 'bg-transparent text-blue border-stone-medium/30',
];

$iconColorMap = [
  'green'         => 'text-white',
  'blue'          => 'text-white',
  'white'         => 'text-blue',
  'white-outline' => 'text-blue',
  'ghost-light'   => 'text-white',
  'ghost-dark'    => 'text-blue',
];

$iconColor = $args['iconColor'] ?? ($color === 'blue' && $type === 'with-icon' ? 'text-green' : ($iconColorMap[$color] ?? 'text-white'));
$activeColor = $colorClasses[$color] ?? $colorClasses['green'];

$hasText = ($type !== 'only-icon');
$hasIcon = ($type !== 'without-icon');

$overlayColor   = ($color === 'blue') ? 'after:bg-white/10' : 'after:bg-black/10';
$overlayClasses = "relative after:absolute after:inset-0 " . $overlayColor . " after:opacity-0 group-hover/btn:after:opacity-100 after:transition-opacity after:duration-300 after:rounded-[inherit] after:pointer-events-none";

if ($type === 'only-icon') {
  $iconContainerStyles = 'p-3 flex items-center justify-center rounded-button border transition-colors ' . $activeColor . ' ' . $overlayClasses;
  $iconInnerStyles     = 'w-5 h-5 relative z-10 [&>svg]:w-full [&>svg]:h-full [&>svg]:block';
} else {
  $iconContainerStyles = 'flex items-center justify-center aspect-square h-full min-w-[2.9rem] rounded-button border transition-colors ' . $activeColor . ' ' . $overlayClasses;
  $iconInnerStyles     = 'w-[1.313rem] aspect-square relative z-10 [&>svg]:w-full [&>svg]:h-full [&>svg]:block';
}

$data_str = '';
if (!empty($data)) {
  foreach ($data as $key => $val) {
    $data_str .= sprintf(' data-%s="%s"', esc_attr($key), esc_attr($val));
  }
}

$tag = $url ? 'a' : 'button';
$baseClasses = 'inline-flex hover:no-underline no-underline shrink-0 group/btn items-stretch overflow-hidden rounded-button transition-all duration-200 cursor-pointer ' . $extraClasses;
$extraAttrs  = $url
  ? sprintf('href="%s" target="%s"%s', esc_url($url), esc_attr($target), ($target === '_blank' ? ' rel="noopener noreferrer"' : ''))
  : 'type="button"';
?>

<<?php echo $tag; ?> <?php echo $extraAttrs; ?> <?php echo $data_str; ?> class="<?php echo $baseClasses; ?>">

  <?php if ($hasText): ?>
    <div class="flex items-center justify-center! px-6 py-3 font-semibold text-base border leading-none <?php echo $activeColor; ?> rounded-button transition-colors <?php echo $overlayClasses; ?> whitespace-nowrap">
      <span class="relative z-10 leading-[normal] no-underline!"><?php echo esc_html($text); ?></span>
    </div>
  <?php endif; ?>

  <?php if ($hasIcon): ?>
    <div class="<?php echo $iconContainerStyles; ?>">
      <div class="flex shrink-0 items-center justify-center <?php echo $iconInnerStyles; ?> <?php echo $iconColor; ?>">

        <?php if ($iconType === 'plus'): ?>
          <div class="relative w-4 h-4" style="transform: rotate(<?php echo $rotation; ?>);">
            <div class="absolute inset-0 m-auto w-full h-0.5 bg-current"></div>
            <div class="absolute inset-0 m-auto h-full w-0.5 bg-current"></div>
          </div>

        <?php elseif ($iconType === 'linkedIn'): ?>
          <div style="transform: rotate(<?php echo $rotation; ?>);">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" class="w-full h-full">
              <path fill="currentColor" d="M23.617 0H2.383A2.403 2.403 0 0 0 0 2.383v21.234A2.403 2.403 0 0 0 2.383 26h21.234A2.4 2.4 0 0 0 26 23.617V2.383A2.4 2.4 0 0 0 23.617 0M7.584 21.667H3.25V9.747h4.334zM5.417 8.342A2 2 0 0 1 3.405 5.57a2.02 2.02 0 0 1 2.012-1.239 2 2 0 0 1 2.011 2.77 2.02 2.02 0 0 1-2.011 1.24M22.75 21.667h-4.333V15.17c0-1.733-1.192-2.166-1.517-2.166s-1.73.213-1.73 2.166v6.5h-4.337V9.747h4.337v1.734c.65-.975 1.733-1.734 3.792-1.734s3.792 1.625 3.792 5.417z" />
            </svg>
          </div>

        <?php elseif ($iconType === 'custom' && !empty($customIcon)): ?>
          <div style="transform: rotate(<?php echo $rotation; ?>);"><?php echo $customIcon; ?></div>

          <?php else:
          $path = get_theme_file_path('/assets/media/compass-small.svg');
          if (file_exists($path)) {
            $compass_svg = file_get_contents($path);
          ?>
            <div class="relative w-full h-full overflow-hidden">
              <div class="flex flex-col w-full h-full transition-transform duration-300 ease-in-out group-hover/btn:-translate-y-full">
                <div class="w-full h-full shrink-0 flex items-center justify-center transition-transform duration-300"
                  style="transform: rotate(<?php echo $rotation; ?>);">
                  <div class="w-full h-full [&>svg]:w-full [&>svg]:h-full [&>svg]:block">
                    <?php echo $compass_svg; ?>
                  </div>
                </div>
                <div class="w-full h-full shrink-0 flex items-center justify-center transition-transform duration-300"
                  style="transform: rotate(<?php echo $rotation; ?>);">
                  <div class="w-full h-full [&>svg]:w-full [&>svg]:h-full [&>svg]:block">
                    <?php echo $compass_svg; ?>
                  </div>
                </div>
              </div>
            </div>
        <?php
          }
        endif; ?>
      </div>
    </div>
  <?php endif; ?>

</<?php echo $tag; ?>>