<?php
$top_bar = get_field('top_bar', 'option');
$tel = $top_bar['tel'] ?? '';
$mail = $top_bar['mail'] ?? '';
$show_vacancies = $top_bar['show_vacancies_link'] ?? false;
$top_links = $top_bar['links'] ?? [];

$extra_buttons = get_field('extra_menu_buttons', 'option');
$contact_btn = $extra_buttons['contact_button'] ?? null;
$search_btn = $extra_buttons['search_button'] ?? null;

$mega_menu = get_field('mega_menu', 'option');
$show_mega_menu = $mega_menu['show_mega_menu'] ?? false;
$mega_categories = $mega_menu['mega_menu_service_categories'] ?? [];
$show_custom_cat = $mega_menu['show_mega_menu_service_category_custom'] ?? false;
$sector_cat_data = $mega_menu['mega_menu_sectors'] ?? [];
$current_url = home_url(add_query_arg([], $wp->request)) . '/';

$vacancy_count = wp_count_posts('vacancy')->publish ?? 0;
$vacancy_archive = get_post_type_archive_link('vacancy');

$compass_path = get_theme_file_path('/assets/media/compass-small.svg');
$compass_svg = file_exists($compass_path)
	? file_get_contents($compass_path)
	: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>';
?>

<div class="pb-7 bg-blue w-full items-start pt-2 relative z-50">
	<div class="container mx-auto flex justify-between items-center px-4">
		<div class="flex flex-col sm:flex-row items-start sm:items-center gap-x-7 gap-y-1">
			<?php if ($tel): ?>
				<a href="tel:<?= esc_attr(preg_replace('/[^0-9+]/', '', $tel)) ?>" class="group flex items-center gap-2 text-white font-semibold text-1.5xs transition-all duration-300">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-green" viewBox="0 0 15 14" fill="none">
						<path d="M10.625 8.16667L8.81251 9.275C7.24201 8.45168 5.94461 7.2408 5.0625 5.775L6.25 4.08333L5 1.16667H2.5L1.3125 2.275C1.58956 4.97217 2.86383 7.49525 4.91661 9.41115C6.96939 11.3271 9.6727 12.5164 12.5625 12.775L13.75 11.6667V9.33333L10.625 8.16667Z" fill="currentColor" stroke="currentColor" stroke-miterlimit="10" />
					</svg>
					<span class="relative">
						<?= esc_html($tel) ?>
						<span class="absolute left-0 bottom-0 h-px w-full bg-green origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
					</span>
				</a>
			<?php endif; ?>

			<?php if ($mail): ?>
				<a href="mailto:<?= esc_attr($mail) ?>" class="group flex items-center gap-2 text-white font-semibold text-1.5xs transition-all duration-300">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-green stroke-blue" viewBox="0 0 15 15" fill="none">
						<g clip-path="url(#clip0_2522_696)">
							<path d="M15 1.97377H0.000244141V13.0262H15V1.97377Z" fill="currentColor" stroke-miterlimit="10" />
							<path d="M0.000244141 1.97377L7.50012 7.5L15 1.97377" fill="currentColor" />
							<path d="M0.000244141 1.97377L7.50012 7.5L15 1.97377" stroke-miterlimit="10" />
						</g>
						<defs>
							<clipPath id="clip0_2522_696">
								<rect width="15" height="15" fill="white" />
							</clipPath>
						</defs>
					</svg>
					<span class="relative">
						<?= esc_html($mail) ?>
						<span class="absolute left-0 bottom-0 h-px w-full bg-green origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
					</span>
				</a>
			<?php endif; ?>
		</div>

		<div class="flex flex-col sm:flex-row items-end sm:items-center gap-x-7 gap-y-1 text-white font-semibold text-1.5xs">
			<?php if ($show_vacancies && $vacancy_archive): ?>
				<a href="<?= esc_url($vacancy_archive) ?>" class="group flex items-start gap-1 transition-all duration-300">
					<span class="relative">
						Vacatures
						<span class="absolute left-0 bottom-0 h-px w-full bg-green origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
					</span>
					<span class="bg-green rounded-full tracking-wider text-white text-4xs leading-none w-3 h-3 flex justify-center items-center aspect-square"><span><?= esc_html($vacancy_count) ?></span></span>
				</a>
			<?php endif; ?>

			<?php if ($top_links): foreach ($top_links as $item): $link = $item['link'];
					if ($link): ?>
						<a href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target'] ?: '_self') ?>" class="group transition-all duration-300">
							<span class="relative">
								<?= esc_html($link['title']) ?>
								<span class="absolute left-0 bottom-0 h-px w-full bg-green origin-left scale-x-0 transition-transform duration-300 ease-out group-hover:scale-x-100"></span>
							</span>
						</a>
			<?php endif;
				endforeach;
			endif; ?>
		</div>
	</div>
