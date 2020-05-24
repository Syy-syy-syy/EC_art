# EC_art

## 初期設定
composer require fzaninotto/faker
composer require phpunit/phpunit

## データベース名
ec_art

使用SQL

CREATE DATABASE ec_art DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
GRANT ALL ON `ec_art`.* TO 'root'@'%' ;

## テーブル
create_tables.sqlを用いること

