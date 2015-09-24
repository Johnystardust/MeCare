<?php
/**
 * The template for displaying the footer.
 *
 * @package mecare
 */
?>
	<!-- Footer-->
	<footer>
		<div class="container-fluid no-padding footer">
			<?php
				if(is_home()){
					get_template_part( 'template-parts/footer/home-footer' );
				}
				if(is_page()){
					get_template_part( 'template-parts/footer/page-footer');
				}
				if(is_single()){
					get_template_part( 'template-parts/footer/single-footer');
				}
			?>

			<div class="container">
				<div class="footer-links">
					<small>© 2015 Copyright MeCare | Design and Development by <a href="http://www.rigid-webdesign.nl" target="_blank">Rigid-Webdesign</a></small>
				</div>
			</div>
		</div>
	</footer>

</body>
</html>
