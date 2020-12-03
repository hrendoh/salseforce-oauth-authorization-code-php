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

try {

  // Try to get an access token using the authorization code grant.
  $accessToken = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
  ]);

  session_start();
  $_SESSION['access_token'] = $accessToken->getToken();
  $_SESSION['refresh_token'] = $accessToken->getRefreshToken();
  $_SESSION['instance_url'] = $accessToken->getInstanceUrl();

  echo $accessToken->getToken() . "\n";
  echo $accessToken->getRefreshToken() . "\n";
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

  // Failed to get the access token or user details.
  exit($e->getMessage());
}
?>
<a href="/describe_account.php">取引先のメタデータを取得</a>