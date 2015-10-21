<?php
/**
 * Custom Post Type for praktijk
 */

add_action('init', 'create_praktijk_post_type' );

/**
 * Create & register the custom post type.
 */

function create_praktijk_post_type() {
    $labels = array(
    'name'               => 'De praktijk',
    'singular_name'      => 'De praktijk',
    'add_new'            => 'Add New', 'Praktijk post',
    'add_new_item'       => 'Add New Praktijk post',
    'edit_item'          => 'Edit Praktijk post',
    'new_item'           => 'New Praktijk post',
    'all_items'          => 'All Praktijk posts',
    'view_item'          => 'View Praktijk post',
    'search_items'       => 'Search Praktijk posts',
    'not_found'          => 'No Praktijk posts found',
    'not_found_in_trash' => 'No Praktijk posts found in the Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'De praktijk'
    );
    $args = array(
    'labels'                => $labels,
    'public'                => true,
    'menu_position'         => 6,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'           => false,
    'register_meta_box_cb'  => 'add_meta_boxes_praktijk',
    'taxonomies'            => array('category')
    );
    register_post_type( 'praktijk', $args);
}

/**
 * Add the functions for the meta_boxes.
 */
function add_meta_boxes_praktijk(){
    add_meta_box('praktijk_quote', 'Quote', 'praktijk_quote_meta_cb', 'praktijk', 'normal', 'default');
}

function praktijk_quote_meta_cb(){
    global $post;
    ?>

    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" >
        <tbody>
        <tr class="form-field">
            <td>
                <input type="text" name="_praktijk_quote" id="top-quote" placeholder="write a quote" value="<?php echo get_post_meta($post->ID, '_praktijk_quote', true); ?>" style="resize: vertical; width: 100%"/>
            </td>
        </tr>
        </tbody>
    </table>

<?php
}

/**
 * The save function to save the data in the database
 *
 * @param $post_id
 */
function save_praktijk_meta($post_id){
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['labels_nonce']) && wp_verify_nonce($_POST['labels_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }
    if(isset($_POST[ '_praktijk_quote' ])){
        update_post_meta($post_id, '_praktijk_quote', $_POST['_praktijk_quote']);
    }
}
add_action('save_post', 'save_praktijk_meta');