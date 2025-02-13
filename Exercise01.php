<?php

session_start();
if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [
        'milk' => 3,
        'softdrink' => 0
    ];
    $_SESSION['Worker'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = 0;
    $product = $_POST['product'];
    $worker = $_POST['worker'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['inventory'][$product])) {
        if (isset($_POST['Add'])) {
            $_SESSION['inventory'][$product] += $quantity;
            $_SESSION['Worker'] = $worker;
        } else if ($_SESSION['inventory'][$product] - $quantity >= 0) {
            if (isset($_POST['Remove'])) {
                $_SESSION['inventory'][$product] -= $quantity;
                $_SESSION['Worker'] = $worker;
            }
        } else {
            echo "Los productos no pueden ser negativos.";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 01</title>
</head>

<body>
    <h1>Supermarket management</h1>
    <form action="#" method="post">
        <label for="worker">Worker name:</label>
        <input type="text" name="worker" id="worker" required><br><br>

        <h3>Choose product:</h3>
        <select name="product" id="product" required>
            <option value=""></option>
            <option value="milk">Milk</option>
            <option value="softdrink">Soft drink</option>
        </select><br>

        <h3>Product quantity</h3>
        <input type="number" name="quantity" id="quantity" required><br><br>

        <input type="submit" name="Add" value="Add">
        <input type="submit" name="Remove" value="Remove">
        <input type="reset" value="Reset">
    </form>

    <?php
    echo '<h1>Inventory</h1>';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        echo '<p>Worker: ';
        echo $_SESSION['Worker'] . '</p>';
    }
    echo '<p>Units milk: ';
    echo $_SESSION['inventory']['milk'] . '</p><p>Units soft drink: ';
    echo $_SESSION['inventory']['softdrink'] . '</p>';
    ?>
</body>

</html>