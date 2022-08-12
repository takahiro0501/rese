
# 飲食店予約システムＲｅｓｅ

***本プロジェクトは、学習を目的とした模擬案件の開発です。要件定義として以下を想定してます。***

　　サービス名：　　Rese（リーズ）   
　　サービス概要：　ある企業のグループ会社の飲食店予約サービス  
　　作業範囲：　　　設計・コーディング・テスト・環境構築  
　　ブラウザ：　　　PC：Chrome/Firefox/Safari 最新バージョン  
  
  <br>
  <br>
  
## 開発環境
・仕様言語：PHP 8.1.6 <br>
・フレームワーク：Laravel Framework 8.83.22 <br>
・データベース：MySql　Ver 15.1 Distrib 10.4.24-MariaDB <br>
・ストレージ：AWS S3 <br>
・メールテスト：MailTrap <br>
・docker環境：laravel/sail 1.0.1 <br>
 <br>
<details>
<summary>Laravel追加パッケージ</summary>

"laravel/breeze": "^1.9"  
"league/flysystem-aws-s3-v3": "~1.0"  
"simplesoftwareio/simple-qrcode": "^4.2"  
"stripe/stripe-php": "^8.12"  
  
</details>

<br>
<br>
  
## データベース設計
以下のER図を参照ください。
  
