<?php

/*
  Description: Simple Contact form that just works
 */

class TVDS_contact_form {

    private $form_errors = array();

    /**
     * The __construct() function
     *
     * This function is used to set up and register the shortcode
     */
    function __construct() {
        add_shortcode( 'tvds_contact_form', array( $this, 'shortcode' ) );
    }

    /**
     * The form() function
     *
     * This function is a static function where the form itself is located
     */
    static public function form(){
        $redirect = '';

        if( is_home() ){
            $redirect = 'contact';
        } else {
            $redirect = '';
        }

        echo "<form action='". $_SERVER['REQUEST_URI']."".$redirect."' method='post'>";

        echo "<div class='form-group form-group-double'><div class='col-md-6 form-double-left'><label for=''>Naam</label><input class='form-control' type='text' name='naam' value='". $_POST['naam'] ."'></div>";

        echo "<div class='col-md-6 form-double-right'><label for=''>Email</label><input class='form-control' type='email' name='email' value='". $_POST['email'] ."'></div></div>";

        echo "<div class='form-group'><label for=''>Onderwerp</label><input class='form-control' type='text' name='onderwerp' value='". $_POST['onderwerp'] ."'></div>";

        echo "<div class='form-group'><label for=''>Bericht</label><textarea name='bericht' class='form-control' rows='10'>". $_POST['bericht'] ."</textarea></div>";

        echo "<div class='form-group'><input type='submit' name='form-submitted' value='Versturen' class='btn btn-primary'></div>";

        echo "</form>";
    }

    /**
     * The validate_form() function
     *
     * This function validates the data in the input fields. The data from the
     * fields is send trough and is checked for multiple requirements.
     *
     * When there is a error the error gets added to the $form_errors Array
     * and is displayed later.
     *
     * @param $name
     * @param $email
     * @param $subject
     * @param $message
     */
    public function validate_form( $name, $email, $subject, $message ) {

        // If any field is left empty, add the error message to the error array
        if( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
            array_push( $this->form_errors, 'Velden mogen niet leeg zijn.' );
        }

        // if the name field isn't alphabetic, add the error message
        if( strlen($name ) < 4 ) {
            array_push( $this->form_errors, 'Naam moet ten minste 4 letters zijn.' );
        }

        // Check if the email is valid
        if( !is_email( $email ) ) {
            array_push( $this->form_errors, 'Geen geldig e-mail adres.' );
        }
    }

    /**
     * The send_mail() function
     *
     * This function sanitizes the fields and sends the mail to the site's admin.
     * If the mail is successfully send a thank you message will appear.
     *
     * @param $name
     * @param $email
     * @param $subject
     * @param $message
     */
    public function send_email( $name, $email, $subject, $message ) {

        // Ensure the error array ($form_errors) contain no error
        if( count($this->form_errors) < 1 ) {

            // Sanitize form values
            $name       = sanitize_text_field( $name );
            $email      = sanitize_email( $email );
            $subject    = sanitize_text_field( $subject );
            $message    = esc_textarea( $message );

            // Get the blog administrator's email address
            $to = get_option( 'admin_email' );

            $headers = "From: $name <$email>" . "\r\n";

            // If email has been process for sending, display a success message
            if( wp_mail( $to, $subject, $message, $headers ) ) {
                echo '<div class="form-succes">';
                echo '<h4><span class="label label-success">Bedankt voor uw bericht, u krijgt zo snel mogelijk een antwoord.</span></h4>';
                echo '</div>';

                // Maybe clear fields on successful send here
            }
        }
    }

    /**
     * The process_functions() function
     *
     * This function is activated once the submit button is clicked, the function
     * sends the data in the input fields first trough the validate_form() function
     * so it can get validated.
     *
     * If the mail gets validated the data is forwarded to the send_email() function
     * after it has done that the form gets reloaded.
     */
    public function process_functions() {
        if( isset( $_POST['form-submitted'] ) ) {
            // Call validate_form() to validate the form values
            $this->validate_form( $_POST['naam'], $_POST['email'], $_POST['onderwerp'], $_POST['bericht'] );

            // If there are errors display them in the form-errors div
            if( is_array( $this->form_errors ) ) {
                echo '<div class="form-errors">';
                foreach( $this->form_errors as $error ) {
                    echo '<h4><span class="label label-danger">Error: '.$error.'</span></h4>';
                }
                echo '</div>';
            }
        }

        $this->send_email( $_POST['naam'], $_POST['email'], $_POST['onderwerp'], $_POST['bericht'] );

        self::form();
    }

    /**
     * The shortcode() function
     *
     * This function is used for the shortcode
     *
     * @return string
     */
    public function shortcode() {
        ob_start();
        $this->process_functions();
        return ob_get_clean();
    }

}

new TVDS_contact_form;
