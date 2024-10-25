<?php

class Pizza {
    public $toppings;
    public $size;
    public $price;

    public function __construct($size, $toppings) {
        $this->size = $size;
        $this->toppings = $toppings;
        $this->price = 0;
    }

    // Calcula o preço da pizza com base nos ingredientes e no tamanho
    public function calculatePrice() {
        $this->price = 10; // Preço base
        if ($this->size === 'large') {
            $this->price += 5;
        }
        $this->price += count($this->toppings) * 2;
        return $this->price;
    }

    // Exibe a pizza no formato HTML
    public function displayPizza() {
        echo "<h1>Pizza de " . implode(", ", $this->toppings) . " - Tamanho: $this->size</h1>";
        echo "<p>Preço: R$ " . $this->calculatePrice() . "</p>";
    }
}

class Order {
    public $pizzas;
    public $deliveryAddress;

    public function __construct($address) {
        $this->deliveryAddress = $address;
        $this->pizzas = [];
    }

    // Adiciona uma pizza ao pedido
    public function addPizza($pizza) {
        $this->pizzas[] = $pizza;
    }

    // Processa o pagamento do pedido
    public function processPayment($amount) {
        echo "Processing payment of R$ $amount...";
    }

    // Calcula o total do pedido
    public function calculateTotal() {
        $total = 0;
        foreach ($this->pizzas as $pizza) {
            $total += $pizza->calculatePrice();
        }
        return $total;
    }

    // Exibe o pedido no formato HTML
    public function displayOrder() {
        echo "<h2>Pedido para: $this->deliveryAddress</h2>";
        foreach ($this->pizzas as $pizza) {
            $pizza->displayPizza();
        }
        echo "<p>Total: R$ " . $this->calculateTotal() . "</p>";
    }
}

$order = new Order("123 Main St");
$pizza1 = new Pizza("large", ["queijo", "pepperoni"]);
$pizza2 = new Pizza("medium", ["queijo", "presunto"]);

$order->addPizza($pizza1);
$order->addPizza($pizza2);
$order->displayOrder();
$order->processPayment($order->calculateTotal());

?>
