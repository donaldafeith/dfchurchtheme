<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DFChurchTheme
 */

?>
<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="widget">
					<h3 class="widget-title">Our address</h3>
					<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
						<div id="footer1" class="footer1 widget-area" role="complementary">
							<?php dynamic_sidebar( 'footer1' ); ?>
						</div><!-- #Sermons -->
						<?php endif; ?>	
					</div>
				</div>
				<div class="col-md-4">
					<div class="widget">
						<h3 class="widget-title">Topics from last meeting</h3>
						<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
							<div id="footer2" class="footer2 widget-area" role="complementary">
								<?php dynamic_sidebar( 'footer2' ); ?>
							</div><!-- #Sermons -->
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="widget">
							<h3 class="widget-title">Contact form</h3>
							<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
								<div id="footer3" class="footer3 widget-area" role="complementary">
									<?php dynamic_sidebar( 'footer2' ); ?>
								</div><!-- #Sermons -->
								<?php endif; ?>
							</div>
						</div>
					</div>
					<!-- .row -->
					<p class="colophon"><div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dfchurchtheme' ) ); ?>">
						<?php /* translators: %s: CMS name, i.e. WordPress. */
						printf( esc_html__( 'Proudly powered by %s', 'dfchurchtheme' ), 'WordPress' );
						?>
						</a>
						<span class="sep"> | </span>
						<?php /* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'dfchurchtheme' ), 'dfchurchtheme', '<a href="https://github.com/donaldafeith">Donalda</a>' ); ?></p>
						</div><!-- .container -->
					</footer> <!-- .site-footer -->
				</div>
				<?php wp_footer(); ?>
			</body>
			</html>
