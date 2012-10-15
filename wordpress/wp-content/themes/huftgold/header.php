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
		<div class="four columns">
			<header class="navbar" role="banner">
			    <div class="navbar-inner">
		    		<a class="brand" href="<?php echo home_url( '/' ); ?>"title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			    </div>
		    </header>
		</div>

		<div class="eight columns">

			<div id="page" class="hfeed site">

				<div id="main" class="site-main">