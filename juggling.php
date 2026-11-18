<?php
$store = "Raiken";
$buyer = "John";
$item = "10"; 
$num = 5;            
$total = $item + $num; 
$price_str = "12.50";
$tax = 2;
$total_price = $price_str + $tax; 
$has_membership = true;
$loyalty_points = 100 + $has_membership; 
$welcome_msg = "Your Exclusive Ranking Membership: " . true; 

$the_sRank = true;
$srank_discount = 5.00;
$final_price = $total_price - ($the_sRank ? $srank_discount : 0);
$rank_status = $the_sRank ? "S-Rank Member" : "Standard";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Type Juggling</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <h1>Hi there <?= $buyer ?>, Welcome to <?= $store ?>'s Level Grounds!</h1>
        <h2>Shopping Receipt</h2>
        <p>Account Type: <?= $rank_status ?></p>
        <p>Available today: <?= $item ?> apples</p>
        <p>Total items: <?= $total ?></p>
        <p>Price with tax: $<?= $total_price ?></p>

        <h2>For HIGH RANKS/WITH MEMBERSHIPS only</h2>
        <p>Exclusive Rank Final Price: $<?= $final_price ?></p>
        <p>Loyalty points: <?= $loyalty_points ?></p>
        <p>Message: <?= $welcome_msg ?></p>
    </body>
</html>




