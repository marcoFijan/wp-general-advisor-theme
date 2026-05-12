<?php
$bg_color_array = get_sub_field('bg_color');
$bg_color = $bg_color_array['value'] ?? 'white';
$order_val = get_sub_field('order')['value'] ?? 'txt_img';
$link = get_sub_field('link');
$hide_mobile = get_sub_field('hidden_mobile');

$bg_classes = [
	'white'      => 'bg-white my-section lg:my-section-lg',
	'beige'      => 'bg-beige py-12 lg:py-25 ',
	'light_blue' => 'bg-blue-lighter py-12 lg:py-25',
	'blue'       => 'bg-blue text-white py-12 lg:py-25'
];

$selected_bg = $bg_classes[$bg_color] ?? 'bg-white my-section lg:my-section-lg';
$prose_class = ($bg_color === 'blue') ? 'prose-white' : '';

if ($order_val === 'img_txt') {
	$text_col_classes  = 'lg:order-2 lg:col-start-7';
	$image_col_classes = 'lg:order-1 lg:col-start-2';
} else {
	$text_col_classes  = 'lg:order-1 lg:col-start-2';
	$image_col_classes = 'lg:order-2 lg:col-start-8';
}

$mobile_visibility = $hide_mobile ? 'hidden lg:block' : 'block';
?>

<section class="<?= esc_attr($selected_bg); ?>">
	<div class="container grid grid-cols-12 gap-x-4 gap-y-10 items-center">

		<div class="col-span-12 lg:col-span-5 flex flex-col gap-4 items-start <?= $text_col_classes; ?>">
			<article class="prose lg:mr-17 prose-ul:gap-1 <?= $prose_class; ?>">
				<?php the_sub_field('txt'); ?>
			</article>

			<?php if ($link) :
				get_template_part('components/button', null, array(
					'link'  => $link,
					'color' => ($bg_color === 'blue') ? 'green' : 'blue'
				));
			endif; ?>
		</div>

		<div class="col-span-12 lg:col-span-4 rounded-card overflow-hidden <?= $image_col_classes; ?> <?= $mobile_visibility; ?>">
			<?php
			$image_id = get_sub_field('img');
			if ($image_id) {
				echo wp_get_attachment_image($image_id, 'portrait', false, [
					'class' => 'w-full h-full block object-cover'
				]);
			}
			?>
		</div>

	</div>
</section>