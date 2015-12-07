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

			<?php
			$args = array(
				'theme_location'  => 'main-menu',
				'menu'            => '',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '<div class="table-wrapper">',
				'after'           => '</div>',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s active">%3$s</ul>',
				'depth'           => '',
				'walker'          => ''
			);

			wp_nav_menu($args);
			?>
		</div>

		<div class="nav-logo">
			<a href="<?php echo site_url(); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/includes/images/mecarenavlogo.png" height="50px"/>
			</a>
		</div>
	</div>

	<!-- Go up -->
	<a class="go-up text-center">
		<i class="icon-up-open"></i>
	</a>