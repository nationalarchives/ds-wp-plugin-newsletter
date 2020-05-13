<?php
/**
 * Create new instance of ApiConnection.
 *
 * This needs to be done in each section you are firing requests from.
 * First we include the api-connection.php class file, then we create
 * a new instance of the ApiConnection class.
 */
require_once('api-connection.php');

$api_key = esc_attr( get_option('tna_newsletter_api_key')); // The API Key
$api_id =  esc_attr( get_option('tna_newsletter_api_id')); // The API ID
$api_url = 'https://control.econnectmail.com/rest'; // The API Base URL - Note: theres no trailing slash!

$api = new ApiConnection(
	$api_id, 
	$api_key, 
	$api_url
);
		
/**
 * Triggering Workflows.
 *
 * Triggering workflows is incredibly easy using the API. We
 * can also pass through a JSON encoded array of vars which
 * we can use within Workflows.
 *
 * Trigger requests will be rejected unless the Workflow is
 * 'active' or is 'paused' and queueing is permitted. Valid
 * requests return an internal Workflow ID which can then be
 * used to track and report on.
 */

if(isset($_POST['email'])){
    $results = $api->post('/automation/trigger_workflow', array(
        'workflow_api_identifier' => 'add_website_signups',
        'email_address' => $_POST['email'],
        'first_name' => $_POST['firstname'],
        'last_name' => $_POST['lastname']
    ));
}