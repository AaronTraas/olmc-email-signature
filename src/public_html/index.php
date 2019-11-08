<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config.php';
require_once '../lib/google-api-php-client-2.4.0/vendor/autoload.php';

$spreadsheet_id = '1TNdrRXbBd68A0IXy2UlxOiYTpdtt1i01gDIVgqxoXwc';
$range = 'Employees!A3:D';
$sig_search = array('{{name}}', '{{grade}}', '{{title}}', '{{email}}');
$sig_template = file_get_contents('../templates/signature.html');
$page_template = file_get_contents('../templates/page.html');

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
    $client->setPrompt('select_account consent');
	$client->setDeveloperKey(GOOGLE_API_KEY);
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);
$result = $service->spreadsheets_values->get($spreadsheet_id, $range);
$rows = $result->getValues();

$body = '';
foreach($rows as $key => $row) {
	$sig = str_replace($sig_search, $row, $sig_template);
	$sig = str_replace('{{id}}', $key, $sig);
	$body .= '<hr>' . $sig;
}

$page = str_replace('{{body}}', $body, $page_template);

print($page);
?>