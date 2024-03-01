<?php

ob_start();
include ('config/database.php');

$query = $dbh->prepare("SHOW TABLES LIKE :products");
$query->execute([':products' => 'products']);

if (!($query->rowCount() > 0)) {
    $sql = "CREATE TABLE `products` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
        `description` text CHARACTER SET utf8mb4 DEFAULT NULL,
        `tag` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
        `img` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
        `price` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
        `categories` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
        `quantity` int NOT NULL,
        `status` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
        `currency` varchar(255) CHARACTER SET utf8mb4 DEFAULT 'NGN',
        `percentage_off` varchar(255) CHARACTER SET utf8mb4 DEFAULT '25',
        PRIMARY KEY (`id`)
    )";
    $dbh->exec($sql);
}

include ('categories.php');
$categories[rand(0, (count($categories) - 1))];

$products = [
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product1.png',
      'name' => 'Oversize Cotton Dress',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product2.png',
      'name' => 'Boxy Denim Jacket',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product11.png',
      'name' => 'Quilted Shoulder Bag',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product12.png',
      'name' => 'High Ankle Jeans',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product10.png',
      'name' => 'Square Shoulder Bag',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product9.png',
      'name' => 'Light Denim Jacket',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product5.png',
      'name' => 'Wool-blend Jacket',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product8.png',
      'name' => 'Aware organic cotton',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product15.png',
      'name' => 'Western denim shirt',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => 'https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/product11.png',
      'name' => 'OSmock Mini Dresss',
      'description' => ucfirst(str_shuffle('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut numquam ullam is recusandae laborum explicabo id sequi quisquam, ab sunt deleniti quidem ea animi facilis quod nostrum odit! Repellendus voluptas suscipit cum harum dolor sciunt.')),
      'tag' => 'Sale',

      'price' => rand(10000, 24000),
      'categories' => $categories[rand(0, count($categories) - 1)],
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
];

foreach($products as $product) {
  $name = ucwords($product['name']);
  $query = $dbh->prepare("SELECT * FROM products WHERE name = :name LIMIT 1");
  $query->execute(['name' => $name]);
  $row = $query->fetch(PDO::FETCH_ASSOC);

  if(!$row) {
    $query = $dbh->prepare("INSERT INTO products (name, description, price, categories, tag, img, quantity, status, percentage_off, currency) VALUES (:name, :description, :price, :categories, :tag, :img, :quantity, :status, :percentage_off, :currency)");

    $query->execute([
      'name' => $name,
      'description' => $product['description'],
      'price' => $product['price'],
      'img' => $product['img'],
      'quantity' => $product['quantity'],
      'categories' => $product['categories'],
      'tag' => $product['tag'],
      'status' => 'active',
      'percentage_off' => rand(10, 25),
      'currency' => 'NGN'
    ]);
  }
}

$sql = "SELECT * FROM products";
$is_search = isset($_GET['category']) && isset($_GET['query']);

if($is_search) {
  $sql = $sql." WHERE categories LIKE :categories OR name LIKE :query OR description LIKE :query";
}

if(!empty($limit) && is_int($limit)) {
  $sql = $sql." LIMIT $limit";
}

$query = $dbh->prepare($sql);
if($is_search) {
  $search = $_GET['query'];
  $category = $_GET['category'];
  $query->execute([
    'query' => '%'.$search.'%',
    'categories' => $category
  ]);
}else {
  $query->execute();
}

$products = $query->fetchAll(PDO::FETCH_ASSOC);

?>