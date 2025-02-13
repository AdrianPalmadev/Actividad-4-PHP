<?php

session_start();

if (!isset($_SESSION['product'])) {
    $_SESSION['product'] = [];
}
if (!isset($_SESSION['quantity'])) {
    $_SESSION['quantity'] = [];
}
if (!isset($_SESSION['price'])) {
    $_SESSION['price'] = [];
}

if (isset($_POST['add'])) {
    $_SESSION['product'] = $_POST['name'];
    $_SESSION['quantity'] = $_POST['quantity'];
    $_SESSION['price'] = $_POST['price'];
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
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br><br>

        <input type="submit" name="add" value="Add">
        <input type="submit" name="upd" value="Update">
        <input type="reset" value="Reset">
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
        </thead>

        <?php
        if (!empty($_SESSION['product'])) {
            //            for ($i = 0; $i < count($_SESSION['product']); $i++) {
        ?>

            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($_SESSION['product']); ?></td>
                    <td><?php echo htmlspecialchars($_SESSION['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($_SESSION['price']); ?></td>
                    <td><?php echo ($_SESSION['quantity'] * $_SESSION['price']); ?></td>
                    <td><input type="submit" name="edit" value="Edit"><input type="button" name="delete" value="Delete"></td>
                </tr>
            </tbody>

        <?php
        }
        //    }
        ?>

        <tfoot>
            <tr>
                <td colspan="3">Total:</td>
                <td>0</td>
                <td><button>Calculate total</button></td>
            </tr>
        </tfoot>

    </table>
</body>

</html>