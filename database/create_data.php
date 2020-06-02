<?php

require_once('../public/functinos/pdo_db.php');
require_once('vendor/fzaninotto/faker/src/autoload.php');

// インスタンス準備
$pdo = db_init();
$sql = 'INSERT INTO categories (name) VALUES (:name)';
$stmt = $pdo->prepare($sql);
$faker = Faker\Factory::create('ja_JP');
$arr = array();

// カテゴリ
for ($i = 0; $i < 10; $i++) {
    $arr[] = $faker->name;
    $stmt->bindParam(':name', $arr[i], PDO::PARAM_STR);
    $stmt->execute();
}
