<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Load_Lifter
 */


add_action( 'wp_head', function() {
	echo '<link rel="icon" href="/favicon.ico" sizes="32x32" />' . "\r\n";
	echo '<link rel="icon" href="/icon.svg" type="image/svg+xml" />' . "\r\n";
	echo '<link rel="apple-touch-icon" href="/apple-touch-icon.png" />' . "\r\n";
	// echo '<link rel="manifest" href="/manifest.webmanifest" />' . "\r\n";
});


if ( ! function_exists( 'll_show_social_links' ) ) :
	/**
	 * Outputs linked social icons (from FA)
	 */
	function ll_show_social_links() {

		$social_html = '<div class="social-links | fill-current inline-flex items-center justify-start gap-4">';

			$social_html .= '<a href="https://www.linkedin.com/company/kuadra-support/" class="duration-200 ease-in-out hover:scale-125" aria-labelledby="soclink-linkedin">
				<i class="w-8 h-8 fa-brands fa-linkedin-in"></i>
				<span id="soclink-linkedin" class="sr-only">LinkedIn</span>
			</a>
			<a href="https://www.facebook.com/kuadrasupport" class="duration-200 ease-in-out hover:scale-125" aria-labelledby="soclink-facebook">
				<i class="w-8 h-8 fa-brands fa-facebook"></i>
				<span id="soclink-facebook" class="sr-only">Facebook</span>
			</a>
			<a href="https://instagram.com/kuadrasupport" class="duration-200 ease-in-out hover:scale-125" aria-labelledby="soclink-instagram">
				<i class="w-8 h-8 fa-brands fa-instagram"></i>
				<span id="soclink-instagram" class="sr-only">Instagram</span>
			</a>';

			$social_html .= '</div>';

		return $social_html;
	}
endif;


