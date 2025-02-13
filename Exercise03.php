<?php

session_start();

foreach (['product', 'quantity', 'price'] as $key) {
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = [];
    }
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
        var_dump(__LINE__);
        if (!empty($_SESSION['product'])) {
            var_dump(__LINE__);
            for ($i = 0; $i < count($_SESSION['product']); $i++) {
        ?>

                <tbody>
                    <th><?= htmlspecialchars($_SESSION['name'][$i]); ?></th>
                    <th><?= htmlspecialchars($_SESSION['price'][$i]); ?></th>
                    <th><?= htmlspecialchars($_SESSION['quantity'][$i]); ?></th>
                    <th><?php echo ($_SESSION['quantity'][$i] * $_SESSION['price'][$i]); ?></th>
                    <th><input type="submit" name="edit" id="edit" value="Edit"><input type="button" name="delete" id="delete" value="Delete"></th>
                </tbody>


        <?php
            }
        }
        ?>

        <tfoot>
            <tr>
                <td colspan="3">Total:</td>
                <td><?php

                    ?></td>
                <td><button>Calculate total</button></td>
            </tr>
        </tfoot>
    </table>



</body>

</html>