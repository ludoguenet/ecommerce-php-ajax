<?php
require 'vendor/autoload.php';
$db = new \App\Database\Database('ecommerce');
$product = $db->prepare('SELECT * FROM products WHERE id = ?', $_GET['id'] ?? null);
if ($product) {
    $panier = new \App\Products\Basket($db);
    $panier->add($product->id);
} else {
    header('500 Internal Server Error', true, '500');
}


