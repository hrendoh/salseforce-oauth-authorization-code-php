<?php
require('vendor/autoload.php');

//turn on reporting for all errors and display
error_reporting(E_ALL);
ini_set("display_errors", 1);

/* 環境変数の読み込み */

if (!isset($_ENV['CONSUMER_KEY'])) {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
}

// Salseforce用のプロバイダを生成
include_once 'provider.php';

/* 認可URLの生成 */
$authorize_url = $provider->getAuthorizationUrl();
?>
<a href="<?= $authorize_url ?>">Salesforceで認証</a>