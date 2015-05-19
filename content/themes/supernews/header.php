<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header container clearfix" role="banner" <?php hybrid_attr( 'header' ); ?>>
		
		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

		<?php supernews_site_branding(); // Get the site title/logo. ?>

		<?php if ( of_get_option( 'supernews_header_ads' ) ) : ?>
			<div class="header-ad">
				<?php echo stripslashes( of_get_option( 'supernews_header_ads' ) ); ?>
			</div>
		<?php endif; ?>

		<div class="clearfix"></div>

		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

	</header><!-- #masthead -->

	<main id="main" class="site-main container" role="main" style="display:block;">
