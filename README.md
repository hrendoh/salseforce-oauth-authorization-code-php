## 概要

Salaseforce への OAuth 認可コードフロー PHP による実装サンプルです。

OAuth クライアントのライブラリ[League/oauth2-client](https://oauth2-client.thephpleague.com/)を利用しています。
League/oauth2-client は[Laravel](https://laravel.com/)を初め PHP の主なフレームワークの中で使用されているライブラリで、フレームワークを使用せず OAuth クライアントライブラリのみ Composer からインストールして使用するようなケースでも、こちらを選択しておいて間違いないです。

Salasforce 用のプロバイダは、[stevenmaguire/oauth2-salesforce](https://github.com/stevenmaguire/oauth2-salesforce)が利用できます。

## プロジェクトの利用方法

### 1. PHP Heroku プロジェクトの初期化

Heroku で動作確認する場合は、前提条件として以下が必要です

- Heroku アカウント
- PHP
- Composer
- Heroku コマンド

Heroku コマンドは以下のページを参考に入れてください
https://devcenter.heroku.com/articles/getting-started-with-php#set-up

Heroku アプリを作成

$ heroku create

Heroku の URL は、接続アプリケーションに設定するため控えておきます。
例: https://shrouded-falls-77154.herokuapp.com/

プロジェクトをデプロイ

```
$ git push heroku main

```

### 2. Heroku の環境変数にコンシューマシークレットをセット

設定で[アプリケーションマネージャ]を開き「Canvas App」のメニューより[参照]を開き、
[API (OAuth 設定の有効化)]の[コンシューマ鍵]の値を「CONSUMER_KEY」、[コンシューマの秘密]の値を「SECRET」にセットします。

```
$ heroku config:set CONSUMER_KEY=<コンシューマの秘密の値>
$ heroku config:set SECRET=<コンシューマの秘密の値>
```
