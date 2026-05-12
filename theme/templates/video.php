<?php
$txt         = get_sub_field('txt');
$select_post = get_sub_field('select_post');
$video_rel   = get_sub_field('video');
$manual_yt   = get_sub_field('yt_id');
$manual_img  = get_sub_field('img');

$final_yt_id = '';
$thumb_id    = '';
$title       = '';

if ($select_post && $video_rel) {
  $rel_post_id = is_array($video_rel) ? $video_rel[0] : $video_rel;
  $final_yt_id = get_field('yt_id', $rel_post_id);
  $thumb_id    = get_field('video_thumbnail', $rel_post_id);
  $title       = get_the_title($rel_post_id);
} else {
  $final_yt_id = $manual_yt;
  $thumb_id    = $manual_img;
  $title       = "";
}

$img_html = '';
if ($thumb_id) {
  $img_html = wp_get_attachment_image($thumb_id, 'large', false, [
    'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105'
  ]);
} elseif ($final_yt_id) {
  $yt_thumb = "https://img.youtube.com/vi/" . esc_attr($final_yt_id) . "/maxresdefault.jpg";
  $img_html = '<img src="' . esc_url($yt_thumb) . '" alt="Video thumbnail" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">';
} else {
  $img_html = '<div class="w-full h-full bg-blue/10"></div>';
}
?>

<section class="grid grid-cols-12 gap-4 my-section lg:my-section-lg container">
  <div class="col-span-12 lg:col-span-10 lg:col-start-2">
    <div class="flex flex-col gap-6">

      <?php if ($txt): ?>
        <div class="wysiwyg prose max-w-none">
          <?= $txt; ?>
        </div>
      <?php endif; ?>

      <div class="cookieconsent-optin-marketing w-full aspect-video rounded-usp-md overflow-hidden relative bg-stone-medium/20 group cursor-pointer"
        data-youtube-id="<?= esc_attr($final_yt_id); ?>">
        <?= $img_html; ?>
        <div class="absolute inset-0 bg-blue/40 pointer-events-none transition-opacity duration-300 "></div>
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none transition-opacity duration-300">
          <div class="w-20 h-20 transition-transform duration-300 group-hover:scale-110 rounded-full overflow-hidden">
          </div>
        </div>
      </div>

      <div class="cookieconsent-optout-marketing w-full aspect-video rounded-usp-md overflow-hidden relative bg-stone-medium/20 flex items-center justify-center">

        <div class="absolute inset-0 scale-105 pointer-events-none">
          <?= str_replace('group-hover:scale-105', '', $img_html); ?>
        </div>

        <div class="absolute inset-0 bg-blue/40 pointer-events-none"></div>

        <div class="relative z-10 p-6 text-center flex flex-col items-center">
          <p class="text-white text-lg font-semibold mb-6 max-w-md">
            Accepteer marketingcookies om deze inhoud te bekijken.
          </p>
          <a href="javascript: Cookiebot.renew()" class="inline-block bg-green hover:bg-green-dark text-white font-bold py-3 px-8 rounded-full transition-colors cursor-pointer">
            Cookies Accepteren
          </a>
        </div>
      </div>

    </div>
  </div>
</section>