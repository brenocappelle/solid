<?php

// SRP: Interface responsável apenas por calcular preço
interface PriceCalculable {
    public function calculatePrice();
}

// SRP e ISP: Interface responsável apenas por exibir pizza
interface Displayable {
    public function display();
}

// DIP: Interface de pagamento para implementar métodos de pagamento
interface PaymentMethod {
    public function processPayment($amount);
}

// SRP: Classe apenas de pizza (sem exibição)
class Pizza implements PriceCalculable {
    private $size;
    private $toppings;
    private $basePrice;

    public function __construct($size, $toppings) {
        $this->size = $size;
        $this->toppings = $toppings;
        $this->basePrice = 10; // Preço base fixo para a pizza
    }

    public function calculatePrice() {
        $price = $this->basePrice;

        if ($this->size === 'large') {
            $price += 5;
        }

        $price += count($this->toppings) * 2;
        return $price;
    }

    public function getDescription() {
        return "Pizza de " . implode(", ", $this->toppings) . " - Tamanho: $this->size";
    }
}

// SRP: Responsável pela exibição em HTML das pizzas
class PizzaDisplay implements Displayable {
    private $pizza;

    public function __construct(Pizza $pizza) {
        $this->pizza = $pizza;
    }

    public function display() {
        echo "<h1>" . $this->pizza->getDescription() . "</h1>";
        echo "<p>Preço: R$ " . $this->pizza->calculatePrice() . "</p>";
    }
}

// DIP: Implementação de pagamento para ser usada como dependência injetável
class CreditCardPayment implements PaymentMethod {
    public function processPayment($amount) {
        echo "Processando pagamento de R$ $amount com cartão de crédito...";
    }
}

// SRP e LSP: Classe Pedido com dependências injetadas
class Order {
    private $pizzas;
    private $deliveryAddress;
    private $paymentMethod;

    public function __construct($address, PaymentMethod $paymentMethod) {
        $this->deliveryAddress = $address;
        $this->pizzas = [];
        $this->paymentMethod = $paymentMethod;
    }

    public function addPizza(Pizza $pizza) {
        $this->pizzas[] = $pizza;
    }

    public function calculateTotal() {
        $total = 0;
        foreach ($this->pizzas as $pizza) {
            $total += $pizza->calculatePrice();
        }
        return $total;
    }

    public function processOrderPayment() {
        $totalAmount = $this->calculateTotal();
        $this->paymentMethod->processPayment($totalAmount);
    }
}

// SRP: Classe separada para exibir o pedido
class OrderDisplay implements Displayable {
    private $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function display() {
        echo "<h2>Pedido para: {$this->order->deliveryAddress}</h2>";
        foreach ($this->order->pizzas as $pizza) {
            $pizzaDisplay = new PizzaDisplay($pizza);
            $pizzaDisplay->display();
        }
        echo "<p>Total: R$ " . $this->order->calculateTotal() . "</p>";
    }
}

// Implementação
$paymentMethod = new CreditCardPayment();
$order = new Order("123 Main St", $paymentMethod);

$pizza1 = new Pizza("large", ["queijo", "pepperoni"]);
$pizza2 = new Pizza("medium", ["queijo", "presunto"]);

$order->addPizza($pizza1);
$order->addPizza($pizza2);

$orderDisplay = new OrderDisplay($order);
$orderDisplay->display();
$order->processOrderPayment();

?>
