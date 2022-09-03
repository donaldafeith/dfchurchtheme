<?php
/**
 * The Front Page template file
 * Template Name: Front Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DFChurchTheme
 */
get_header();
?>
<main class="main-content">
	<div class="fullwidth-block">
		<div class="container">
			<h2 class="section-title">Recent news</h2>
			<div class="row">
				<?php
				if ( have_posts() ) :
					if ( is_home() && ! is_front_page() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						<?php
						endif;
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-frontpage', get_post_type() );
			endwhile;
			the_posts_navigation();
			else :
				get_template_part( 'template-parts/content-frontpage', 'none' );
			endif;
			?>
			<div class="fullwidth-block">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<h2 class="section-title">Upcoming events</h2>
							<?php if ( is_active_sidebar( 'upcoming-events' ) ) : ?>
								<div id="upcoming-events" class="upcoming-events widget-area" role="complementary">
									<?php dynamic_sidebar( 'upcoming-events' ); ?>
								</div>
								<!-- #Calendar -->
								<?php endif; ?>
							</div>
							<div class="col-md-6">
								<h2 class="section-title">Latest seremons</h2>
								<?php if ( is_active_sidebar( 'latest' ) ) : ?>
									<div id="latest" class="latest widget-area" role="complementary">
										<?php dynamic_sidebar( 'latest' ); ?>
									</div>
									<!-- #Sermons -->
									<?php endif; ?>
								</div>
							</div>
							<!-- .row -->
						</div>
						<!-- .container -->
					</div>
					<!-- section -->
				</main>
				<!-- .main-content -->
				<?php
				get_footer();
				?>
