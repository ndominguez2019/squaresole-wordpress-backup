<?php
/**
 * @package WordPress
 * @since Mokko 1.0.0
 */
?>

<div class="<?php echo mokko_header_class(); ?>" id="ms-header">

	<div class="main-header__layout">
		<div class="main-header__inner">
            
			<div class="main-header__logo">
				<div class="logo-dark">
					<?php if (get_theme_mod( 'logo_dark' )): ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( get_theme_mod( 'logo_dark' ) ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
						</a>
					<?php else: ?>
						<div class="ms-logo__default">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<h3><?php bloginfo( 'name' ); ?></h3>
							</a>
						</div>
					<?php endif; ?>
				</div>
				<div class="logo-light">
					<?php if (get_theme_mod( 'logo_light' )): ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( get_theme_mod( 'logo_light' ) ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
						</a>
					<?php else: ?>
					<div class="ms-logo__default">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<h3><?php bloginfo( 'name' ); ?></h3>
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>

			<?php mokko_menu_type(); ?>

		</div>
	</div>
	
</div>