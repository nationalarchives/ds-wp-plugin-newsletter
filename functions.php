<?php 

/**
 * Plugin Initialisation
 * @codeCoverageIgnore
 */
function tna_newsletter_plugin_Init() {
    require_once dirname(__FILE__) . '/tna-newsletter.php';
    register_activation_hook( __FILE__, 'tna-newsletter', 'activate' );
}

/**
 * Enqueue Scripts
 * @codeCoverageIgnore
 */
function tna_newsletter_admin_scripts() {
     wp_enqueue_script ( 'tna-newsletter-script', plugin_dir_url( __FILE__ ) . 'js/tna-newsletter.js','','',false );
     wp_enqueue_style ( 'tna-newsletter-style', plugin_dir_url( __FILE__ ) . '/styles/tna-newsletter.css' );
  }

/**
 * Shortcode [tna-newsletter]
 * @codeCoverageIgnore
 */
function wpdocs_tna_newsletter_func( $atts) {
    // API Connection
   global $results;

   $error = '';

   $form_title= get_option('tna_newsletter_form_title');
   $form_description = get_option('tna_newsletter_form_paragraph');
   $form_privacy = get_option('tna_newsletter_form_privacy');

   $content = array($form_title,$form_description,$form_privacy);

   $atts = shortcode_atts( array(), $atts, 'tna_newsletter' );
   
   if(isset($_POST['Submit'])){
       if(isset($_POST['email'])){
           if(!$results['valid']){
               $error = $results['response']['reason'];
           } else {
                return thank_you_message(); 
           }
       }
   }

   $form = new Newsletter_Form_Builder('signup','signup','','post',$error, $content);

   return $form->init_form();
}

/**
 * Thank you page
 */
function thank_you_message(){
   global $results;

   $tnx_title = get_option('tna_newsletter_tnx_title'); // Thank you page -> title
   $tnx_p_one = get_option('tna_newsletter_tnx_paragraph_one'); // Thank you page -> paragraph one
   $tnx_p_two = get_option('tna_newsletter_tnx_paragraph_two'); // Thank you page -> paragraph two
   
   if(isset($results)){
       if($results['valid']){
           $content = '<h2>' . esc_attr($tnx_title) .' </h2>';
           $content .= '<p>' . esc_attr($tnx_p_one) .'</p>';
           $content .= '<p>' . esc_attr($tnx_p_two) .'<a href="http://nationalarchives.gov.uk/legal/privacy.htm">' . esc_attr('privacy policy'). '</a>.</p>';
           $content .= '<a class="button" href="https://www.nationalarchives.gov.uk">' . esc_attr('Back to home page') . '</a>';
           
        return $content;
       }
   }
   return false;
}

/**
 * Shortcodes INIT
 * @codeCoverageIgnore
 */
function wporg_shortcodes_init()
{
   // Wordpress Hooks
   add_shortcode( 'tna_newsletter', 'wpdocs_tna_newsletter_func');
}       

/**
 * Custom menu settings
 * @codeCoverageIgnore
 */
function tna_newsletter_create_menu() {
	//create new top-level menu
	add_menu_page('TNA Newsletter', 'TNA Newsletter', 'administrator', __FILE__, 'tna_newsletter_settings_page' , 'dashicons-buddicons-pm' );

	//call register settings function
	add_action( 'admin_init', 'register_tna_newsletter_settings' );
}

/**
 * Register plugin settings
 * @codeCoverageIgnore
 **/
function register_tna_newsletter_settings() {
	register_setting( 'tna-newsletter-settings-group', 'tna_newsletter_api_key' );
	register_setting( 'tna-newsletter-settings-group', 'tna_newsletter_api_id' );
	register_setting( 'tna-newsletter-settings-group', 'tna_newsletter_form_title' );
	register_setting( 'tna-newsletter-settings-group', 'tna_newsletter_form_paragraph' );
	register_setting( 'tna-newsletter-settings-group', 'tna_newsletter_form_privacy' );
	register_setting( 'tna-newsletter-settings-group', 'tna_newsletter_tnx_title' );
	register_setting( 'tna-newsletter-settings-group', 'tna_newsletter_tnx_paragraph_one' );
	register_setting( 'tna-newsletter-settings-group', 'tna_newsletter_tnx_paragraph_two' );
}

/**
 * Display plugin settings
 * @codeCoverageIgnore
 **/
function tna_newsletter_settings_page() { ?>
<div class="wrap">
    <div id="welcome-panel" class="welcome-panel">
        <div class="welcome-panel-content">
            <h1><?php echo esc_attr('TNA Newsletter') ?></h1>
            <p class="about-description"><?php echo esc_attr('API credentials and form content') ?></p>
            <div class="welcome-panel-column-container">

                <form method="post" action="options.php">
                    <?php settings_fields( 'tna-newsletter-settings-group' ); ?>
                    <?php do_settings_sections( 'tna-newsletter-settings-group' ); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">API Key</th>
                            <td><input type="text" name="tna_newsletter_api_key"
                                    value="<?php echo esc_attr( get_option('tna_newsletter_api_key') ); ?>" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">API ID</th>
                            <td><input type="text" name="tna_newsletter_api_id"
                                    value="<?php echo esc_attr( get_option('tna_newsletter_api_id') ); ?>" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Title</th>
                            <td>
                                <textarea rows="4" cols="50"
                                    name="tna_newsletter_form_title"><?php echo esc_attr( get_option('tna_newsletter_form_title') ); ?></textarea>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Description</th>
                            <td>
                                <textarea rows="4" cols="50"
                                    name="tna_newsletter_form_paragraph"><?php echo esc_attr( get_option('tna_newsletter_form_paragraph') ); ?></textarea>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">Privacy policy</th>
                            <td>
                                <textarea rows="4" cols="50"
                                    name="tna_newsletter_form_privacy"><?php echo esc_attr( get_option('tna_newsletter_form_privacy') ); ?></textarea>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">Thank you -> Title</th>
                            <td>
                                <textarea rows="4" cols="50"
                                    name="tna_newsletter_tnx_title"><?php echo esc_attr( get_option('tna_newsletter_tnx_title') ); ?></textarea>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">Thank you -> Paragraph one</th>
                            <td>
                                <textarea rows="4" cols="50"
                                    name="tna_newsletter_tnx_paragraph_one"><?php echo esc_attr( get_option('tna_newsletter_tnx_paragraph_one') ); ?></textarea>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">Thank you -> Paragraph Two</th>
                            <td>
                                <textarea rows="4" cols="50"
                                    name="tna_newsletter_tnx_paragraph_two"><?php echo esc_attr( get_option('tna_newsletter_tnx_paragraph_two') ); ?></textarea>
                            </td>
                        </tr>

                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }