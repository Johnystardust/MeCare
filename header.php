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
	<title>Me Care - <?php if(is_home()){ echo 'Zorg voor je ik'; } else { the_title(); } ?></title>

	<?php wp_head(); ?>
</head>
<body>
	<!-- Nav -->
	<div class="container-fluid no-padding main-nav">
		<div class="container">
			<div class="nav-logo">
				<a href="<?php echo site_url(); ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/images/mecarenavlogo.png" height="50px"/>
				</a>
			</div>

			<div class="nav-menu">
				<ul>
					<li><a href="<?php echo site_url(); ?>">Home</a></li>

					<li class="menu-dropdown">
						<a href="<?php echo get_page_link(46); ?>">De Praktijk</a>
						<ul>
							<li><a href="<?php echo get_page_link(45); ?>">Visie</a></li>
							<li><a href="<?php echo get_page_link(48); ?>">Over mij</a></li>
							<li><a href="<?php echo get_page_link(49); ?>">Bronnen</a></li>
						</ul>
					</li>

					<li><a href="<?php echo get_page_link(43); ?>">Bodycheck</a></li>
					<li><a href="<?php echo get_page_link(5); ?>">Behandelingen</a></li>
					<li><a href="<?php echo get_page_link(41); ?>">Tarieven</a></li>
					<li><a href="<?php echo get_page_link(51); ?>">Contact</a></li>
				</ul>
			</div>
		</div>
	</div>