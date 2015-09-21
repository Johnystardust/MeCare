<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package modularcontent
 */

?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>Me Care - zorg voor je ik</title>

	<?php wp_head(); ?>
</head>
<body>
	<!-- Nav -->
	<div class="container-fluid no-padding main-nav">
		<div class="container">
			<div class="nav-logo">

				<img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/images/mecarenavlogo.png" height="50px"/>
			</div>
		</div>
	</div>