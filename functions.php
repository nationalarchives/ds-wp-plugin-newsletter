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

/**
 * Custom menu settings
 */
function tna_newsletter_create_menu() {

	//create new top-level menu
	add_menu_page('TNA Newsletter', 'TNA Newsletter', 'administrator', __FILE__, 'tna_newsletter_settings_page' , 'dashicons-buddicons-pm' );

	//call register settings function
	add_action( 'admin_init', 'register_tna_newsletter_settings' );
}

function register_tna_newsletter_settings() {
	//register our settings
	register_setting( 'tna-newsletter-settings-group', 'api_key' );
	register_setting( 'tna-newsletter-settings-group', 'api_id' );
}

function tna_newsletter_settings_page() {
?>
<div class="wrap">
    <div id="welcome-panel" class="welcome-panel">
        <div class="welcome-panel-content">
            <h2>TNA Newsletter</h2>
            <p class="about-description">API credentials</p>
            <div class="welcome-panel-column-container">
                <div class="welcome-panel-column">
                    <form method="post" action="options.php">
                        <?php settings_fields( 'tna-newsletter-settings-group' ); ?>
                        <?php do_settings_sections( 'tna-newsletter-settings-group' ); ?>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">API Key</th>
                                <td><input type="text" name="api_key"
                                        value="<?php echo esc_attr( get_option('api_key') ); ?>" /></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">API ID</th>
                                <td><input type="text" name="api_id"
                                        value="<?php echo esc_attr( get_option('api_id') ); ?>" /></td>
                            </tr>

                        </table>
                        <?php submit_button(); ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }