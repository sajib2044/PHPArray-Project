<?php

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [
    "Laptop" => 800,
    "Smartphone" => 500,
    "Headphones" => 50,
    "Keyboard" => 30
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selectedProduct = $_POST['product'];

    if (array_key_exists($selectedProduct, $products)) {

        $_SESSION['cart'][] = [
            "name" => $selectedProduct,
            "price" => $products[$selectedProduct]
        ];

        
        echo "<p><strong>$selectedProduct</strong> has been added to your cart!</p>";
    }
}

if (isset($_GET['view_cart'])) {
    echo "<h2>Your Cart</h2>";
    
    if (empty($_SESSION['cart'])) {
        echo "<p>Your cart is empty.</p>";
    } else {
        $totalCost = 0;
        

        foreach ($_SESSION['cart'] as $item) {
            echo "<p>{$item['name']} - \${$item['price']}</p>";
            $totalCost += $item['price'];  
        }

        echo "<p><strong>Total: \${$totalCost}</strong></p>";
    }

    echo '<p><a href="index.html">Go Back to Shopping</a></p>';
    exit;  
}

if (isset($_GET['clear_cart'])) {
    
    $_SESSION['cart'] = [];
    echo "<p>Your cart has been cleared.</p>";

    echo '<p><a href="index.html">Go Back to Shopping</a></p>';
    exit;  
}
?>