if ( ! function_exists( 'll_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function ll_posted_on() {
		$time_string = '<time class="entry-date" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'YY "/" mm "/" dd' ) !== get_the_modified_time( 'YY "/" mm "/" dd' ) ) {
			$time_string = '<time class="entry-date date-published" datetime="%1$s">%2$s</time> <time class="date-updated font-bold" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( '%s', 'post date', 'loadlifter' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="timestamp">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;


if ( ! function_exists( 'll_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ll_posted_by( $options = array() ) {
		$defaults = array(
			'show_thumb' => false,
		);
		$config = array_merge( $defaults, $options );

		if( function_exists( 'coauthors_posts_links' ) ) {
			if( $config['show_thumb']) {
				$coauthors = get_coauthors();
				echo <<<EOT
				<div class="print:break-inside-avoid"><h3>Authored by:</h3>
				<div class="flex items-center justify-center w-full py-4 print:justify-start">
					<div class="flex -space-x-3">
				EOT;
				foreach( $coauthors as $coauthor ) {

					$avatar = get_field( 'll_user_headshot', 'user_' . $coauthor->ID );

					if( !empty( $avatar ) ) {
						$avatar_markup = sprintf( '<a href="/author/%3$s" class="relative inline-flex items-center justify-center text-white w-30 rounded-2xl" aria-label="Visit %2$s\'s author page"><img src="%1$s" alt="%2$s" title="%2$s" width="120" height="159" class="max-w-full border-2 border-white rounded-2xl" /></a>', $avatar['url'], $coauthor->display_name, $coauthor->user_nicename );
					} else {
						$avatar_markup = sprintf( '<a href="/author/%2$s" class="relative border-2 border-white text-neutral-100 bg-neutral-400 rounded-2xl" aria-label="Visit %2$s\'s author page"><div class="inline-flex items-center justify-center px-4 w-[120px] aspect-headshot" title="%1$s"><i class="fa-regular fa-user fa-2x"></i></div></a>', $coauthor->display_name, $coauthor->user_nicename );
					}

					echo $avatar_markup;
				}
				echo <<<EOT
					</div>
				</div></div>
				EOT;
			} else {
				coauthors_posts_links(); // plain jane list
			}
		} else {
			the_author_posts_link();
		}
	}
endif;

if ( ! function_exists( 'll_posted_by_cards' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ll_posted_by_cards( $options = array() ) {
		$defaults = array(
			'show_thumb' => false,
		);
		$config = array_merge( $defaults, $options );

		if( function_exists( 'coauthors_posts_links' ) ) {
			if( $config['show_thumb']) {
				$coauthors = get_coauthors();
				echo <<<EOT
					<div class="print:break-inside-avoid"><h3>Authored by:</h3>
					<ul class="mt-4 mb-8 list-none grid grid-cols-1 gap-2 lg:gap-4">
					EOT;
					foreach( $coauthors as $coauthor ) {

						$avatar = get_field( 'll_user_headshot', 'user_' . $coauthor->ID );
						$title = get_field( 'll_user_title', 'user_' . $coauthor->ID );
						$desigs = get_field( 'll_user_designations', 'user_' . $coauthor->ID );

						if( !empty( $avatar ) ) {
							// $avatar_markup = sprintf( '<a href="/author/%3$s" class="relative inline-flex items-center justify-center text-white w-30 rounded-2xl" aria-label="Visit %2$s\'s author page"><img src="%1$s" alt="%2$s" title="%2$s" width="120" height="159" class="max-w-full border-2 border-white rounded-2xl" /></a>', $avatar['url'], $coauthor->display_name, $coauthor->user_nicename );


							$avatar_markup = '<li class="person-card | group @container">
								<div class="flex flex-col @2xs:flex-row gap-3 items-center h-full p-4 border rounded-lg border-neutral-200 lg:flex-row dark:border-neutral-600">

									<div class="card-text | grow order-1 ">
										<h3 class="font-semibold text-xl lg:text-2xl leading-none! text-brand-gray-dark group-hover:text-aqua-500 dark:text-neutral-400">
											<a href="/author/' . $coauthor->user_nicename . '/" rel="bookmark">' . $coauthor->display_name . '</a> <small class="font-normal text-ellipsis overflow-hidden">' . $desigs . '</small>
										</h3>
										<p class="text-lg leading-tight text-neutral-600 font-head dark:text-neutral-500">' . $title . '</p>
									</div>

									<div class="card-img | shrink-0 object-cover object-center rounded-full bg-neutral-100 group-hover:border-aqua-500" style="background-image: url(' . $avatar['url'] . '); background-size: 64px 86px; background-position: center top;">
										<a href="/author/' . $coauthor->user_nicename . '/" rel="bookmark" aria-label="View ' . $coauthor->display_name . '&apos;s bio">
											<div class="w-16 h-16 aspect-square">&nbsp;</div>
										</a>
									</div>

								</div>
							</li>';

						} else {
							// $avatar_markup = sprintf( '<a href="/author/%2$s" class="relative border-2 border-white text-neutral-100 bg-neutral-400 rounded-2xl" aria-label="Visit %2$s\'s author page"><div class="inline-flex items-center justify-center px-4 w-[120px] aspect-headshot" title="%1$s"><i class="fa-regular fa-user fa-2x"></i></div></a>', $coauthor->display_name, $coauthor->user_nicename );
							$avatar_markup = '<li class="person-card | group @container">
								<div class="flex flex-col @2xs:flex-row gap-3 items-center h-full p-4 border rounded-lg border-neutral-200 lg:flex-row dark:border-neutral-600">

									<div class="card-text | grow order-1 ">
										<h3 class="font-semibold text-xl lg:text-2xl leading-none! text-brand-gray-dark group-hover:text-aqua-500 dark:text-neutral-400">
											<a href="/author/' . $coauthor->user_nicename . '/" rel="bookmark">' . $coauthor->display_name . '</a> <small class="font-normal text-ellipsis overflow-hidden">' . $desigs . '</small>
										</h3>
										<p class="text-lg leading-tight text-neutral-600 font-head dark:text-neutral-500">' . $title . '</p>
									</div>

									<div class="card-img | shrink-0 object-cover object-center rounded-full bg-neutral-200 group-hover:border-aqua-500 dark:bg-neutral-600">
										<a href="/author/' . $coauthor->user_nicename . '/" rel="bookmark" aria-label="View ' . $coauthor->display_name . '&apos;s bio">
											<div class="w-16 h-16 aspect-square">&nbsp;</div>
										</a>
									</div>

								</div>
							</li>';
						}

						echo $avatar_markup;
					}
					echo <<<EOT
					</ul>
				</div>
				EOT;
			} else {
				coauthors_posts_links(); // plain jane list
			}
		} else {
			the_author_posts_link();
		}
	}
endif;


if ( ! function_exists( 'll_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ll_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'loadlifter' ) );
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'loadlifter' ) );

			echo '<div class="my-8"><h3 class="mb-2">' . __( 'Related topics', 'loadlifter' ) . '</h3>';

			if ( $categories_list ) {
				printf( '<span class="catlist lg:mb-2">' . esc_html__( 'Posted in: %1$s', 'loadlifter' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			if ( $categories_list && $tags_list ) {
				printf( '<div>&nbsp;</div>' );
			}

			if ( $tags_list ) {
				printf( '<span class="list--tags | ">' . esc_html__( 'Tagged: %1$s', 'loadlifter' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			echo '</div>';
		}
	}
endif;


if ( ! function_exists( 'll_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function ll_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div>
				<?php the_post_thumbnail(); ?>
			</div>

		<?php else : ?>

			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
							'class' => 'object-cover w-full',
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;


if ( ! function_exists( 'll_page_title' ) ) :
	function ll_page_title( $h1, $h2 ) {
		echo '<div class="px-2 container xl:px-4">
			<h1 class="leading-none tracking-light">'.$h1.'</h1>
			<h2 class="mt-4 leading-normal max-w-[42ch] text-atlantis-200">'.$h2.'</h2>
		</div>';

		if ( function_exists( 'bcn_display' ) && !is_front_page() ) {
			echo '<ol class="breadcrumbs | px-2 container xl:px-4 font-head text-neutral-600">' . bcn_display( true ) . '</ol>
			</div>';
		}
	}
endif;


if ( ! function_exists( 'll_better_page_hero' ) ) :
	function ll_better_page_hero( $h1, $h2, $cta1_text = null, $cta1_url = null, $cta2_text = null, $cta2_url = null ) {
		?>

		<div class="page-hero  |  wp-block-cover bg-white px-0! min-h-[unset]  |  print:py-8 print:bg-white print:text-black">
			<span aria-hidden="true" class="page-hero-overlay | z-1 absolute top-0 right-0 bottom-0 left-0  | print:hidden"></span>
			<?php echo the_post_thumbnail( 'full', ['class' => 'wp-block-cover__image-background not-transparent wp-post-image print:hidden'] ); ?>

			<div class="wp-block-cover__inner-container  |  px-2  |  lg:px-4 print:px-0!">
				<div class="text-neutral-900 flex flex-col justify-center space-y-6 min-h-[200px]  |  md:min-h-hero print:min-h-min">
					<h1 class="text-neutral-900 leading-none tracking-light text-pretty shadow-neutral-50 drop-shadow-lg  |  lg:print:text-xl! print:text-black dark:text-neutral-100"><?php echo $h1; ?></h1>
					<?php if ( !empty( $h2 ) ) { ?><h2 class="leading-none text-pretty text-neutral-700! shadow-neutral-50 drop-shadow-lg  |  md:max-w-5xl lg:print:text-base! print:text-black! dark:text-atlantis-200!"><?php echo $h2; ?></h2><?php } ?>
				</div>
				<?php if ( !is_front_page() ) { ?>
					<ol class="breadcrumbs  |  list-none mt-4 grow-0 font-head text-neutral-800  |  *:inline md:mt-0 print:mt-8"><?php echo bcn_display( true ); ?></ol>
				<?php } ?>
			</div>
		</div>

		<?php
	}
endif;


/* Used on Posts */
if ( ! function_exists( 'll_featured_image' ) ) :
	/**
	 * Renders a post's featured image above the title and breadcrumbs
	 * This should ONLY be used on blog post... does not contain support for brand images.
	 */
	function ll_featured_image( $options = array() ) {
		$defaults = array(
			'size' => 'full',
		);
		$config = array_merge( $defaults, $options );

		$post_date = strtotime( the_date( 'Y-m-d', '', '', false ) );
		$cutoff_date = strtotime( '2022-03-02' ); // via: https://wordpress.stackexchange.com/questions/110185/if-posted-after-date
		// After 2022-03-02, we started uploading larger featured images. This compensates for that.

		if ( $config['size'] === 'full' ) {
			$feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

			if ( $post_date > $cutoff_date ) {
				$feat_aspect_ratio = 'feat-3.75';
				$bg_size = 'bg-center bg-cover bg-no-repeat';
			} else {
				$feat_aspect_ratio = 'feat-4.3';
				$bg_size = 'bg-center bg-no-repeat';
			}
		} else {
			$feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
			$feat_aspect_ratio = 'feat-card';
			$bg_size = 'bg-center bg-cover bg-no-repeat';
		}

		if ( !$feat_image_url ) {
			$thumb_id = $thumb_url_array = $thumb_url = null;
			// $featmarkup = '';
			if ( is_singular( 'post' ) ) {
				$featmarkup = '';
			} else {
				$featmarkup = sprintf(
					'<div class="image__featured--outer | overflow-hidden empty-feat-img print:hidden">
						<div
							class="image__featured--inner | %4$s aspect-%2$s transition-transform duration-300 ease-in-out group-hover:scale-110"
							style="background-image: url(%1$s);"
							aria-label="%3$s"
							role="img"
						></div>
					</div>',
					esc_url( get_template_directory_uri() . '/img/feat__empty--blog.svg' ),
					esc_attr( $feat_aspect_ratio ),
					esc_attr( get_the_title() ),
					esc_attr( $bg_size ),
				);
			}
		} else {
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'large' );
			$thumb_url = $thumb_url_array[0];
			$featmarkup = sprintf(
				'<div class="image__featured--outer | overflow-hidden print:hidden">
					<div
						class="image__featured--inner | %4$s aspect-%2$s transition-transform duration-300 ease-in-out group-hover:scale-110"
						style="background-image: url(%1$s);"
						aria-label="%3$s"
						role="img"
					></div>
				</div>',
				esc_url( $feat_image_url[0] ),
				esc_attr( $feat_aspect_ratio ),
				esc_attr( get_the_title() ),
				esc_attr( $bg_size ),
			);
		}

		echo $featmarkup;
	}
endif;


/* Used on People */
if ( ! function_exists( 'll_people_headshot' ) ) :
	function ll_people_headshot() {
		$person_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

		if ( !$person_image_url ) {
			if ( is_singular() ) { ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/img/headshot__empty.svg' ); ?>" alt="" />
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/img/headshot__empty.svg' ); ?>" alt="" />
				</a>
			<?php }
		} else {
			if ( is_singular() ) :
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
						'class' => 'relative mx-auto md:mx-0',
					)
				);
			else : ?>
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
						the_post_thumbnail(
							'post-thumbnail',
							array(
								'alt' => the_title_attribute(
									array(
										'echo' => false,
									)
								),
								'class' => 'w-full',
							)
						);
					?>
				</a>
				<?php
			endif; // End is_singular().
		}
	}
endif;


if ( ! function_exists( 'll_people_dept_list' ) ) :
	/**
	 * Display People/Author department(s)
	 */
	function ll_people_show_dept_list( $departments ) {
		echo '<span class="inline-pipe-sep | "><i class="fa-solid fa-people-group text-neutral-500" title="Department(s)"></i> ';
		foreach( $departments as $dept ) {
			echo '<span class="">' . $dept['label'] . '</span>';
		}
		echo '</span>';
	}
endif;

if ( ! function_exists( 'll_people_show_location' ) ) :
	/**
	 * Display People/Author location
	 */
	function ll_people_show_location( $location ) {
		echo '<span class=""><i class="fa-solid fa-location-dot text-neutral-500" title="Location"></i> <span class="">' . esc_html( $location ) . '</span></span>';
	}
endif;


if ( ! function_exists( 'll_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 * Based on paging nav function from Twenty Fourteen
	 * via: https://mor10.com/add-proper-pagination-default-wordpress-themes/
	 */

	function ll_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 3,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&lt; Previous', 'loadlifter' ),
			'next_text' => __( 'Next &gt;', 'loadlifter' ),
			'type'      => 'list',
			'before_page_number' => '<span class="sr-only">' . __( 'Page ', 'loadlifter' ) . '</span>',
		) );

		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h3 class="sr-only"><?php _e( 'Posts navigation', 'loadlifter' ); ?></h3>
				<?php echo $links; ?>
		</nav><!-- .navigation -->
		<?php
		endif;
	}
endif;


if ( ! function_exists( 'll_content_class' ) ) :
	/**
	 * Displays the class names for the post content wrapper.
	 *
	 * This allows us to add Tailwind Typography’s modifier classes throughout
	 * the theme without repeating them in multiple files. (They can be edited
	 * at the top of the `../functions.php` file via the
	 * LL_TYPOGRAPHY_CLASSES constant.)
	 *
	 * Based on WordPress core’s `body_class` and `get_body_class` functions.
	 *
	 * @param array $classes Space-separated string or array of class names to
	 *                     add to the class list.
	 */
	function ll_content_class( $classes = '' ) {
		$all_classes = array( $classes, LL_TYPOGRAPHY_CLASSES );

		foreach ( $all_classes as &$class_groups ) {
			if ( ! empty( $class_groups ) ) {
				if ( ! is_array( $class_groups ) ) {
					$class_groups = preg_split( '#\s+#', $class_groups );
				}
			} else {
				// Ensure that we always coerce class to being an array.
				$class_groups = array();
			}
		}

		$combined_classes = array_merge( $all_classes[0], $all_classes[1] );
		$combined_classes = array_map( 'esc_attr', $combined_classes );

		// Separates class names with a single space, preparing them for the
		// post content wrapper.
		echo 'class="' . esc_attr( implode( ' ', $combined_classes ) ) . '"';
	}
endif;


if ( ! function_exists( 'll_a11y_icon_link' ) ) :
	function ll_a11y_icon_link( $link ) {
		echo '<a href="'. $link['url'] .'" class="duration-200 ease-in-out hover:scale-125" aria-labelledby="soclink-%2$s">
			<i class="'. $link['icon'] .'"></i>
			<span class="sr-only">'. $link['label'] .'</span>
		</a>';
	}
endif;


if ( ! function_exists( 'll_no_link_card' ) ) :
	function ll_no_link_card( $card ) {
		echo '<div>
			<div class="card | relative inline-block float-left w-(--card-size) h-(--card-size) perspective-[600px]" style="--card-back-bg: #092f42">
				<div class="card-content | absolute w-full h-full rounded-lg shadow-lg shadow-neutral-300 transition-transform ease-out duration-700 transform-3d dark:shadow-none">
					<div class="card-front | text-center bg-(--card-front-bg) text-(--card-front-text) absolute w-full h-full flex flex-col items-center justify-center rounded-lg px-4 backface-hidden">
						<div class="card-icon | text-(--card-front-icon)">
							<span class="fa-stack fa-2x">
								<i class="text-white fa-solid fa-circle fa-stack-2x dark:text-neutral-700"></i>
								<i class="fa-duotone ' . $card['icon'] . ' fa-stack-1x "></i>
							</span>
						</div>
						<h3 class="mt-2 font-light leading-none text-current">' . $card['label'] . '</h3>
					</div>
					<div class="card-back | absolute w-full h-full flex flex-col items-center justify-center rounded-lg px-4 bg-(--card-back-bg) text-(--card-back-text) bg-no-repeat bg-cover bg-blend-multiply shadow-neutral-900/50 backface-hidden  [transform:rotateY(180deg)]">
							<h6 class="my-2 leading-none tracking-wide text-center text-current text-shadow">' . $card['label'] . '</h6>
							<p class="text-center text-shadow">' . $card['backContent'] . '</p>
					</div>
				</div>
			</div>
		</div>';
	}
endif;


if ( ! function_exists( 'll_render_hover_card' ) ) :
	function ll_render_hover_card( $card ) {
		echo '<div href="#" class="relative block bg-atlantis-700 group">
			<img alt="' . $card['imgAlt'] . '" src="' . $card['img'] . '" class="absolute inset-0 object-cover w-full h-full transition-opacity opacity-75 group-hover:opacity-25" />

			<div class="relative p-4 sm:p-6 lg:p-8">
				<p class="text-xl font-semibold text-white font-head text-shadow shadow-neutral-700 hover:shadow-atlantis-700 sm:text-2xl ">' . $card['label'] . '</p>

				<div class="mt-8 sm:mt-4 lg:mt-8">
					<div class="prose text-white transition-all transform translate-y-8 opacity-0 text-shadow shadow-atlantis-700 group-hover:translate-y-0 group-hover:opacity-100">' . $card['onHoverContent'] . '</div>
				</div>
			</div>
		</div>';
	}
endif;
