<?php

namespace App\Products;

use App\Database\Database;

class Product
{
    /**
     * @var Database
     */
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getProducts()
    {
        return $this->database->query('SELECT * FROM products');
    }
}