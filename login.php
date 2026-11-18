<?php
// login.php - Hunter login with a 5-attempt limit
require 'includes/config.php';

$status = 'form';   // form | success | locked
$error = '';
$attempts = 0;
$member = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attempts = isset($_POST['attempts']) ? (int) $_POST['attempts'] : 0;
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($attempts < 0) {
        $attempts = 0;
    }

    if ($attempts >= $max_attempts) {
        $status = 'locked';
    } elseif ($username === '' || $password === '') {
        $error = 'Please enter both your username and password, Hunter.';
    } else {
        // LOOP: look for a matching Hunter account
        foreach ($members as $m) {
            if ($m['username'] === $username && $m['password'] === $password) {
                $member = $m;
                break;
            }
        }

        if ($member !== null) {
            $status = 'success';
        } else {
            $attempts++;
            if ($attempts >= $max_attempts) {
                $status = 'locked';
            } else {
                $error = 'Wrong username or password.';
            }
        }
    }
}

$attempts_left = $max_attempts - $attempts;

// Everything the Hunter dashboard needs
if ($status === 'success') {
    // SWITCH: perks depend on rank
    switch ($member['rank']) {
        case 'S':
            $rank_title = 'S-Rank Member';
            $stars_count = 5;
            $discount = 20;
            break;
        case 'A':
            $rank_title = 'A-Rank Member';
            $stars_count = 3;
            $discount = 10;
            break;
        case 'B':
            $rank_title = 'B-Rank Member';
            $stars_count = 1;
            $discount = 5;
            break;
        default:
            $rank_title = 'Standard';
            $stars_count = 0;
            $discount = 0;
    }

    // FOR LOOP: one star per rank level
    $stars = '';
    for ($i = 1; $i <= $stars_count; $i++) {
        $stars .= '★';
    }

    // WHILE LOOP: spend loyalty points to level up (each level costs 50 more)
    $points_left = $member['points'];
    $level = 1;
    $needed = 100;
    while ($points_left >= $needed) {
        $points_left -= $needed;
        $level++;
        $needed += 50;
    }
    $to_next = $needed - $points_left;

    $planner_cost = 55;   // White Chocolate, same price as expressionAndOperators.php
}

$page_title = 'Hunter Login';
include 'includes/header.php';
?>

<?php if ($status === 'success') { ?>

    <h2>Welcome, <?= $member['username'] ?>! Login successful.</h2>
    <p>Rank: <?= $rank_title ?> <?= $stars ?></p>
    <p>Rank discount: <?= $discount ?>%</p>
    <p>Loyalty level: <?= $level ?> (<?= $to_next ?> points to level <?= $level + 1 ?>)</p>

    <h2>Hunter Shop</h2>
    <table>
        <tr>
            <th>Candy</th>
            <th>Price</th>
            <th>Your price</th>
            <th>Stock</th>
            <th>Status</th>
        </tr>
        <?php foreach ($candies as $candy) { ?>
            <?php
            $sale = $candy['price'] - ($candy['price'] / 100) * $discount;
            if ($candy['stock'] == 0) {
                $label = 'Sold out';
            } elseif ($candy['stock'] < 10) {
                $label = 'Low stock';
            } else {
                $label = 'Available';
            }
            ?>
            <tr>
                <td><?= $candy['name'] ?></td>
                <td>$<?= $candy['price'] ?></td>
                <td>$<?= $sale ?></td>
                <td><?= $candy['stock'] ?></td>
                <td><?= $label ?></td>
            </tr>
        <?php } ?>
    </table>

    <h2>Bulk Order Planner: White Chocolate</h2>
    <table>
        <tr>
            <th>Packs</th>
            <th>Subtotal</th>
            <th>After discount</th>
            <th>Tax (20%)</th>
            <th>Total</th>
        </tr>
        <?php for ($packs = 1; $packs <= 5; $packs++) { ?>
            <?php
            $subtotal = $planner_cost * $packs;
            $after = $subtotal - ($subtotal / 100) * $discount;
            $tax = ($after / 100) * 20;
            $total = $after + $tax;
            ?>
            <tr>
                <td><?= $packs ?></td>
                <td>$<?= $subtotal ?></td>
                <td>$<?= $after ?></td>
                <td>$<?= $tax ?></td>
                <td>$<?= $total ?></td>
            </tr>
        <?php } ?>
    </table>

    <p><a class="button" href="login.php">Log out</a></p>

<?php } elseif ($status === 'locked') { ?>

    <h2>Account sealed</h2>
    <p class="error">You failed the password <?= $max_attempts ?> times, Hunter. Login is locked.</p>
    <p>Please ask the Guild Master to reset your account.</p>
    <p><a class="button" href="login.php">Back to the Guild Hall</a></p>

<?php } else { ?>

    <h2>Welcome Hunter! Login your account now</h2>

    <?php if ($error !== '') { ?>
        <p class="error"><?= $error ?></p>
    <?php } ?>

    <p>Attempts left:
        <?php
        for ($i = 1; $i <= $max_attempts; $i++) {
            echo ($i <= $attempts_left) ? '🍬 ' : '✖ ';
        }
        ?>
        (<?= $attempts_left ?>/<?= $max_attempts ?>)
    </p>

    <form method="post" action="login.php">
        <p>
            <label>Username<br>
            <input type="text" name="username"></label>
        </p>
        <p>
            <label>Password<br>
            <input type="password" name="password"></label>
        </p>
        <input type="hidden" name="attempts" value="<?= $attempts ?>">
        <p><input type="submit" class="button" value="Login"></p>
    </form>

<?php } ?>

<?php include 'includes/footer.php'; ?>
