<?php 

/**
 * Shortcode
 */
function wpdocs_tna_newsletter_func( $atts) {
    // API Connection
   global $results;

   $error = '';

   $atts = shortcode_atts( array(
       'type' => 'full'
   ), $atts, 'tna_newsletter' );
   
   if(isset($_POST['Submit'])){
       if(isset($_POST['email'])){
           if(!$results['valid']){
               $error = $results['response']['reason'];
           }
       }
   }

   $form = new Newsletter_Form_Builder('signup','signup','','post',$error);

   return $form->init_form();
}

/**
 * Thank you page
 */
function thank_you_page(){
   global $results;
   if(isset($results)){
       if($results['valid']){
           header('Location: https://www.nationalarchives.gov.uk/notifications/newsletter-thank-you/');
           exit();
       }
   }
}

/**
 * Shortcodes INIT
 */
function wporg_shortcodes_init()
{
   // Wordpress Hooks
   add_shortcode( 'tna_newsletter', 'wpdocs_tna_newsletter_func');
}