<?php
// Salseforce用のプロバイダを生成
$provider = new \Stevenmaguire\OAuth2\Client\Provider\Salesforce([
  'clientId'                => $_ENV['CONSUMER_KEY'],
  'clientSecret'            => $_ENV['SECRET'],
  'redirectUri'             => 'https://' . $_SERVER['SERVER_NAME'] . '/callback.php',
]);
