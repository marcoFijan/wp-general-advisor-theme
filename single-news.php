<?php
get_header();

$article     = get_field('article');
$title       = $article['article_title'] ?: get_the_title();
$content     = $article['article_txt'];

$author_id   = get_post_field('post_author', get_the_ID());
$author_name = get_the_author_meta('display_name', $author_id);
$job_title = get_field('job_title', 'user_' . $author_id);
$acf_author_img = get_field('profile_image', 'user_' . $author_id);
$author_img_url = '';

if ($acf_author_img) {
  $author_img_url = $acf_author_img['sizes']['thumbnail'];
} else {
  $author_img_url = get_avatar_url($author_id, ['size' => 96]);
}

$share_url   = urlencode(get_permalink());
$share_title = urlencode($title);
?>

<article class="pt-12 pb-24 bg-beige">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
      <header class="col-span-1 lg:col-span-8 lg:col-start-3 mb-12">
        <h1 class="text-4xl md:text-6xl text-blue font-heading leading-tight">
          <?= esc_html($title); ?>
        </h1>
      </header>

      <aside class="col-span-1 lg:col-span-3 lg:col-start-1 relative mt-30">
        <div class="sticky top-24 p-6 bg-white rounded-usp-xs">
          <span class="text-blue font-heading text-lg font-semibold block mb-2 w-full border-b border-blue-light pb-2">Geschreven door</span>
          <div class="flex items-center gap-4 mb-14">
            <div class="w-12 h-12 rounded-full overflow-hidden bg-white border border-blue/10 shrink-0">
              <?php if ($author_img_url) : ?>
                <img src="<?= esc_url($author_img_url); ?>" alt="<?= esc_attr($author_name); ?>" class="w-full h-full object-cover">
              <?php else : ?>
                <div class="w-full h-full bg-white border border-blue/10 flex items-center justify-center text-blue">
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                  </svg>
                </div>
              <?php endif; ?>
            </div>
            <div>
              <span class="block font-bold text-black leading-tight"><?= esc_html($author_name); ?></span>
              <span class="block text-sm text-blue-light"><?= esc_html($job_title); ?></span>
            </div>
          </div>

          <p class="text-blue font-heading text-lg font-semibold leading-none mb-1">Vond je dit interessant?</p>
          <p class="text-lg font-heading font-semibold text-blue-light mb-4 leading-none">Deel het artikel</p>


          <div class="flex gap-3">
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $share_url; ?>" target="_blank" class="w-10 h-10 p-2 rounded-lg bg-blue/5 flex items-center justify-center text-blue hover:bg-blue/20 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                <path d="M23.6167 0H2.38329C1.75276 0.00502442 1.14947 0.257734 0.703604 0.703604C0.257734 1.14947 0.00502442 1.75276 0 2.38329L0 23.6167C0.00502442 24.2472 0.257734 24.8505 0.703604 25.2964C1.14947 25.7423 1.75276 25.995 2.38329 26H23.6167C24.2472 25.995 24.8505 25.7423 25.2964 25.2964C25.7423 24.8505 25.995 24.2472 26 23.6167V2.38329C25.995 1.75276 25.7423 1.14947 25.2964 0.703604C24.8505 0.257734 24.2472 0.00502442 23.6167 0ZM7.58371 21.6666H3.25026V9.74734H7.58371V21.6666ZM5.41664 8.34153C5.14452 8.36417 4.87066 8.33087 4.61189 8.2437C4.35313 8.15652 4.11494 8.01731 3.912 7.83462C3.70906 7.65194 3.54566 7.42965 3.43186 7.18144C3.31805 6.93323 3.25625 6.66436 3.25026 6.39137C3.24417 6.11007 3.29689 5.8306 3.40505 5.57085C3.5132 5.3111 3.67441 5.0768 3.87834 4.88295C4.08227 4.6891 4.32444 4.53997 4.58933 4.44511C4.85422 4.35025 5.13601 4.31175 5.41664 4.33208C5.68875 4.30943 5.96262 4.34273 6.22138 4.4299C6.48015 4.51708 6.71833 4.6563 6.92127 4.83898C7.12421 5.02167 7.28761 5.24395 7.40142 5.49216C7.51523 5.74037 7.57703 6.00924 7.58302 6.28223C7.58911 6.56353 7.53638 6.843 7.42823 7.10275C7.32007 7.3625 7.15887 7.5968 6.95494 7.79065C6.75101 7.98451 6.50884 8.13364 6.24395 8.2285C5.97905 8.32336 5.69727 8.36185 5.41664 8.34153ZM22.7504 21.6666H18.417V15.1702C18.417 13.4369 17.2253 13.0038 16.9 13.0038C16.5746 13.0038 15.1702 13.2166 15.1702 15.1702V21.67H10.8333V9.74734H15.1702V11.4806C15.8202 10.5058 16.9034 9.74734 18.962 9.74734C21.0206 9.74734 22.7539 11.3721 22.7539 15.164L22.7504 21.6666Z" fill="#222C78" />
              </svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $share_url; ?>" target="_blank" class="w-10 h-10 rounded-lg bg-blue/5 flex items-center justify-center text-blue hover:bg-blue/20 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M22.0595 11.987C22.0592 10.0644 21.508 8.1821 20.4712 6.56298C19.4343 4.94387 17.9553 3.65574 16.2091 2.85109C14.463 2.04645 12.5228 1.75898 10.6183 2.02273C8.71387 2.28647 6.92485 3.09039 5.46308 4.3393C4.00131 5.58821 2.92799 7.22981 2.37021 9.06976C1.81242 10.9097 1.79351 12.8709 2.31573 14.7213C2.83795 16.5717 3.87942 18.2336 5.31685 19.5105C6.75428 20.7873 8.52747 21.6256 10.4265 21.926V14.9H7.8715V11.987H10.4265V9.77104C10.3716 9.25338 10.4313 8.72998 10.6012 8.23792C10.7711 7.74585 11.0471 7.29717 11.4096 6.92362C11.7722 6.55008 12.2125 6.26083 12.6993 6.07634C13.186 5.89185 13.7074 5.81664 14.2265 5.85604C14.981 5.86754 15.7337 5.93439 16.4785 6.05604V8.52904H15.2105C14.9943 8.50028 14.7744 8.52051 14.5671 8.58825C14.3598 8.65598 14.1704 8.76949 14.0129 8.92035C13.8554 9.07122 13.7339 9.25559 13.6573 9.45979C13.5807 9.664 13.551 9.88282 13.5705 10.1V11.987H16.3615L15.9145 14.9H13.5705V21.93C15.9376 21.5549 18.0932 20.3474 19.6494 18.5247C21.2056 16.7019 22.0602 14.3837 22.0595 11.987Z" fill="#222C78" />
              </svg>
            </a>
            <a href="https://api.whatsapp.com/send?text=<?= $share_title . ' ' . $share_url; ?>" target="_blank" class="w-10 h-10 rounded-lg bg-blue/5 flex items-center justify-center text-blue hover:bg-blue/20 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.0488 4.90704C17.3491 3.20724 15.0896 2.18315 12.691 2.0255C10.2924 1.86785 7.9183 2.58738 6.01079 4.0501C4.10328 5.51281 2.79243 7.61899 2.3224 9.97636C1.85237 12.3337 2.25518 14.7816 3.45583 16.864L2.04883 22L7.29983 20.621C8.75228 21.4124 10.3797 21.8277 12.0338 21.829C13.9947 21.8301 15.9118 21.2495 17.5427 20.1607C19.1735 19.072 20.4448 17.5239 21.1956 15.7125C21.9465 13.9011 22.1432 11.9077 21.7609 9.98444C21.3786 8.06119 20.4344 6.29456 19.0478 4.90804L19.0488 4.90704ZM12.0408 20.157C10.5646 20.1573 9.11555 19.76 7.84583 19.007L7.54583 18.827L4.42783 19.644L5.26083 16.605L5.06583 16.293C4.38641 15.2118 3.96761 13.9875 3.84248 12.7167C3.71735 11.4459 3.88931 10.1634 4.3448 8.97052C4.80028 7.77758 5.52682 6.70684 6.46705 5.84282C7.40729 4.9788 8.53549 4.34516 9.7626 3.99191C10.9897 3.63866 12.2821 3.57547 13.5378 3.80733C14.7935 4.03919 15.9781 4.55976 16.9982 5.32793C18.0182 6.09611 18.8457 7.09087 19.4154 8.23369C19.9851 9.3765 20.2814 10.6361 20.2808 11.913C20.2776 14.0977 19.4086 16.192 17.864 17.7371C16.3195 19.2822 14.2255 20.153 12.0408 20.157ZM16.5568 13.985C16.3108 13.86 15.0918 13.263 14.8648 13.185C14.6378 13.107 14.4738 13.06 14.3058 13.31C14.1378 13.56 13.6658 14.11 13.5208 14.283C13.3758 14.456 13.2328 14.47 12.9858 14.345C12.2557 14.0533 11.5817 13.6371 10.9938 13.115C10.4532 12.6137 9.98892 12.0359 9.61583 11.4C9.47083 11.154 9.59983 11.018 9.72583 10.9C9.85183 10.782 9.97183 10.611 10.0968 10.466C10.199 10.3409 10.2822 10.2014 10.3438 10.052C10.3767 9.9837 10.392 9.90826 10.3885 9.83251C10.385 9.75677 10.3628 9.68307 10.3238 9.61804C10.2608 9.49304 9.76483 8.27404 9.56183 7.77804C9.35883 7.28204 9.15583 7.35204 8.99983 7.34404C8.84383 7.33604 8.68983 7.33604 8.52683 7.33604C8.40154 7.3397 8.27833 7.36901 8.16481 7.42216C8.0513 7.4753 7.94988 7.55116 7.86683 7.64504C7.58676 7.91053 7.36504 8.23142 7.21577 8.58728C7.0665 8.94315 6.99296 9.32619 6.99983 9.71204C7.0804 10.6462 7.43176 11.5365 8.01083 12.274C9.07314 13.8657 10.5307 15.1541 12.2408 16.013C12.8308 16.267 13.2918 16.419 13.6508 16.537C14.1558 16.6901 14.6894 16.7244 15.2098 16.637C15.5546 16.567 15.8811 16.4264 16.1689 16.224C16.4567 16.0216 16.6994 15.7618 16.8818 15.461C17.0442 15.0917 17.0946 14.6827 17.0268 14.285C16.9688 14.174 16.8048 14.114 16.5548 13.985H16.5568Z" fill="#222C78" />
              </svg>
            </a>
            <a href="mailto:?subject=<?= $share_title; ?>&body=<?= $share_url; ?>" class="w-10 h-10 rounded-lg bg-blue/5 flex items-center justify-center text-blue hover:bg-blue/20 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M21.5 5H2.5V19H21.5V5Z" fill="#222C78" stroke="#F4F4F8" stroke-miterlimit="10" />
                <path d="M2.5 5L12 12L21.5 5" stroke="#F4F4F8" stroke-miterlimit="10" />
              </svg>
            </a>
          </div>
        </div>
      </aside>

      <div class="col-span-1 lg:col-span-6 lg:col-start-5 prose prose-blue max-w-none font-medium">
        <?= $content; ?>
      </div>

    </div>
  </div>
