<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DFChurchTheme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header class="site-header">
		<div class="container">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif;
				$dfchurchtheme_description = get_bloginfo( 'description', 'display' );
				if ( $dfchurchtheme_description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $dfchurchtheme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
				<div class="main-navigation">
					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'dfchurchtheme' ); ?></button>
						<?php 
						wp_nav_menu(array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',));
							?>
							</nav>
							<!-- #site-navigation -->
						</div>
						<div class="mobile-navigation"></div>
					</div>
					<!-- .site-header -->
					<div class="hero">
						<div class="slides">
							<?php 
							if ( is_home() ): $sticky = get_option('sticky_posts');
							$slider = new wp_query( array( 'post__in' => $sticky ) );
							?>
							<?php if ($slider->have_posts()): $count = 0; ?>
							<div id="slider">
								<div id="mask">
									<?php while ( $slider->have_posts() ): $slider->the_post(); $count++; ?>
									<div class="items">
										<?php the_post_thumbnail( array( 320, 213 ) ); ?>
										<div class="info" style="background-image ('<?php the_post_thumbnail( array( 320, 213 ) ); ?>');">
											<h2><?php the_title(); ?></h2>
											<?php the_excerpt(); ?>
										</div>
									</div>
									<?php endwhile; ?>
								</div>
								<div class="handle">
									<?php for ($count; $count > 0; $count--): ?>
										<a>&bull;</a>
										<?php endfor; ?>
									</div>
								</div>
								<?php endif; ?>
								<?php
								$args = array_merge( $wp_query->query, array( 'post__not_in' => $sticky ) );
								query_posts( $args );
								?>
								<?php endif; ?>
							</div>
						</header>
						<!-- #masthead -->
