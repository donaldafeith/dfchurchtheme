<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DFChurchTheme
 */
?>
<div class="col-md-3 col-sm-6">
	<div class="news">
		<article id="front-page-post post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php dfchurchtheme_post_thumbnail(); ?>
		<div class="entry-content">
			<?php
			the_excerpt();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dfchurchtheme' ),
					'after'  => '</div>',));
					?>
					<?php if ( get_edit_post_link() ) : ?>
					<?php
					edit_post_link(
						sprintf(
							wp_kses( /* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'dfchurchtheme' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						),
					);
					?>
					<!-- .entry-footer -->
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- .entry-content -->
	</article>
	<!-- #post-<?php the_ID(); ?> -->
