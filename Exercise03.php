<?php

session_start();

foreach (['product', 'quantity', 'price'] as $key) {
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = [];
    }
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $_SESSION['product'] = $name;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 03</title>
</head>

<body>
    <h1>Shopping list</h1>
    <form method="POST" action="#">
        <label for="name">name:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="quantity">quantity:</label>
        <input type="number" id="quantity" name="quantity"><br><br>

        <label for="price">price:</label>
        <input type="number" id="price" name="price"><br><br>

        <input type="submit" name="add" value="Add">
        <input type="submit" name="upd" value="Update">
        <input type="reset" value="Reset">
    </form>
</body>

</html>