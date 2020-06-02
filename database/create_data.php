<?php

require_once(dirname(__FILE__).'/../public/functions/pdo_db.php');
require_once('vendor/fzaninotto/faker/src/autoload.php');

// インスタンス準備
$pdo = db_init();
$faker = Faker\Factory::create('fr_FR');

// カテゴリ
$sql = 'INSERT INTO categories (name) VALUES (:name)';
$stmt = $pdo->prepare($sql);
$arr = array();

for ($i = 0; $i < 10; $i++) {
    $arr[] = $faker->unique()->name;
    $stmt->bindParam(':name', $arr[$i], PDO::PARAM_STR);
    $stmt->execute();
}

// 商品
$sql = 'INSERT INTO
            items (name, price, stock, descript, category_id)
        VALUES
            (:name, :price, :stock, :descript, :category_id)';
$stmt = $pdo->prepare($sql);
for ($i = 0; $i < 10; $i++) {
    $arr = array(
        "name" => $faker->unique()->name,
        "price" => $faker->numberBetween(1000,10000),
        "stock" => $faker->numberBetween(1,100),
        "descript" => $faker->sentence(8),
        "cate_id" => $faker->numberBetween(1,9)
    );
    $stmt->bindParam(':name', $arr['name'], PDO::PARAM_STR);
    $stmt->bindParam(':price', $arr['price'], PDO::PARAM_INT);
    $stmt->bindParam(':stock', $arr['stock'], PDO::PARAM_INT);
    $stmt->bindParam(':descript', $arr['descript'], PDO::PARAM_STR);
    $stmt->bindParam(':category_id', $arr['cate_id'], PDO::PARAM_INT);
    $stmt->execute();
}

// adminユーザー作成
$password = password_hash('test1234', PASSWORD_BCRYPT);
$sql = "INSERT INTO
            users (name, email, password, role)
        VALUES
            ('admin', 'admin@admin.com', :password, 1)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->execute();
