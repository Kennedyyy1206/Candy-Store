<?php
$items = 3;
$cost = 55;
$subtotal = $cost * $items;
$tax = ($subtotal/100) * 20;
$total = $subtotal + $tax;
$prefix = 'Thank you';
$name = 'Kennedy';
$message = $prefix . ', ' . $name;
$item = "White Chocolate";
$stock = 7;
$wanted = 3;
$deliver = true;
$can_buy = (($wanted <= $stock) && ($deliver == true));
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Expression and Operators</title>
        <link rel="stylesheet" href="css/styles.css">
        </head>
        <body>
            <h1>The Candy Store</h1>
            <h2><?= $name?>'s Order</h2>
            <h2>Shopping Cart</h2>
            <p>Items: <?= $items ?></p>
            <p>Cost per pack: $<?= $subtotal ?></p>
            <p>Tax: $<?= $tax ?></p>
            <p>Total: $<?= $total ?></p>
            <p><?= $message ?>-san!</p>

                <h2>Shoppng Cart Items</h2>
                    <p>Item: <?= $item ?></p>
                    <p>Stock: <?= $stock ?></p>
                    <p>Ordered: <?= $wanted ?></p>
                    <p>Can buy: <?= $can_buy ?></p>


        </body>
    </html>