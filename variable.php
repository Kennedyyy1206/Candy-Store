<?php
$name = "Kennedy";
$price = 1200;
$nutrition = [
    'fat' => 20,
    'sugar' => 69,
    'salt' => 89,
];

$nutrition['fat'] = 67;
$nutrition['fiber'] = 6.7;

$best_sellers = ['Chocolate', 'Mints', 'Fudge', 'Bubble gum', 'Toffee', 'Jelly Beans',];

$offers = [
    ['name' => 'Toffee', 'price' => 15, 'stock' => 120,],
    ['name' => 'Mints', 'price' => 25, 'stock' => 66,],
    ['name' => 'Fudge', 'price' => 35, 'stock' => 155,],
];
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Variables</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <h1>The Candy Store</h1>
        <h2>Welcome <?php echo $name; ?></h2>
        <p> The cost of your candy is $<?php echo $price; ?> per pack.</p>
        <p>Fat: <?php echo $nutrition['fat']; ?>%</p>
        <p>Sugar: <?php echo $nutrition['sugar']; ?>%</p>
        <p>Salt: <?php echo $nutrition['salt']; ?>%</p>
        <p>Fiber: <?php echo $nutrition['fiber']; ?>%</p>

        <ul>
            <li><?php echo $best_sellers[0]; ?></li>
            <li><?php echo $best_sellers[1]; ?></li>
            <li><?php echo $best_sellers[2]; ?></li>
        </ul>

        <h2>Offers</h2>
        <p><?php echo $offers[0]['name']; ?> - $<?php echo $offers[0]['price']; ?></p>
        <p><?php echo $offers[1]['name']; ?> - $<?php echo $offers[1]['price']; ?></p>
        <p><?php echo $offers[2]['name']; ?> - $<?php echo $offers[2]['price']; ?></p>

    </body>
</html>