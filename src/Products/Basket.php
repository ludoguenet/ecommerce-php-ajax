<?php

namespace App\Products;

use App\Database\Database;

class Basket
{
    /**
     * @var Database
     */
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param int $product_id
     * @return bool
     */
    public function add(int $product_id): bool
    {
        $this->ensureStarted();
        if (isset($_SESSION['panier'][$product_id])) {
            $_SESSION['panier'][$product_id] += 1;
        } else {
            $_SESSION['panier'][$product_id] = 1;
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function getRawBasket()
    {
        $this->ensureStarted();
        return $_SESSION['panier'];
    }

    public function delete(int $product_id): bool
    {
        $this->ensureStarted();
        if (array_key_exists($product_id, $_SESSION['panier'])) {
            unset($_SESSION['panier'][$product_id]);
            return true;
        } else {
            return false;
        }
    }

    public function total(): int
    {
        $this->ensureStarted();
        $total = 0;
        $ids = array_keys($_SESSION['panier']);
        if ($ids) {
            $products = $this->database->query("SELECT * FROM products WHERE id IN (" . implode(',', $ids) . ")");
        } else {
            $products = [];
        }
        foreach ($products as $product) {
            $total += $product->price * $_SESSION['panier'][$product->id];
        }
        return ceil($total);
    }

    private function ensureStarted(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
    }
}