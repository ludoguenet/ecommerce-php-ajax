<?php
require 'vendor/autoload.php';
$db = new \App\Database\Database('ecommerce');
$panier = new App\Products\Basket($db);
$response = $panier->delete($_GET['id'] ?? null);
$newTotal = $panier->total();
echo json_encode($newTotal);
if (!$response) {
    header('500 Internal Server Error', true, 500);
}