![予約管理 drawio](https://user-images.githubusercontent.com/82810290/182519570-c9e99185-6b86-4a92-a312-6e5c5860874d.png)

<br>
<br>

## システム構成
本番環境として、AWS上に以下のような環境を構築しました。

![システム構成図 drawio](https://user-images.githubusercontent.com/82810290/184335573-e07b6e23-15dc-4d7c-bb05-79b2159362e9.png)

<br>
<br>


## 環境構築
以下の手順にてEC２上にDocker環境を構築しました。

1. EC２にログイン
2. ディレクトリ移動
```
/# cd /var/www
```
<br>

3. ソースコードダウンロード
```
/# git clone https://github.com/takahiro0501/rese
```
<br>

4. Dockerコンテナのビルドと起動
```
/# docker-compose up -d --build
```
<br>

5. envファイル作成（ご自身の環境に合わせたDB、AWS、Mail、Stripeの環境変数を設定ください）
```
/# cp .env.example .env
```
<br>

6. アプリケーションサーバコンテナ内へ移動
```
/# docker compose exec app bash
```
<br>

7. composerのupdate(行わないと、エラーやフリーズが起きます)
```
/app# composer self-update
```
<br>

8. 必要ファイルのダウンロード
```
/app# composer update
```
<br>

9. アプリケーションキーの作成
```
/app# php artisan key:generate
```
<br>

10. テーブル作成（本プロジェクトでは、RDSにreservationというDBを事前に作成しています）
```
/app# php artisan migrate:fresh
```
<br>

11. 初期データの作成
```
/app# php artisan db:seed
```
<br>

12. S3に初期データ店舗の画像をアップロード
```
/app# php artisan s3:upload
```
<br>

13. strage配下に権限付与
```
/app# chmod 777 -R storage/
```
<br>

<br>



## 機能一覧

 - [飲食店一覧表示と検索](#飲食店一覧表示と検索)
 - [会員のメール認証登録](#会員のメール認証登録)
 - [会員専用機能](#会員専用機能)   
 - [予約リマインダー](#予約リマインダー)
 - [予約照合qrコード](#予約照合qrコード)
 - [決済機能](#決済機能)
 - [レスポンシブデザイン](#レスポンシブデザイン)
 - [店舗管理](#店舗管理)

<br>
<br>


# 機能詳細
### 【飲食店一覧表示と検索】
#### 動作
登録された飲食店の一覧表示と、検索（エリア、ジャンル、店名）が可能です。動作は以下をご確認ください。
  
https://user-images.githubusercontent.com/82810290/182530378-76e6468a-cc4f-4562-9332-5b8531f8e694.mp4

<br />
<br />


### 【会員のメール認証登録】  
#### 動作
メール認証による会員登録が可能です。期限付きURLを発行し認証を行います。動作は以下をご確認ください。

https://user-images.githubusercontent.com/82810290/182532662-467b28f0-5104-4f09-9a2a-0be7886d268e.mp4
  

#### 補足   
メール認証が完了していない状態で会員専用機能に関するページにアクセスすると以下ページに遷移後、home画面へリダイレクトします。  

<img src="https://user-images.githubusercontent.com/82810290/182526478-5afb9d4e-b4e4-4973-9007-7ecf99968e14.png" width="400px">

<br />

メール認証を行う事で以下の機能が可能になるよう実装しています。<br />  
・お気に入り登録、飲食店の予約と変更、会員専用ページ、飲食店レビュー、予約リマインダー、予約照合qrコード、決済機能、決済機能<br />

<br />
<br />

### 【会員専用機能】
#### 動作 （お気に入り登録/飲食店の予約と変更/会員専用ページ）
https://user-images.githubusercontent.com/82810290/183550759-05bd5a0d-b053-41d0-9b18-edddb4ab338a.mp4

<br />
<br />

#### 動作確認 （評価機能）
https://user-images.githubusercontent.com/82810290/183551725-8197e074-a8fe-48ba-a861-d614b09b39a9.mp4

<br />
<br />


### 【予約照合qrコード】
予約データに基づき、トークンを含んだ期限付きURLを発行しQRコードを生成します。QRコードにアクセスする事で店舗側が予約データを照合する事ができます。照合は、QR生成時にInsertされたトークンデータを比較し照合します。<br>
<br>
Mypage→「QRコード発行」ボタンより　※テストにつき、QRコード画面にURLを表示
![qr](https://user-images.githubusercontent.com/82810290/183553106-ecb55ec6-4589-4bdf-8d29-ed05c468794d.png)

<br>
<br>

### 【予約リマインダー】
予約データに基づき、当日の８：００にリマインダーメールを送信します（本番環境でのcron設定が必要） <br>
メールサンプル<br>

![remainder](https://user-images.githubusercontent.com/82810290/183554700-dc6a5c14-f3fe-4c2c-8ce0-b02e9a9dabbe.png)


<br>
<br>

### 【決済機能】
決済機能では、stripeサービスを利用しています（テストモードでのみ動作確認済み）。
Mypageから予約QRコードの照合が完了したユーザが利用できます。

#### 動作確認 
https://user-images.githubusercontent.com/82810290/183557596-bf5ce10a-8b2e-4cc3-91b6-151eb40e0e7d.mp4

<br>
<br>


### 【レスポンシブデザイン】
レスポンスデザイン（breakpoint:768px）に対応しております。以下サンプル画面です。

![respon](https://user-images.githubusercontent.com/82810290/183559290-3e58991c-8290-4ca2-b584-512a0e9afa58.png)

<br>
<br>

### 【店舗管理】
店舗管理は、店舗側が利用する管理機能です。管理者・店舗代表者権限を設定し以下機能を実装しました。<br>

##### 管理者
・店舗代表者の作成<br>
##### 店舗代表者<br>
・店舗情報の作成・更新<br>
・予約情報の確認<br>
・ユーザへのメール送信<br>

<br>
<br>


#### 店舗代表者の作成 
管理者ログイン画面から、管理者アカウント（サンプル設定：admin@test.com）でログインしてください。以下画面より店舗代表者が作成できます。<br>

![無題](https://user-images.githubusercontent.com/82810290/183577582-201f628c-e6fa-4fca-a7bd-6a6f33777af8.png)

<br>
<br>

#### 店舗情報の作成・更新 
管理者ログイン画面から、店舗代表者アカウントでログインしてください。[店舗作成][店舗更新]メニューから店舗情報の更新が可能です。<br>

![admin2](https://user-images.githubusercontent.com/82810290/183578729-6e102bcf-9e8c-46ff-a9b8-f6a2c579f01b.png)

<br>
<br>


#### 予約情報の確認 
管理者ログイン画面から、店舗代表者アカウントでログインしてください。[予約情報確認]メニューから予約情報の確認・検索が可能です。<br>
また[メールを送る]ボタン押下で、登録ユーザに個別でメールを送信可能です。

![admin3](https://user-images.githubusercontent.com/82810290/183578997-33693bc0-5bf6-4b9d-a239-a632300c8ae1.png)





