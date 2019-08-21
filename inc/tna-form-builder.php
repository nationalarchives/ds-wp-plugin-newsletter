<?php 
/**
 * Newesletter Form Builder 
 * PHP wrapper for the form.
 *
 * Version: 1.0.0
 * Requires: PHP 5.2+
 */

if ( !class_exists( 'Newsletter_Form_Builder' ) ) {
    class Newsletter_Form_Builder {

        /**
         * The name - This is set from within constructor.
         * @var String
         */
        private $name;
    
        /**
         * The id - This is seet from within constructor.
         * @var String
         */
        private $id;
    
        /**
         * The action - This is set from within constructor.
         * @var String
         */
        private $action;
    
        /**
         * The API ID - This is set from within the constructor.
         * @var String
         */
        private $method;
    
        /**
         * Set properties.
         */
        public function __construct($name,$id,$action,$method,$error,$content){
            $this->name = $name;
            $this->id = $id;
            $this->action = $action;
            $this->method = $method;
            $this->error = $error;
            $this->content = $content;
        }  
    
        /**
         * get_form_body() - Will render default form and some of its elements
         * @var String
         */
        private function get_form_body(){
            $form = '<form name="'. $this->name .'" id="' . $this->id . '" action="'. $this->action .'" method="'. $this->method .'" role="form">';
            $form .= '<input type="hidden" name="signup" value="NDQ1">';
            $form .= '<input type="hidden" name="confirmation_subject" value="">';
            $form .= '<input type="hidden" name="confirmation" value="">';
            $form .= '<input type="hidden" name="list" value="3">';
            $form .= '<input type="hidden" name="source" value="web">';
            $form .= '<input type="hidden" name="opt_in" value="1">';
    
            return $form;
        }
    
        /**
         * is_close_form() - Render a html form closing tag
         * @var String
         */
        private function is_close_form(){
            return '</form>';
        }
    
        /**
         * is_paragraph() - Render a paragraph
         * @var String
         */ 
        private function get_paragraph() {
            return'<div class="form-row"><p>'. esc_attr($this->content[1]) .'</p></div>';
        }
        
        /**
         * get_legend() - Render a form legend
         * @var String
         */
        private function get_legend(){
            return '<legend>'. esc_attr($this->content[0]) .'</legend>';
        }
        
        /**
         * get_email_input() - Render an email input
         * @var String
         */
        private function get_email_input(){
            return '<div class="form-row"><label for="email">' . esc_attr('Email address') .'</label><input type="email" name="email" id="email" placeholder="Enter your email address" aria-labelledby="newsletterAccessibility" required></div>';
        }
    
        /**
         * get_email_input() - Render the first name input
         * @var String
         */
        private function get_first_name_input(){
            return '<div class="form-row"><label for="firstname">' . esc_attr('First name') .' <span class="optional">' . esc_attr('(optional)') .'</span></label><input type="text" name="firstname" id="firstname" placeholder="Enter your first name" aria-labelledby="newsletterAccessibility"></div>';
        }
    
        /**
         * get_email_input() - Render the last name input
         * @var String
         */
        private function get_last_name_input(){
            return '<div class="form-row"><label for="lastname">' . esc_attr('Last name') .' <span class="optional">' . esc_attr('(optional)') .'</span></label><input type="text" name="lastname" id="lastname" placeholder="Enter your last name" aria-labelledby="newsletterAccessibility"></div>';
        }
    
        /**
         * get_email_input() - Render the last name input
         * @var String
         */
        private function get_terms_checkbox(){
            return '<div class="form-row"><input id="privacy_policy" type="checkbox" name="privacy_policy"><label for="privacy_policy">'. esc_attr($this->content[2]) .' <a href="https://nationalarchives.gov.uk/legal/privacy-policy/">' . esc_attr('Privacy Policy') .'</a>.</label>
        </div>';
        }
            
        /**
         * is_sign_up() - Render a submit button
         * @var String
         */
        private function is_sign_up() {
            return '<div class="form-row"><input id="newsletterSignUp" type="submit" name="Submit" value="Submit" class="margin-left-medium disabled"></div>';
        }
    
        /**
         * is_open_fieldset - Render an opening html tag element
         * @var String
         */
        private function is_open_fieldset(){
            return '<fieldset>';
        }
    
        /**
         * is_close_fieldset - Render a closing html tag element
         * @var String
         */
        private function is_close_fieldset(){
            return '</fieldset>';
        }
    
        /**
         * is_error_message - Render an error message
         * @var String
         */
        private function is_error_message() {
            if(isset($_POST['Submit'])){
                if(!empty($this->error)) {
                    return '<div class="emphasis-block error-message">'. esc_attr($this->error) .'</div>';
                }
            }
        }
    
        /**
         * init_form - Initialise the from
         * @var String
         */
        public function init_form()  {
            $form = $this->is_error_message();
            $form .= $this->is_open_fieldset();
            $form .= $this->get_legend();
            $form .= $this->get_paragraph();
            $form .= $this->get_form_body();
            $form .= $this->get_first_name_input();
            $form .= $this->get_last_name_input();
            $form .= $this->get_email_input();
            $form .= $this->get_terms_checkbox();
            $form .= $this->is_sign_up();
            $form .= $this->is_close_form();
            $form .= $this->is_close_fieldset();    
    
            echo $form;
        }
    }
}