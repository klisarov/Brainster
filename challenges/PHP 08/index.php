<?php

require_once 'Orange.php';
require_once 'Potato.php';
require_once 'Nuts.php';
require_once 'Kiwi.php';
require_once 'Pepper.php';
require_once 'Raspberry.php';

// produkt
class Product {
    private $name;
    private $price;
    private $sellingByKg;

    public function __construct($name, $price, $sellingByKg) {
        $this->name = $name;
        $this->price = $price;
        $this->sellingByKg = $sellingByKg;
    }

    public function getName() {
        return $this->name;
    }

    public function isSellingByKg() {
        return $this->sellingByKg;
    }

    // vrakanje na cena
    public function getPrice() {
        return $this->price;
    }
}

// marketstall klasa
class MarketStall {
    public $products;

    public function __construct($products) {
        $this->products = $products;
    }

    public function addProductToMarket($name, $product) {
        $this->products[$name] = $product;
    }

    public function getItem($name, $amount) {
        if (array_key_exists($name, $this->products)) {
            return ['amount' => $amount, 'item' => $this->products[$name]];
        }
        return false;
    }
}

// cart klasa
class Cart {
    private $cartItems = [];

    public function addToCart($item) {
        if ($item !== false) {
            $this->cartItems[] = $item;
        }
    }

    public function printReceipt() {
        if (empty($this->cartItems)) {
            return "Your cart is empty";
        }

        $finalPrice = 0;
        $receipt = "";

        foreach ($this->cartItems as $item) {
            $product = $item['item'];
            $amount = $item['amount'];
            $totalItemPrice = $product->getPrice() * $amount;
            $finalPrice += $totalItemPrice;

            $unit = $product->isSellingByKg() ? "kgs" : "gunny sacks";
            $receipt .= "{$product->getName()} | {$amount} {$unit} | total= {$totalItemPrice} MKD\n";
        }

        $receipt .= "Final price amount: {$finalPrice}";
        return $receipt;
    }
}


$orange = new Product('Orange', 35, true);
$potato = new Product('Potato', 240, false);
$nuts = new Product('Nuts', 850, true);
$kiwi = new Product('Kiwi', 670, false);
$pepper = new Product('Pepper', 330, true);
$raspberry = new Product('Raspberry', 555, false);

$marketStall1 = new MarketStall([
    'orange' => $orange,
    'potato' => $potato,
    'nuts' => $nuts
]);

$marketStall2 = new MarketStall([
    'kiwi' => $kiwi,
    'pepper' => $pepper,
    'raspberry' => $raspberry
]);

$cart = new Cart();
$cart->addToCart($marketStall1->getItem('orange', 3));
$cart->addToCart($marketStall2->getItem('raspberry', 2));
$cart->addToCart($marketStall2->getItem('pepper', 1));

echo $cart->printReceipt();

?>