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
        public $name;
    
        /**
         * The id - This is seet from within constructor.
         * @var String
         */
        public $id;
    
        /**
         * The action - This is set from within constructor.
         * @var String
         */
        public $action;
    
        /**
         * The API ID - This is set from within the constructor.
         * @var String
         */
        public $method;
        
        /**
         * The API ID - This is set from within the constructor.
         * @var String
         */
        public $content;

        /**
         * The API ID - This is set from within the constructor.
         * @var String
         */
        public $error;
        
        /**
         * Set properties.
         */
        public function __construct($name,$id,$action,$method,$error,array $content){
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
        public function get_form_body(){
            $form = '<form name="%s" id="%s" action="%s" method="%s" role="form">';
            $form .= '<input type="hidden" name="signup" value="NDQ1">';
            $form .= '<input type="hidden" name="confirmation_subject" value="">';
            $form .= '<input type="hidden" name="confirmation" value="">';
            $form .= '<input type="hidden" name="list" value="3">';
            $form .= '<input type="hidden" name="source" value="web">';
            $form .= '<input type="hidden" name="opt_in" value="1">';
    
            return sprintf($form,$this->name,$this->id,$this->action,$this->method);
        }
    
        /**
         * is_close_form() - Render a html form closing tag
         * @var String
         */
        public function is_close_form(){
            return '</form>';
        }
    
        /**
         * is_paragraph() - Render a paragraph
         * @var String
         */ 
        public function get_paragraph() {
            if(function_exists('esc_attr')) {
                if(!empty($this->content[1])){
                    return sprintf('<div class="form-row"><p>%s</p></div>', esc_attr($this->content[1]));
                }
            }
        }
        
        /**
         * get_legend() - Render a form legend
         * @var String
         */
        public function get_legend(){
            if(function_exists('esc_attr')) {
                if(!empty(esc_attr($this->content[0]))){
                    return sprintf('<legend>%s</legend>', esc_attr($this->content[0]));
                }
            }
        }
        
        /**
         * get_email_input() - Render an email input
         * @var String
         */
        public function get_email_input(){
            if(function_exists('esc_attr')) {
                $email ='<div class="form-row"><label for="email">%s</label><input type="email" name="email" id="email" placeholder="Enter your email address" aria-labelledby="newsletterAccessibility" required></div>';
                
                return sprintf($email,esc_attr('Email address'));
            } 
        }
    
        /**
         * get_email_input() - Render the first name input
         * @var String
         */
        public function get_first_name_input(){
            if(function_exists('esc_attr')) {
                $fname ='<div class="form-row"><label for="firstname">%s <span class="optional">%s</span></label><input type="text" name="firstname" id="firstname" placeholder="Enter your first name" aria-labelledby="newsletterAccessibility"></div>';

                return sprintf($fname,esc_attr('First name'),esc_attr('(optional)'));
            }  
        }
    
        /**
         * get_email_input() - Render the last name input
         * @var String
         */
        public function get_last_name_input(){
            if(function_exists('esc_attr')) {
                $lname = '<div class="form-row"><label for="lastname">%s <span class="optional">%s</span></label><input type="text" name="lastname" id="lastname" placeholder="Enter your last name" aria-labelledby="newsletterAccessibility"></div>';

                return sprintf($lname,esc_attr('Last name'),esc_attr('(optional)'));
            }
        }
    
        /**
         * get_email_input() - Render the last name input
         * @var String
         */
        public function get_terms_checkbox(){
            if(function_exists('esc_attr')) {
                $terms = '<div class="form-row checkbox"><input id="privacy_policy" type="checkbox" name="privacy_policy"><label for="privacy_policy">%s <a href="https://nationalarchives.gov.uk/legal/privacy-policy/">%s</a>.</label></div>';

                return sprintf($terms, esc_attr($this->content[2]), esc_attr('Privacy Policy'));
            }
        }
            
        /**
         * is_sign_up() - Render a submit button
         * @var String
         */
        public function is_sign_up() {
            return '<div class="form-row"><input id="newsletterSignUp" type="submit" name="Submit" value="Submit" class="margin-left-medium disabled"></div>';
        }
    
        /**
         * is_open_fieldset - Render an opening html tag element
         * @var String
         */
        public function is_open_fieldset(){
            return '<fieldset>';
        }
    
        /**
         * is_close_fieldset - Render a closing html tag element
         * @var String
         */
        public function is_close_fieldset(){
            return '</fieldset>';
        }
    
        /**
         * is_error_message - Render an error message
         * @var String
         */
        public function is_error_message() {
            if(function_exists('esc_attr')) {
                if(isset($_POST['Submit'])){
                    if(!empty($this->error)) {
                        return sprintf('<div class="emphasis-block error-message">%s</div>', esc_attr($this->error));
                    }
                }
            }
        }
    
        /**
         * init_form - Initialise the from
         * @var String
         */
        public function init_form()  {
            $form = $this->is_error_message();
            $form .= $this->get_form_body();
            $form .= $this->is_open_fieldset();
            $form .= $this->get_legend();
            $form .= $this->get_paragraph();
            $form .= $this->get_first_name_input();
            $form .= $this->get_last_name_input();
            $form .= $this->get_email_input();
            $form .= $this->get_terms_checkbox();
            $form .= $this->is_sign_up();
            $form .= $this->is_close_fieldset();    
            $form .= $this->is_close_form();
    
            return $form;
        }
    }
}