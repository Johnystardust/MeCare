<?php
/**
 * modularcontent functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package modularcontent
 */

// Enqueue the scripts and styles

// SCRIPTS
add_action('wp_enqueue_scripts', 'add_my_custom_scripts');
function add_my_custom_scripts(){
	// de-register stock jquery
	wp_deregister_script( 'jquery' );

	// register for all
	wp_register_script('my_jquery' ,get_stylesheet_directory_uri().'/includes/jquery/jquery.1.11.1.min.js', false);
	wp_register_script('my_bootstrap_js' ,get_stylesheet_directory_uri().'/includes/bootstrap/js/bootstrap.min.js', false);

	// enqueue
	wp_enqueue_script('my_jquery');
	wp_enqueue_script('my_bootstrap_js');
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

add_action('init', 'create_behandelingen_post_type' );
function create_behandelingen_post_type() {
    $labels = array(
        'name'               => 'Behandelingen',
        'singular_name'      => 'Behandeling',
        'add_new'            => 'Add New', 'Behandeling',
        'add_new_item'       => 'Add New Behandeling',
        'edit_item'          => 'Edit Behandeling',
        'new_item'           => 'New Behandeling',
        'all_items'          => 'All Behandelingen',
        'view_item'          => 'View Behandeling',
        'search_items'       => 'Search Behandelingen',
        'not_found'          => 'No behandelingen found',
        'not_found_in_trash' => 'No behandelingen found in the Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Behandelingen'
    );
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'menu_position'         => 6,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'           => true,
        'register_meta_box_cb'  => 'add_meta_boxes',
        'taxonomies'            => array('category')
    );
    register_post_type( 'behandelingen', $args);
}

function add_meta_boxes(){
    add_meta_box('behandeling_icon', 'Icon', 'behandeling_icon_meta_cb', 'behandelingen', 'normal', 'default');
}

function behandeling_icon_meta_cb(){
    global $post;

    $image_src = '';

    $image_id = get_post_meta( $post->ID, '_behandeling_icon', true );
    $image_src = wp_get_attachment_url( $image_id );

    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
        <tbody>


        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="behandeling-icon">Behandeling Icon</label>
            </th>
            <td>
                <img id="behandeling-icon" src="<?php echo $image_src ?>" style="max-width:100%;" />
                <input type="hidden" name="upload_behandeling_icon_id" id="upload_behandeling_icon_id" value="<?php echo $image_id; ?>" />
                <p>
                    <a class="button" title="<?php esc_attr_e( 'Set Behandeling Icon' ) ?>" href="#" id="set-behandeling-icon"><?php _e( 'Set Behandeling Icon' ) ?></a>
                    <a class="button" title="<?php esc_attr_e( 'Remove Behandeling Icon' ) ?>" href="#" id="remove-behandeling-icon" style="<?php echo ( ! $image_id ? 'display:none;' : '' ); ?>"><?php _e( 'Remove Behandeling Icon' ) ?></a>
                </p>
            </td>
        </tr>

        <script type="text/javascript">
            jQuery(document).ready(function($) {

                // save the send_to_editor handler function
                window.send_to_editor_default = window.send_to_editor;

                // Set the image
                $('#set-behandeling-icon').click(function(){
                    // replace the default send_to_editor handler function with our own
                    window.send_to_editor = window.attach_image;
                    tb_show('', 'media-upload.php?post_id=<?php echo $post->ID ?>&amp;type=image&amp;TB_iframe=true');

                    return false;
                });

                // Remove the image
                $('#remove-behandeling-icon').click(function() {

                    $('#upload_behandeling_icon_id').val('');              // Clear the value of the upload ID
                    $('#behandeling-icon').attr('src', '');                // Clear the image attribute
                    $(this).hide();                                 // Hide the remove button

                    return false;
                });

                // handler function which is invoked after the user selects an image from the gallery popup.
                // this function displays the image and sets the id so it can be persisted to the post meta
                window.attach_image = function(html) {

                    // turn the returned image html into a hidden image element so we can easily pull the relevant attributes we need
                    $('body').append('<div id="temp_image">' + html + '</div>');

                    var img = $('#temp_image').find('img');

                    imgurl   = img.attr('src');
                    imgclass = img.attr('class');
                    imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);

                    $('#upload_behandeling_icon_id').val(imgid);
                    $('#remove-behandeling-icon').show();

                    $('img#behandeling-icon').attr('src', imgurl);
                    try{tb_remove();}catch(e){};
                    $('#temp_image').remove();

                    // restore the send_to_editor handler function
                    window.send_to_editor = window.send_to_editor_default;
                }

            });
        </script>
        </tbody>
    </table>
<?php
}

function save_behandeling_meta($post_id){
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['labels_nonce']) && wp_verify_nonce($_POST['labels_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }
    if(isset($_POST[ 'upload_behandeling_icon_id' ])){
        update_post_meta($post_id, '_behandeling_icon', $_POST['upload_behandeling_icon_id']);
    }
}
add_action('save_post', 'save_behandeling_meta');