</div>

<div data-nav-scrolled class="fixed top-15 sm:top-9 data-[nav-scrolled=true]:top-4 lg:bottom-auto lg:top-9 data-[scrolled=true]:lg:top-0 z-50 left-0 w-full px-4 lg:px-7 pointer-events-none transition-all duration-500 ease-in-out">
	<div id="mega-menu-overlay" class="fixed inset-0 bg-black/40 opacity-0 invisible transition-all duration-500 ease-out -z-20 pointer-events-none hidden lg:block"></div>
	<div class="container mx-auto relative pointer-events-auto z-10 mega-nav-container">
		<div class="relative w-full h-full">
			<div class="absolute inset-y-0 -left-4 -right-4 lg:-left-7 lg:-right-7 bg-white rounded-nav shadow-soft-blue -z-10"></div>
			<div class="flex justify-between items-center py-3">
				<a href="<?= home_url() ?>" class="shrink-0 flex items-center gap-1">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-auto" viewBox="0 0 101 30" fill="none">
						<g clip-path="url(#clip0_2582_717)">
							<path d="M87.25 22.8784H101V19.9575H91.3903L100.936 8.69904V5.77809H87.2821V8.69904H96.7635L87.25 19.9575V22.8784Z" fill="#222C78" />
							<path d="M71.4298 14.3141C71.4298 11.1592 73.5 8.56788 76.8386 8.56788C80.1772 8.56788 82.2474 11.1911 82.2474 14.3141C82.2474 17.4371 80.1772 20.1241 76.8386 20.1241C73.5 20.1241 71.4298 17.5009 71.4298 14.3141ZM76.4716 23.1797C78.7413 23.1797 81.1108 22.1517 82.1797 20.7231V22.882H85.5183V0H82.1797V8.03616C81.1785 6.57568 78.8767 5.48033 76.4716 5.48033C71.697 5.48033 68.0591 9.19887 68.0591 14.3141C68.0591 19.8582 71.7647 23.1797 76.4716 23.1797Z" fill="#222C78" />
							<path d="M69.0995 5.77809H65.262L60.0884 18.894L54.6796 5.77809H50.9419L58.2178 22.7473L55.6701 28.6565H59.3936L69.0995 5.77809Z" fill="#222C78" />
							<path d="M36.016 14.3141C36.016 11.1273 38.0861 8.56788 41.3891 8.56788C44.6921 8.56788 46.7623 11.1592 46.7623 14.3141C46.7623 17.469 44.6921 20.0248 41.3891 20.0248C38.0861 20.0248 36.016 17.469 36.016 14.3141ZM41.4248 26.8451C38.7881 26.8451 36.9851 25.3173 36.3509 23.5236L33.5147 24.9841C34.3841 27.3095 36.9851 30 41.4248 30C46.7979 30 50.0368 26.2815 50.0368 21.9319V5.77809H46.6982V8.00426C45.5972 6.54378 43.3275 5.48033 40.9901 5.48033C36.3509 5.48033 32.6453 8.83375 32.6453 14.3141C32.6453 19.4931 36.2832 23.0805 40.9901 23.0805C43.4593 23.0805 45.6613 21.9851 46.6982 20.5884V22.095C46.6982 24.7501 44.6957 26.8451 41.4248 26.8451Z" fill="#222C78" />
							<path d="M14.4021 0.0663338C22.355 0.0663338 28.8042 6.40951 28.8042 14.2316C28.8042 22.0537 22.355 28.3969 14.4021 28.3969C6.44923 28.3969 0 22.0572 0 14.2316C0 6.40601 6.44923 0.0663338 14.4021 0.0663338Z" fill="#222C78" />
							<path d="M10.244 15.2783L5.05615 21.7512L12.5565 18.1567L14.4022 26.2283L16.255 18.1567L10.244 15.2783ZM17.7408 11.6873L19.5937 3.61574L14.4058 10.0886L18.5675 15.2783L26.0643 11.6873H17.7444H17.7408Z" fill="white" />
							<path d="M23.7516 21.7512L9.21412 3.61574L11.0741 11.6909L2.74707 11.6873L23.7516 21.7512Z" fill="#87BD25" />
						</g>
						<defs>
							<clipPath id="clip0_2582_717">
								<rect width="101" height="30" fill="white" />
							</clipPath>
						</defs>
					</svg>
				</a>
				<nav class="hidden xl:block flex-1 px-8">
					<?php
					$primary_menu_items = get_menu('primary');
					if ($primary_menu_items):
					?>
						<ul class="flex items-center justify-center gap-4 text-base font-medium">
							<?php foreach ($primary_menu_items as $item):
								$has_children = !empty($item['children']);
								$is_services_archive = (strpos($item['url'], '/diensten') !== false);
								$show_this_mega_menu = ($is_services_archive && $show_mega_menu);
								$is_active = (trailingslashit($item['url']) == $current_url);
								$active_class = $is_active ? 'text-green' : 'text-black';
							?>
								<li class="relative group <?= $show_this_mega_menu ? 'static mega-menu-hover-trigger' : '' ?>">
									<a href="<?= esc_url($item['url']) ?>" title="<?= esc_attr($item['title']) ?>" <?= $item['target'] ?>
										class="<?= $show_this_mega_menu ? 'pb-10 -mb-7' : '' ?> py-3 px-4 transition-colors duration-300 flex items-center gap-1 group-hover:bg-blue-lightest rounded-usp-md font-semibold <?= $active_class ?> <?= esc_attr($item['classes']) ?>"> <?= esc_html($item['title']) ?>
										<?php if ($has_children || $show_this_mega_menu): ?>
											<svg class="w-3 h-3 transition-transform duration-500 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M19 9l-7 7-7-7"></path>
											</svg>
										<?php endif; ?>
									</a>
									<?php if ($show_this_mega_menu): ?>
										<div class="absolute -left-7 -right-7 top-[calc(100%-2rem)] pt-15 pb-7 px-7 bg-blue-lightest shadow-lg rounded-b-xl opacity-0 invisible -translate-y-4 group-hover:translate-y-0 group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out -z-20">
											<div class="container mx-auto grid grid-cols-12 gap-4">
												<div class="col-span-8 2xl:col-span-9 bg-white rounded-usp-md p-4 grid grid-cols-8 2xl:grid-cols-9 gap-4">
													<?php
													$sectors_data        = get_field('mega_menu_sectors', 'option');
													$sector_posts        = get_posts([
														'post_type'      => 'sectors',
														'post_status'    => 'publish',
														'posts_per_page' => -1,
														'orderby'        => 'menu_order title',
														'order'          => 'ASC',
													]);
													$sector_title        = !empty($sector_cat_data['sector_category']) ? $sector_cat_data['sector_category'] : 'Sectoren';
													$sectors_archive_url = get_post_type_archive_link('sectors');
													?>

													<div class="col-span-4 flex flex-col gap-2 pr-4" role="tablist" aria-label="Diensten categorieën">
														<?php foreach ($mega_categories as $index => $cat):
															$term = get_term($cat['category']);
															if (!$term || is_wp_error($term)) continue;
															$cat_label = !empty($cat['category_label']) ? $cat['category_label'] : $term->name;
															$is_first = ($index === 0);
															$data_ref = 'mega-posts-' . esc_attr($term->term_id);
															$term_url = get_term_link($term);
														?>
															<a href="<?= !is_wp_error($term_url) ? esc_url($term_url) : '#' ?>"
																role="tab"
																aria-selected="<?= $is_first ? 'true' : 'false' ?>"
																data-mega-trigger="<?= $data_ref ?>"
																class="group/btn flex items-center justify-between w-full text-left py-4 first:pt-0 cursor-pointer duration-200">
																<div class="flex items-center gap-4">
																	<?php if ($cat['icon']): ?>
																		<div class="w-10 h-10 shrink-0">
																			<?= wp_get_attachment_image($cat['icon'], 'thumbnail', false, ['class' => 'w-full h-auto object-contain']) ?>
																		</div>
																	<?php endif; ?>
																	<span class="text-1.5xl font-semibold text-blue"><?= esc_html($cat_label) ?></span>
																</div>
																<div class="flex items-center justify-center rounded-usp-xs border border-blue/40 p-2 transition-colors duration-200 bg-white text-blue group-aria-selected/btn:border-blue group-aria-selected/btn:bg-blue group-aria-selected/btn:text-white pointer-events-none">
																	<span class="w-4 aspect-square flex items-center justify-center svg-container">
																		<?= $compass_svg ?>
																	</span>
																</div>
															</a>
														<?php endforeach; ?>
														<?php if (!empty($sector_posts)): ?>
															<a href="<?= esc_url($sectors_archive_url) ?>"
																role="tab"
																aria-selected="false"
																data-mega-trigger="mega-posts-sectors"
																class="group/btn flex items-center justify-between w-full text-left py-4 cursor-pointer duration-200">
																<div class="flex items-center gap-4">
																	<?php if ($sector_cat_data['icon']): ?>
																		<div class="w-10 h-10 shrink-0">
																			<?= wp_get_attachment_image($sector_cat_data['icon']['ID'] ?? $sector_cat_data['icon'], 'thumbnail', false, ['class' => 'w-full h-auto object-contain']) ?>
																		</div>
																	<?php endif; ?>
																	<span class="text-1.5xl font-semibold text-blue"><?= esc_html($sector_title) ?></span>
																</div>
																<div class="flex items-center justify-center rounded-usp-xs border border-blue/40 p-2 transition-colors duration-200 bg-white text-blue group-aria-selected/btn:border-blue group-aria-selected/btn:bg-blue group-aria-selected/btn:text-white pointer-events-none">
																	<span class="w-4 aspect-square flex items-center justify-center svg-container">
																		<?= $compass_svg ?>
																	</span>
																</div>
															</a>
														<?php endif; ?>
													</div>
													<div class="col-span-4 2xl:col-span-5 pl-2 relative overflow-hidden max-h-100">
														<?php foreach ($mega_categories as $index => $cat):
															$term = get_term($cat['category']);
															if (!$term || is_wp_error($term)) continue;
															$is_first = ($index === 0);
															$data_ref = 'mega-posts-' . esc_attr($term->term_id);

															$services = $cat['show_all_services']
																? get_posts(['post_type' => 'service', 'tax_query' => [['taxonomy' => 'service_type', 'field' => 'term_id', 'terms' => $term->term_id]], 'numberposts' => -1])
																: (is_array($cat['services']) ? get_posts(['post_type' => 'service', 'post__in' => $cat['services']]) : []);
														?>
															<div role="tabpanel" aria-hidden="<?= $is_first ? 'false' : 'true' ?>" data-mega-panel="<?= $data_ref ?>" class="aria-hidden:hidden flex flex-col max-h-[calc(100%-1rem)] overflow-y-auto overflow-x-hidden pr-2 pb-4 custom-scrollbar">
																<?php foreach ($services as $service):
																	$sub_title = get_field('sub_title', $service->ID);
																?>
																	<a href="<?= get_permalink($service->ID) ?>" class="group/link hover:opacity-80 flex flex-col transition-all pb-5 pt-2 border-b border-blue-lightest last:border-b-0">
																		<span class="text-base text-blue font-semibold flex gap-2 items-center group-hover/link:gap-4 transition-all">
																			<?= get_the_title($service->ID) ?>
																			<span class="w-4 text-blue">
																				<?= $compass_svg ?>
																			</span>
																		</span>
																		<?php if ($sub_title): ?>
																			<span class="text-sm font-medium text-black mt-1.5">
																				<?= esc_html($sub_title) ?>
																			</span>
																		<?php endif; ?>
																	</a>
																<?php endforeach; ?>
															</div>
														<?php endforeach; ?>
														<?php if (!empty($sector_posts)): ?>
															<div role="tabpanel" aria-hidden="true" data-mega-panel="mega-posts-sectors" class="aria-hidden:hidden flex flex-col max-h-[calc(100%-1rem)] overflow-y-auto overflow-x-hidden pr-2 pb-4 custom-scrollbar">
																<?php foreach ($sector_posts as $sector): ?>
																	<a href="<?= get_permalink($sector->ID) ?>" class="group/link hover:opacity-80 flex flex-col transition-all pb-5 pt-2 border-b border-blue-lightest last:border-b-0">
																		<span class="text-base text-blue font-semibold flex gap-2 items-center group-hover/link:gap-4 transition-all">
																			<?= get_the_title($sector->ID) ?>
																			<span class="w-4 text-blue">
																				<?= $compass_svg ?>
																			</span>
																		</span>
																	</a>
																<?php endforeach; ?>
															</div>
														<?php endif; ?>
													</div>
												</div>
												<div class="lg:col-span-4 2xl:col-span-3 bg-white rounded-usp-md p-4 flex flex-col justify-center">
													<article class="mx-5">
														<div class="prose prose-h4:mb-1 prose-h4:font-semibold mb-6">
															<?= wp_kses_post($mega_menu['mega_menu_card_txt'] ?? '') ?>
														</div>
														<div class="flex gap-4">
															<div>
																<?php if ($mega_menu['mega_menu_card_tel']): ?>
																	<p class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none"><?= esc_html($mega_menu['mega_menu_card_tel_title']) ?></p>
																	<a class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200 w-max" href="tel:<?= esc_attr(preg_replace('/[^0-9+]/', '', $mega_menu['mega_menu_card_tel'])) ?>">
																		<?= esc_html($mega_menu['mega_menu_card_tel']) ?>
																	</a>
																<?php endif; ?>
															</div>
															<div>
																<?php if ($mega_menu['mega_menu_card_mail']): ?>
																	<p class="uppercase text-2xs text-black/30 mb-2 font-semibold tracking-wider leading-none"><?= esc_html($mega_menu['mega_menu_card_mail_title']) ?></p>
																	<a class="inline-block text-black font-semibold text-1.5sm no-underline pb-0.5 shadow-underline shadow-green hover:shadow-underline-thick hover:shadow-green transition-shadow duration-200 w-max" href="mailto:<?= esc_attr($mega_menu['mega_menu_card_mail']) ?>">
																		<?= esc_html($mega_menu['mega_menu_card_mail']) ?>
																	</a>
																<?php endif; ?>
															</div>
														</div>
													</article>

													<?php if ($mega_menu['mega_menu_card_img']): ?>
														<div class="mb-4 mt-5 rounded-usp-xs overflow-hidden">
															<?= wp_get_attachment_image($mega_menu['mega_menu_card_img'], 'landscape-sm', false, ['class' => 'w-full h-auto object-cover']) ?>
														</div>
													<?php endif; ?>

													<?php if ($mega_menu['mega_menu_card_link']): $btn = $mega_menu['mega_menu_card_link']; ?>
														<a href="<?= esc_url($btn['url']) ?>" target="<?= esc_attr($btn['target'] ?: '_self') ?>" class="inline-block bg-blue hover:bg-blue-hover text-white text-center px-4 py-3 rounded-usp-xs font-semibold text-sm hover:bg-opacity-90 transition-all mt-auto">
															<?= esc_html($btn['title']) ?>
														</a>
													<?php endif; ?>
												</div>

											</div>
										</div>
									<?php elseif ($has_children): ?>
										<ul class="absolute z-50 left-0 top-[calc(100%-0.25rem)] overflow-hidden pt-1 w-max opacity-0 invisible -translate-y-2 group-hover:translate-y-0 group-hover:opacity-100 group-hover:visible transition-all duration-300">
											<div class="bg-white rounded-b-lg min-w-34 py-2 overflow-hidden">
												<?php foreach ($item['children'] as $index => $child): ?>
													<li class="px-3">
														<a href="<?= esc_url($child['url']) ?>"
															title="<?= esc_attr($child['title']) ?>"
															<?= $child['target'] ?>
															class="group/sublink px-4 py-2 hover:bg-gray text-base text-black font-semibold flex justify-between gap-4 items-center transition-all hover:text-blue <?= esc_attr($child['classes']) ?>">
															<span class="whitespace-nowrap"><?= esc_html($child['title']) ?></span>

															<span class="group-hover/sublink:opacity-100 opacity-20 w-4 aspect-square flex items-center justify-center transition-opacity duration-300 transform group-hover/sublink:translate-x-1">
																<?= $compass_svg ?>
															</span>
														</a>
													</li>
												<?php endforeach; ?>
											</div>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</nav>

				<div class="hidden xl:flex items-center gap-2 shrink-0">
					<?php if ($search_btn): ?>
						<?php
						get_template_part('components/button', null, [
							'color'      => 'white-border',
							'type'       => 'only-icon',
							'link'       => $search_btn,
							'icon'       => 'custom',
							'rotation'   => '0deg',
							'customIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none"> <circle cx="7.95408" cy="7.95408" r="7.20408" stroke="#222C78" stroke-width="1.5"/> <path d="M12.7534 13.7019L18.0517 19.0002" stroke="#222C78" stroke-width="1.5" stroke-linecap="round"/></svg>',
						]);
						?>
					<?php endif; ?>

					<?php if ($contact_btn): ?>
						<?php
						get_template_part('components/button', null, [
							'color'      => 'white-border',
							'link'      => $contact_btn,
							'type'      => 'without-icon',
						]);
						?>
					<?php endif; ?>
				</div>

				<button id="mobile-menu-open" class="flex xl:hidden flex-col justify-center items-center cursor-pointer w-10 h-10 gap-1.5 focus:outline-none text-blue" aria-label="Menu openen" aria-expanded="false" aria-controls="mobile-nav-drawer">
					<span class="w-6 h-0.5 bg-current rounded transition-transform duration-300"></span>
					<span class="w-6 h-0.5 bg-current rounded transition-opacity duration-300"></span>
					<span class="w-6 h-0.5 bg-current rounded transition-transform duration-300"></span>
				</button>

			</div>
		</div>
	</div>
