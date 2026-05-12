<?php
$search_page = get_pages([
  'meta_key'   => '_wp_page_template',
  'meta_value' => 'template-search.php',
  'number'     => 1
]);
$search_page_id = $search_page ? $search_page[0]->ID : 0;
$title              = get_field('title', $search_page_id) ?: 'Zoeken';
$txt                = get_field('txt', $search_page_id) ?: 'Gebruik het zoekveld om je zoekopdracht uit te voeren';
$search_placeholder = get_field('search_placeholder', $search_page_id) ?: 'Typ hier uw zoekopdracht...';
$search_terms_title = get_field('search_terms_title', $search_page_id) ?: 'Populaire zoektermen';
?>

<section class=" pt-23 pb-56">
  <div class="container mx-auto grid grid-cols-12">
    <div class="col-span-12 lg:col-span-6 lg:col-start-4 text-center">
      <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

      <article class="prose prose-white mt-5">
        <h1><?php echo esc_html($title); ?></h1>
        <p class="text-xs mt-3 block"><?php echo nl2br(esc_html($txt)); ?></p>
      </article>

      <form class="m-0 mt-8" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="form-group">
          <div class="flex flex-col md:flex-row gap-4">
            <input type="search"
              id="search-input"
              class="rounded-usp-md block w-full px-5 py-3 transition-all bg-white/10 outline-none font-normal text-white placeholder:text-white/30 "
              placeholder="<?php echo esc_attr($search_placeholder); ?>"
              value="<?php echo get_search_query(); ?>"
              name="s" />
          </div>
        </div>

        <?php
        if (have_rows('search_terms', $search_page_id)): ?>
          <div class="flex flex-wrap justify-center items-center gap-1.5 mt-4">
            <span class="text-center w-full font-semibold tracking-wider text-white uppercase text-2xs">
              <?php echo esc_html($search_terms_title); ?>
            </span>

            <?php while (have_rows('search_terms', $search_page_id)): the_row();
              $term = get_sub_field('term');
              if (!$term) continue;
            ?>
              <a href="<?php echo esc_url(home_url('/?s=' . urlencode($term))); ?>"
                class="relative inline-block overflow-hidden text-blue border bg-white px-2 font-semibold py-1.5 rounded-label text-3xs transition-all after:absolute after:inset-0 after:bg-transparent hover:after:bg-black/10 after:transition-colors after:pointer-events-none">
                <span class="relative z-10"><?php echo esc_html($term); ?></span>
              </a>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>

      </form>
    </div>
  </div>
</section>