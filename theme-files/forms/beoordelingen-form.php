<?php

class TVDS_beoordelingen_form {

    // Create an array for the errors
    private $form_errors = array();

    // Register the shortcode
    function __construct(){
        add_shortcode( 'tvds_beoordeling_form', array( $this, 'shortcode' ) );
    }

    // The function to show the form
    static public function form(){
        ?>
        <form action="" id="primaryPostForm" method="POST">
            <div class="form-group">
                <label for="postTilte">Titel</label>
                <input type="text" name="postTitle" id="postTitle" class="form-control" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" />
            </div>

            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" name="_beoordeling_name" id="name" class="form-control"/>
            </div>

            <div class="form-group">
                <label for="email">E-mail <small>(wordt niet getoond)</small></label>
                <input type="email" name="_beoordeling_email" id="email" class="form-control"/>
            </div>

            <div class="form-group">
                <label for="postContent">Beoordeling</label>
                <textarea name="postContent" id="postContent" class="form-control" rows="8" cols="30"><?php if(isset($_POST['postContent'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['postContent']); } else { echo $_POST['postContent']; } } ?></textarea>
            </div>

            <div class="form-group">
                <label for="stars">Waardering</label>
                <div class="col-md-12 no-padding">
                    <input type="radio" name="_beoordeling_stars" value="5"/><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                    <input type="radio" name="_beoordeling_stars" value="4"/><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                    <input type="radio" name="_beoordeling_stars" value="3"/><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                    <input type="radio" name="_beoordeling_stars" value="2"/><i class="icon-star"></i><i class="icon-star"></i>
                    <input type="radio" name="_beoordeling_stars" value="1"/><i class="icon-star"></i>
                </div>
            </div>

            <div class="form-group">
                <?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

                <input type="hidden" name="submitted" id="submitted" value="true" />
                <button class="btn btn-primary" type="submit">Add Post</button>
            </div>
        </form>
        <?php
    }

    // Validate function
    public function validate($title, $name, $email, $content, $stars){
        // If any field is left empty, add the error message to the error array
        if(empty($title) || empty($name) || empty($email) || empty($content) || empty($stars)){
            array_push($this->form_errors, 'Velden mogen niet leeg zijn.');
        }
        // if the name field isn't alphabetic, add the error message
        if(strlen($name ) < 4){
            array_push($this->form_errors, 'Naam moet ten minste 4 letters zijn.');
        }
        // Check if the email is valid
        if(!is_email($email)){
            array_push($this->form_errors, 'Geen geldig e-mail adres.');
        }
    }

    public function send_beoordeling($title, $name, $email, $content, $stars){
        // Process the fields
        $post_information = array(
            'post_title' => esc_attr(strip_tags($title)),
            'post_content' => esc_attr(strip_tags($content)),
            'post_type' => 'beoordelingen',
            'post_status' => 'pending'
        );

        $post_id = wp_insert_post($post_information);

        print_r($post_id);

        if($post_id)
        {
            echo 'redirect';
            // Redirect
            wp_redirect(home_url());
        }
    }

    // Process function
    public function process_functions() {
        if(isset($_POST['submitted'])){
            $this->validate($_POST['postTitle'], $_POST['_beoordeling_name'], $_POST['_beoordeling_email'], $_POST['postContent'], $_POST['_beoordeling_stars']);

            if(is_array($this->form_errors)){
                echo '<div class="form-errors">';
                foreach($this->form_errors as $error){
                    echo '<h4><span class="label label-danger">Error: '.$error.'</span></h4>';
                }
                echo '</div>';
            }
        }

        $this->send_beoordeling($_POST['postTitle'], $_POST['_beoordeling_name'], $_POST['_beoordeling_email'], $_POST['postContent'], $_POST['_beoordeling_stars']);

        self::form();
    }

    // The shortcode function
    public function shortcode() {
        ob_start();
        $this->process_functions();
        return ob_get_clean();
    }
}

new TVDS_beoordelingen_form;