<?php

ob_start();
include ('config/database.php');

// $query = $dbh->prepare("DROP TABLE IF EXISTS products");
// $query->execute();

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
      'img' => BASE_URL.'/assets/img/product/1.webp',
      'name' => 'Oversize Cotton Dress',
      'description' => 'Colorful cutout dress Tiered dress Plunging neckline Marie sleeves Waist cutout detail with belt Open back with an elasticated waistband Maxi length',
      'tag' => 'Sale',
      'price' => 85000,
      'categories' => 'Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/2.webp',
      'name' => 'KIENA DRESS',
      'description' => 'Sexy black fringe dress Thick ribbed fabric Figure-hugging dress Round neckline Long sleeves Fringed Midi length',
      'tag' => 'Sale',

      'price' => 90000,
      'categories' => 'Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/3.webp',
      'name' => 'TALIA WRAP DRESS - BLUE',
      'description' => 'Flirty wrap dress Long sleeves with buttoned cuff Detailed gold embroidery design Comes with a self-tie sash Tiered hem Mini length',
      'tag' => 'Sale',

      'price' => 67500,
      'categories' => 'Mini Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/4.webp',
      'name' => 'TALIA WRAP DRESS - WHITE',
      'description' => 'Flirty wrap dress Long sleeves with buttoned cuff Detailed gold embroidery design Comes with a self-tie sash Tiered hem Mini length',
      'tag' => 'Sale',

      'price' => 67500,
      'categories' => 'Mini Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/5.webp',
      'name' => 'JOIE DRESS',
      'description' => 'Elegant guipure lace shirt dress Cap sleeve with button detail Collared Double breast pockets Double flap pocket Comes with a slip dress Detachable belt Calf length',
      'tag' => 'Sale',

      'price' => 68500,
      'categories' => 'Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/6.webp',
      'name' => 'ROYAL DRESS',
      'description' => 'Regal shift dress Floral V neckline Long sleeves with zipped cuff Tiered dress Side zip Ankle length',
      'tag' => 'Sale',

      'price' => 85000,
      'categories' => 'Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/7.webp',
      'name' => 'NAOMI SHIRT DRESS',
      'description' => 'Vibrant print shirt dress Collared with stone details Long sleeves with buttoned stoned cuff Comes with a self-tie sash Midi length',
      'tag' => 'Sale',

      'price' => 70000,
      'categories' => 'Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/8.webp',
      'name' => 'OVIEL DRESS - BLUE',
      'description' => 'Casual swing layered dress Guipure halter high neckline Lacey back detailing Comes with a self-tie sash Lace hem Ankle length',
      'tag' => 'Sale',

      'price' => 85000,
      'categories' => 'Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/9.webp',
      'name' => 'OVIEL DRESS - WHITE',
      'description' => 'Casual swing layered dress Guipure halter high neckline Lacey back detailing Comes with a self-tie sash Lace hem Ankle length',
      'tag' => 'Sale',

      'price' => 85000,
      'categories' => 'Dress',
      'quantity' => rand(100, 900),
      'status' => 'active',
    ],
    [
      'img' => BASE_URL.'/assets/img/product/10.webp',
      'name' => 'HAILEY DRESS',
      'description' => 'Elegant black dress Round neckline Exaggerated bow sleeve detailing Mesh neck detailing Back zip Back slit Calf length',
      'tag' => 'Sale',

      'price' => 65000,
      'categories' => 'Dress',
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