</article>

<?php
$featured_services = get_field('featured_services');

if ($featured_services) :
  $services_txt = $featured_services['txt'];
  $services_ids = $featured_services['services'];
?>
  <section class="bg-beige">
    <div class="container grid grid-cols-12 gap-4">
      <div class="bg-white col-span-12 rounded-card grid grid-cols-12 gap-4 py-10 lg:py-18">
        <div class="col-span-10 col-start-2 lg:col-span-6 grid grid-cols-10 lg:grid-cols-6 gap-4 lg:col-start-4">

          <?php
          $services_txt = $featured_services['txt'] ?? '';

          if ($services_txt) : ?>
            <article class="col-span-10 lg:col-span-6 prose mb-12 lg:mx-10">
              <?php echo $services_txt; ?>
            </article>
          <?php endif; ?>

          <?php
          $services = $featured_services['services'] ?? null;

          if ($services) :
            foreach ($services as $service_id) : ?>

              <a href="<?php echo esc_url(get_permalink($service_id)); ?>" class="text-black hover:bg-blue bg-blue-lighter transition-colors duration-300 hover:text-white col-span-10 md:col-span-5 lg:col-span-3 w-full flex justify-between items-center p-xs pl-5 rounded-usp-xs">
                <span class="block text-sm font-semibold ">
                  <?php echo esc_html(get_the_title($service_id)); ?>
                </span>
                <span class="bg-white rounded-usp-xs p-2  w-7 aspect-square text-black">
                  <?php
                  $path = get_theme_file_path('/assets/media/compass-small.svg');
                  if (file_exists($path)) {
                    $svg = file_get_contents($path);
                    echo str_replace('<svg', '<svg fill="currentColor" class="w-full h-full"', $svg);
                  }
                  ?>
                </span>
              </a>

            <?php endforeach; ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php
$current_post_id = get_the_ID();
$terms = get_the_terms($current_post_id, 'news_category');

$related_args = [
  'post_type'      => 'news',
  'posts_per_page' => 3,
  'post__not_in'   => [$current_post_id],
];

if ($terms && !is_wp_error($terms)) {
  $term_ids = wp_list_pluck($terms, 'term_id');

  $related_args['tax_query'] = [[
    'taxonomy' => 'news_category',
    'field'    => 'term_id',
    'terms'    => $term_ids,
  ]];
}

$related = new WP_Query($related_args);

if ($related->have_posts()) : ?>
  <section class="bg-beige pt-12 pb-17">
    <div class="container mx-auto px-4">
      <div class="text-center prose mb-12">
        <h3 class="text-blue">Gerelateerde artikelen</h3>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
        <?php
        while ($related->have_posts()) : $related->the_post();
          get_template_part('components/news-card', null, ['post_id' => get_the_ID()]);
        endwhile;
        wp_reset_postdata();
        ?>
      </div>
  </section>
<?php endif; ?>

<?php get_template_part('templates/flexible-content'); ?>

<?php get_footer(); ?>