<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package huftgold
 * @since huftgold 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="row">
		<div class="three columns offset-by-one">
			<div class="row">
				<div class="ten columns end">
					<div class="sidebar">
						<header class="navbar" role="banner">
						    <div class="navbar-inner">
					    		<a class="brand" href="<?php echo home_url( '/' ); ?>"title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					    			edbury <span class="io">i/o</span>
					    		</a>
						    </div>
					    </header>
					</div>
				</div>
			</div>
		</div>

		<div class="seven columns end">

			<div id="page" class="hfeed site">

				<div id="main" class="site-main">