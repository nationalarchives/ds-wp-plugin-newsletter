<?php
/**
 * Create new instance of ApiConnection.
 *
 * This needs to be done in each section you are firing requests from.
 * First we include the api-connection.php class file, then we create
 * a new instance of the ApiConnection class.
 */
require_once('api-connection.php');

$api = new ApiConnection(
	'GgloG-LYo9fd0XcZEPLOqed34Us.', // The API ID
	'In8-bAMpQUkCbU9zWM8QBpk_-WSufGpnn3Nn8h3XVsU.', // The API Key
	'https://control.e-connectservice.com/rest' // The API Base URL - Note: theres no trailing slash!
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