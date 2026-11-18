<?php
$name = "Kennedy";
$favorites = ['White Chocolates', 'Toffe', 'Caramel',];
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Echo Shorthand</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <h1>The Candy Store</h1>
        <h2>Welcome <?php echo $name; ?></h2>
        <p>Your favorite type of candy is: <?php echo$favorites[0]; ?></p>
    </body>
</html>