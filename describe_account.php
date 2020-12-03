<?php
require('vendor/autoload.php');

//turn on reporting for all errors and display
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

if (!isset($_SESSION['access_token'])) {
  header('Location: /index.php');
};

$client = new \GuzzleHttp\Client();
$access_token = $_SESSION['access_token'];
$response = $client->request(
  'GET',
  $_SESSION['instance_url'] . '/services/data/v36.0/sobjects/account/describe',
  ['headers' => ['Authorization' => 'Bearer ' . $access_token]]
);

$body = $response->getBody();
// Implicitly cast the body to a string and echo it
echo $body;
