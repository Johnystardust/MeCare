<?php
/**
 * Custom Post Type for praktijk
 */

add_action('init', 'create_beoordelingen_post_type' );

/**
 * Create & register the custom post type.
 */

function create_beoordelingen_post_type() {
    $labels = array(
        'name'               => 'Beoordelingen',
        'singular_name'      => 'Beoordeling',
        'add_new'            => 'Add New', 'Beoordeling post',
        'add_new_item'       => 'Add New Beoordeling post',
        'edit_item'          => 'Edit Beoordeling post',
        'new_item'           => 'New Beoordeling post',
        'all_items'          => 'All Beoordelingen posts',
        'view_item'          => 'View Beoordeling post',
        'search_items'       => 'Search Beoordelingen posts',
        'not_found'          => 'No Beoordelingen found',
        'not_found_in_trash' => 'No Beoordelingen found in the Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Beoordelingen'
    );
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'menu_position'         => 8,
        'menu_icon'             => 'dashicons-star-filled',
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'           => false,
        'register_meta_box_cb'  => 'add_meta_boxes_beoordelingen',
        'taxonomies'            => array('category')
    );
    register_post_type( 'beoordelingen', $args);
}

function add_meta_boxes_beoordelingen(){
    add_meta_box('beoordeling_stars', 'Sterren', 'beoordeling_stars_meta_cb', 'beoordelingen', 'normal', 'default');
    add_meta_box('beoordeling_name', 'Naam', 'beoordeling_name_meta_cb', 'beoordelingen', 'normal', 'default');
    add_meta_box('beoordeling_email', 'Email', 'beoordeling_email_meta_cb', 'beoordelingen', 'normal', 'default');
}

function beoordeling_stars_meta_cb() {
    global $post;

    $stars = get_post_meta( $post->ID, '_beoordeling_stars', true );
    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" >
        <tbody>
        <tr class="form-field">
            <td>
                <?php if($stars == 1){
                    echo '<input type="radio" name="_beoordeling_stars" value="1" checked/>1 Star';
                } else {
                    echo '<input type="radio" name="_beoordeling_stars" value="1"/>1 Star';
                }?>
            </td>
            <td>
                <?php if($stars == 2){
                    echo '<input type="radio" name="_beoordeling_stars" value="2" checked/>2 Star';
                } else {
                    echo '<input type="radio" name="_beoordeling_stars" value="2"/>2 Star';
                }?>
            </td>
            <td>
                <?php if($stars == 3){
                    echo '<input type="radio" name="_beoordeling_stars" value="3" checked/>3 Star';
                } else {
                    echo '<input type="radio" name="_beoordeling_stars" value="3"/>3 Star';
                }?>
            </td>
            <td>
                <?php if($stars == 4){
                    echo '<input type="radio" name="_beoordeling_stars" value="4" checked/>4 Star';
                } else {
                    echo '<input type="radio" name="_beoordeling_stars" value="4"/>4 Star';
                }?>
            </td>
            <td>
                <?php if($stars == 5){
                    echo '<input type="radio" name="_beoordeling_stars" value="5" checked/>5 Star';
                } else {
                    echo '<input type="radio" name="_beoordeling_stars" value="5"/>5 Star';
                }?>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}


function beoordeling_name_meta_cb(){
    global $post;
    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" >
        <tbody>
        <tr class="form-field">
            <td><input type="text" name="_beoordeling_name" value="<?php echo get_post_meta($post->ID, '_beoordeling_name', true); ?>"/></td>
        </tr>
        </tbody>
    </table>
    <?php
}

function beoordeling_email_meta_cb(){
    global $post;
    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" >
        <tbody>
        <tr class="form-field">
            <td><input type="text" name="_beoordeling_email" value="<?php echo get_post_meta($post->ID, '_beoordeling_email', true); ?>"/></td>
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
function save_beoordeling_meta($post_id){
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['labels_nonce']) && wp_verify_nonce($_POST['labels_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }
    if(isset($_POST[ '_beoordeling_stars' ])){
        update_post_meta($post_id, '_beoordeling_stars', $_POST['_beoordeling_stars']);
    }
    if(isset($_POST['_beoordeling_name'])){
        update_post_meta($post_id, '_beoordeling_name', $_POST['_beoordeling_name']);
    }
    if(isset($_POST['_beoordeling_email'])){
        update_post_meta($post_id, '_beoordeling_email', $_POST['_beoordeling_email']);
    }
}
add_action('save_post', 'save_beoordeling_meta');