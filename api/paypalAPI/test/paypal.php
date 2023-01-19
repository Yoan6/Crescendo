<?php


use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Payments\AuthorizationsGetRequest;
use Sample\PayPalClient;

require_once(__DIR__ . '../vendor/autoload.php');

const CLIENT_ID = 'AaTHiLLksQ4TPTNz-IPaU7e3HxHpHDP9cHhpnQiRDUGeGShsHw68W5DxDaOUpCJDc8w2QpHf9hYEzSBi';
const CLIENT_SECRET = 'EHVjwRd2XAkGfJ4xNkNoTzzLzzkaFoxfqTQTqleHKLY_MLvxLHlrYbavmtC-vdQGBw_SzvH4pHZ3DYvD';

$environnement = new SandboxEnvironment(CLIENT_ID, CLIENT_SECRET);

$client = new PayPalHttpClient($environnement);
$requestID = new OrdersGetRequest($_POST['orderID']);

$response = $client->execute($requestID);



$requestAuth = new AuthorizationsGetRequest($_POST['authID']); 
$responseAuth = $client->execute($requestAuth);
$orderID = $responseAuth->result->supplementary_data->related_ids->order_id;

?>