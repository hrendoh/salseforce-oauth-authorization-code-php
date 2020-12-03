<?php
require('vendor/autoload.php');

//turn on reporting for all errors and display
error_reporting(E_ALL);
ini_set("display_errors", 1);

// 環境変数の読み込み
if (!isset($_ENV['CONSUMER_KEY'])) {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
};

// Salseforce用のプロバイダを生成
include_once 'provider.php';

session_start();

if (!isset($_SESSION['access_token'])) {
  header('Location: /index.php');
};

$existingAccessToken = new \Stevenmaguire\OAuth2\Client\Token\AccessToken(
  $_SESSION
);

// Salesforceはexpires属性が返ってこない、アクセストークンが期限切れかどうかは別途 OpenID Connect トークンイントロスペクション APIを叩く必要がある
//if ($existingAccessToken->hasExpired()) {
$newAccessToken = $provider->getAccessToken('refresh_token', [
  'refresh_token' => $existingAccessToken->getRefreshToken()
]);

echo 'old token: ' . $existingAccessToken->getToken() . "\n";
echo 'new token: ' . $newAccessToken->getToken();
$_SESSION['access_token'] = $newAccessToken->getToken();
  // Purge old access token and store new access token to your data store.
//}
