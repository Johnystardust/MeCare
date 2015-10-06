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

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,400italic,700,500' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>
</head>
<body>
	<!-- Nav -->
	<div class="container-fluid no-padding main-nav">
		<div class="nav-menu">
			<li class="toggle-item">
				<div class="table-wrapper">
					<a class="toggle-nav" href="#">&#9776;</a>
				</div>
			</li>

			<ul class="active">
				<li class="menu-item"><div class="table-wrapper"><a href="<?php echo site_url(); ?>">Home</a></div></li>

				<li class="menu-item menu-dropdown">
					<div class="table-wrapper"><a href="<?php echo get_page_link(46); ?>">De Praktijk</a></div>
					<ul class="dropdown-container">
						<li><a href="<?php echo get_page_link(45); ?>">Visie</a></li>
						<li><a href="<?php echo get_page_link(48); ?>">Over mij</a></li>
						<li><a href="<?php echo get_page_link(83); ?>">Gastenboek</a></li>
						<li><a href="<?php echo get_page_link(49); ?>">Bronnen</a></li>
					</ul>
				</li>

				<li class="menu-item"><div class="table-wrapper"><a href="<?php echo get_page_link(43); ?>">Bodycheck</a></div></li>

				<li class="menu-item menu-dropdown">
					<div class="table-wrapper"><a href="<?php echo get_page_link(5); ?>">Behandelingen</a></div>
					<ul class="dropdown-container">
						<li><a href="<?php echo get_page_link(31); ?>">Bioresonantie</a></li>
						<li><a href="<?php echo get_page_link(33); ?>">Ontzuring</a></li>
						<li><a href="<?php echo get_page_link(36); ?>">Massages</a></li>
						<li><a href="<?php echo get_page_link(37); ?>">Bach Bloesem</a></li>
						<li><a href="<?php echo get_page_link(38); ?>">Schüssler celzout</a></li>
						<li><a href="<?php echo get_page_link(39); ?>">Coaching</a></li>

					</ul>
				</li>

				<li class="menu-item"><div class="table-wrapper"><a href="<?php echo get_page_link(41); ?>">Tarieven</a></div></li>
				<li class="menu-item"><div class="table-wrapper"><a href="<?php echo get_page_link(51); ?>">Contact</a></div></li>
			</ul>
		</div>

		<div class="nav-logo">
			<a href="<?php echo site_url(); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/images/mecarenavlogo.png" height="50px"/>
			</a>
		</div>
	</div>