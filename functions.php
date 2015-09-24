<?php
/**
 * functions and definitions.
 *
 * @package mecare
 */

// Enable Featured Image Support
add_theme_support( 'post-thumbnails' );

// Multi Thumbnails
if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(
		array(
			'label' 	=> 'Uitgelichte afbeelding 2',
			'id' 		=> 'secondary-image',
			'post_type' => 'page'
		)
	);
}

// Add Quote meta box to the page
add_action( 'add_meta_boxes', 'add_quote_meta_page' );
function add_quote_meta_page(){
	add_meta_box( 'top-page-quotes', 'Top Quote', 'tvds_top_quote_page_meta_cb', 'page', 'normal', 'high' );
	add_meta_box( 'bottom-page-quotes', 'Bottom Quote', 'tvds_bottom_quote_page_meta_cb', 'page', 'normal', 'high' );
}

function tvds_top_quote_page_meta_cb(){
	global $post;
	?>

	<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" >
		<tbody>
		<tr class="form-field">
			<td>
				<textarea name="_top_page_quote" id="top-quote" rows="1" placeholder="write a quote" style="resize: vertical; width: 100%"><?php echo get_post_meta($post->ID, '_top_page_quote', true); ?></textarea>
			</td>
		</tr>
		</tbody>
	</table>
	<?php
}

function tvds_bottom_quote_page_meta_cb(){
	global $post;
	?>

	<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" >
		<tbody>
		<tr class="form-field">
			<td>
				<textarea name="_bottom_page_quote" id="bottom-quote" rows="1" placeholder="write a quote" style="resize: vertical; width: 100%"><?php echo get_post_meta($post->ID, '_bottom_page_quote', true); ?></textarea>
			</td>
		</tr>
		</tbody>
	</table>
<?php
}

function save_quote_page_meta($post_id){
	// Checks save status
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = (isset($_POST['labels_nonce']) && wp_verify_nonce($_POST['labels_nonce'], basename(__FILE__))) ? 'true' : 'false';

	// Exits script depending on save status
	if($is_autosave || $is_revision || !$is_valid_nonce){
		return;
	}
	if(isset($_POST[ '_top_page_quote' ])){
		update_post_meta($post_id, '_top_page_quote', $_POST['_top_page_quote']);
	}
	if(isset($_POST[ '_bottom_page_quote' ])){
		update_post_meta($post_id, '_bottom_page_quote', $_POST['_bottom_page_quote']);
	}
}
add_action('save_post', 'save_quote_page_meta');



// Enqueue the scripts and styles

// SCRIPTS
add_action('wp_enqueue_scripts', 'add_my_custom_scripts');
function add_my_custom_scripts(){
	// de-register stock jquery
	wp_deregister_script( 'jquery' );

	// register for all
	wp_register_script('my_jquery' ,get_stylesheet_directory_uri().'/includes/jquery/jquery.1.11.1.min.js', false);
	wp_register_script('my_bootstrap_js' ,get_stylesheet_directory_uri().'/includes/bootstrap/js/bootstrap.min.js', false);
	wp_register_script('my_javascript' ,get_stylesheet_directory_uri().'/includes/js/javascript.js', false);

	// enqueue
	wp_enqueue_script('my_jquery');
	wp_enqueue_script('my_bootstrap_js');
	wp_enqueue_script('my_javascript');
}

// STYLES
add_action('wp_enqueue_scripts', 'add_my_custom_styles');
function add_my_custom_styles(){
	//register
	wp_register_style('my_stylesheet', get_stylesheet_directory_uri().'/includes/css/style.css');
	wp_register_style('my_style_map', get_stylesheet_directory_uri().'/includes/css/style.css.map');
	wp_register_style('my_bootstrap', get_stylesheet_directory_uri().'/includes/bootstrap/css/bootstrap.min.css');

	//enqueue
	wp_enqueue_style('my_stylesheet');
	wp_enqueue_style('my_style_map');
	wp_enqueue_style('my_bootstrap');
}

// Include the praktijk custom post type
include_once('theme-files/custom-post-types/praktijk-cpt.php');

// Include the behandelingen custom post type
include_once('theme-files/custom-post-types/behandelingen-cpt.php');