</div>

<div id="mobile-nav-drawer" class="fixed inset-y-0 right-0 w-full max-w-md bg-blue-lightest z-100 transform translate-x-full transition-transform duration-500 ease-in-out flex flex-col shadow-2xl invisible" aria-hidden="true" tabindex="-1">
	<div class="flex justify-between items-center py-5 px-6">
		<a href="<?= home_url() ?>" class="shrink-0 flex items-center gap-1">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-auto" viewBox="0 0 101 30" fill="none">
				<g clip-path="url(#clip0_2582_717)">
					<path d="M87.25 22.8784H101V19.9575H91.3903L100.936 8.69904V5.77809H87.2821V8.69904H96.7635L87.25 19.9575V22.8784Z" fill="#222C78" />
					<path d="M71.4298 14.3141C71.4298 11.1592 73.5 8.56788 76.8386 8.56788C80.1772 8.56788 82.2474 11.1911 82.2474 14.3141C82.2474 17.4371 80.1772 20.1241 76.8386 20.1241C73.5 20.1241 71.4298 17.5009 71.4298 14.3141ZM76.4716 23.1797C78.7413 23.1797 81.1108 22.1517 82.1797 20.7231V22.882H85.5183V0H82.1797V8.03616C81.1785 6.57568 78.8767 5.48033 76.4716 5.48033C71.697 5.48033 68.0591 9.19887 68.0591 14.3141C68.0591 19.8582 71.7647 23.1797 76.4716 23.1797Z" fill="#222C78" />
					<path d="M69.0995 5.77809H65.262L60.0884 18.894L54.6796 5.77809H50.9419L58.2178 22.7473L55.6701 28.6565H59.3936L69.0995 5.77809Z" fill="#222C78" />
					<path d="M36.016 14.3141C36.016 11.1273 38.0861 8.56788 41.3891 8.56788C44.6921 8.56788 46.7623 11.1592 46.7623 14.3141C46.7623 17.469 44.6921 20.0248 41.3891 20.0248C38.0861 20.0248 36.016 17.469 36.016 14.3141ZM41.4248 26.8451C38.7881 26.8451 36.9851 25.3173 36.3509 23.5236L33.5147 24.9841C34.3841 27.3095 36.9851 30 41.4248 30C46.7979 30 50.0368 26.2815 50.0368 21.9319V5.77809H46.6982V8.00426C45.5972 6.54378 43.3275 5.48033 40.9901 5.48033C36.3509 5.48033 32.6453 8.83375 32.6453 14.3141C32.6453 19.4931 36.2832 23.0805 40.9901 23.0805C43.4593 23.0805 45.6613 21.9851 46.6982 20.5884V22.095C46.6982 24.7501 44.6957 26.8451 41.4248 26.8451Z" fill="#222C78" />
					<path d="M14.4021 0.0663338C22.355 0.0663338 28.8042 6.40951 28.8042 14.2316C28.8042 22.0537 22.355 28.3969 14.4021 28.3969C6.44923 28.3969 0 22.0572 0 14.2316C0 6.40601 6.44923 0.0663338 14.4021 0.0663338Z" fill="#222C78" />
					<path d="M10.244 15.2783L5.05615 21.7512L12.5565 18.1567L14.4022 26.2283L16.255 18.1567L10.244 15.2783ZM17.7408 11.6873L19.5937 3.61574L14.4058 10.0886L18.5675 15.2783L26.0643 11.6873H17.7444H17.7408Z" fill="white" />
					<path d="M23.7516 21.7512L9.21412 3.61574L11.0741 11.6909L2.74707 11.6873L23.7516 21.7512Z" fill="#87BD25" />
				</g>
				<defs>
					<clipPath id="clip0_2582_717">
						<rect width="101" height="30" fill="white" />
					</clipPath>
				</defs>
			</svg>
		</a>
		<button id="mobile-menu-close" class="p-2 text-blue focus:outline-none rounded" aria-label="Menu sluiten">
			<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
			</svg>
		</button>
	</div>

	<div class="flex-1 overflow-y-auto px-4 pb-6 custom-scrollbar">

		<div class="bg-white rounded-usp-md p-5 shadow-sm flex flex-col min-h-full">

			<nav>
				<ul class="flex flex-col gap-2">
					<?php if ($primary_menu_items): foreach ($primary_menu_items as $item):
							$has_children = !empty($item['children']);
							$is_services_archive = (strpos($item['url'], '/diensten') !== false);
							$has_dropdown = $has_children || ($is_services_archive && $show_mega_menu);
					?>
							<li class="flex flex-col border-b border-gray-50 last:border-b-0">
								<?php if ($has_dropdown): ?>
									<button class="mobile-accordion-trigger flex items-center justify-between py-4 text-xl font-medium text-blue focus:outline-none  rounded text-left cursor-pointer" aria-expanded="false">
										<span><?= esc_html($item['title']) ?></span>
										<svg class="w-5 h-5 transition-transform duration-300 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
										</svg>
									</button>

									<div class="mobile-accordion-content hidden flex-col gap-3 pb-4 px-4 border border-blue/10 rounded-lg pt-3">
										<?php
										if ($is_services_archive && $show_mega_menu):
											foreach ($mega_categories as $cat):
												$term = get_term($cat['category']);
												if (!$term || is_wp_error($term)) continue;
												$services = $cat['show_all_services'] ? get_posts(['post_type' => 'service', 'tax_query' => [['taxonomy' => 'service_type', 'field' => 'term_id', 'terms' => $term->term_id]], 'numberposts' => -1]) : (is_array($cat['services']) ? get_posts(['post_type' => 'service', 'post__in' => $cat['services']]) : []);
										?>
												<div class="mt-3">
													<span class="text-sm font-bold text-black/30 uppercase tracking-wider block mb-2"><?= esc_html($term->name) ?></span>
													<ul class="flex flex-col pl-4 ">
														<?php foreach ($services as $service): ?>
															<li><a href="<?= get_permalink($service->ID) ?>" class="text-base text-blue hover:underline font-semibold py-3 block"><?= get_the_title($service->ID) ?></a></li>
														<?php endforeach; ?>
													</ul>
												</div>
											<?php
											endforeach;
										elseif ($has_children):
											foreach ($item['children'] as $child):
											?>
												<a href="<?= esc_url($child['url']) ?>" <?= $child['target'] ?> class="text-base text-blue font-semibold py-3 block pl-4"><?= esc_html($child['title']) ?></a>
										<?php
											endforeach;
										endif;
										?>

										<?php
										get_template_part('components/button', null, [
											'color' => 'blue',
											'url'   => $item['url'],
											'text'  => 'Bekijk het overzicht'
										]);
										?>
									</div>
								<?php else: ?>
									<a href="<?= esc_url($item['url']) ?>" <?= $item['target'] ?> class="py-4 text-xl font-medium text-blue block focus:outline-none rounded">
										<?= esc_html($item['title']) ?>
									</a>
								<?php endif; ?>
							</li>
					<?php endforeach;
					endif; ?>
				</ul>
			</nav>

			<div class="mt-auto pt-8 border-t border-gray-50 flex flex-col gap-4">
				<?php if ($tel): ?>
					<a href="tel:<?= esc_attr(preg_replace('/[^0-9+]/', '', $tel)) ?>" class="text-blue font-semibold text-lg flex items-center gap-3">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-green" viewBox="0 0 15 14" fill="none">
							<path d="M10.625 8.16667L8.81251 9.275C7.24201 8.45168 5.94461 7.2408 5.0625 5.775L6.25 4.08333L5 1.16667H2.5L1.3125 2.275C1.58956 4.97217 2.86383 7.49525 4.91661 9.41115C6.96939 11.3271 9.6727 12.5164 12.5625 12.775L13.75 11.6667V9.33333L10.625 8.16667Z" fill="currentColor" stroke="currentColor" stroke-miterlimit="10" />
						</svg>
						<?= esc_html($tel) ?>
					</a>
				<?php endif; ?>

				<?php if ($mail): ?>
					<a href="mailto:<?= esc_attr($mail) ?>" class="text-blue  font-semibold text-lg flex items-center gap-3">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-5 text-green stroke-white" viewBox="0 0 15 15" fill="none">
							<path d="M15 1.97377H0.000244141V13.0262H15V1.97377Z" fill="currentColor" stroke-miterlimit="10" />
							<path d="M0.000244141 1.97377L7.50012 7.5L15 1.97377" fill="currentColor" />
							<path d="M0.000244141 1.97377L7.50012 7.5L15 1.97377" stroke-miterlimit="10" />
						</svg>
						<?= esc_html($mail) ?>
					</a>
				<?php endif; ?>

				<?php if ($show_vacancies && $vacancy_archive): ?>
					<a href="<?= esc_url($vacancy_archive) ?>" class="text-blue font-semibold text-lg flex items-start gap-1">
						Vacatures
						<span class="bg-green rounded-full text-white text-4xs leading-none w-3 h-3 flex justify-center items-center aspect-square "><span><?= esc_html($vacancy_count) ?></span></span>
					</a>
				<?php endif; ?>
			</div>

			<div class="mt-8 flex flex-col gap-3">
				<?php if ($contact_btn): ?>
					<?php
					get_template_part('components/button', null, [
						'color'        => 'blue',
						'link'         => $contact_btn,
						'type'         => 'without-icon',
						'extraClasses' => 'w-full [&>div:first-child]:flex-1 [&>div:first-child]:justify-center',
					]);
					?>
				<?php endif; ?>

				<?php if ($search_btn): ?>
					<?php
					get_template_part('components/button', null, [
						'color'        => 'white-border',
						'type'         => 'with-icon',
						'url'          => $search_btn['url'],
						'text'         => !empty($search_btn['title']) ? $search_btn['title'] : 'Zoeken',
						'icon'         => 'custom',
						'rotation'     => '0deg',
						'customIcon'   => '<svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none"> <circle cx="7.95408" cy="7.95408" r="7.20408" stroke="#222C78" stroke-width="1.5"/> <path d="M12.7534 13.7019L18.0517 19.0002" stroke="#222C78" stroke-width="1.5" stroke-linecap="round"/></svg>',
						'extraClasses' => 'w-full [&>div:first-child]:flex-1 [&>div:first-child]:justify-start',
					]);
					?>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>

<div id="mobile-nav-overlay" class="fixed inset-0 bg-black/50 z-90 opacity-0 invisible transition-all duration-500 xl:hidden"></div>