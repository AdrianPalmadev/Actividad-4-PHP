<?php
session_start();

// con el is_array verifica si es array o no lo es.
if (!isset($_SESSION['product']) || !is_array($_SESSION['product'])) {
    $_SESSION['product'] = [];
}
if (!isset($_SESSION['quantity']) || !is_array($_SESSION['quantity'])) {
    $_SESSION['quantity'] = [];
}
if (!isset($_SESSION['price']) || !is_array($_SESSION['price'])) {
    $_SESSION['price'] = [];
}

if (isset($_POST['add'])) {
    // usamos el count, para que siempre cojamos el indice
    $indice = count($_SESSION['product']);
    $_SESSION['product'][$indice] = $_POST['name'];
    $_SESSION['quantity'][$indice] = $_POST['quantity'];
    $_SESSION['price'][$indice] = $_POST['price'];
}

if (isset($_POST['delete'])) {
    unset($_SESSION['product'][$_POST['index']]);
    unset($_SESSION['quantity'][$_POST['index']]);
    unset($_SESSION['price'][$_POST['index']]);
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
        <input type="text" id="name" name="name" value='<?php if (isset($_POST['edit'])) {
                                                            echo htmlspecialchars($_SESSION['product'][$_POST['index']]);
                                                        } else {
                                                            echo "";
                                                        } ?>' required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value='<?php if (isset($_POST['edit'])) {
                                                                        echo htmlspecialchars($_SESSION['quantity'][$_POST['index']]);
                                                                    } else {
                                                                        echo "";
                                                                    } ?>' required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value='<?php if (isset($_POST['edit'])) {
                                                                echo htmlspecialchars($_SESSION['price'][$_POST['index']]);
                                                            } else {
                                                                echo "";
                                                            } ?>' required><br><br>

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
        <tbody>
            <?php
            if (!empty($_SESSION['product'])) {
                for ($i = 0; $i < (max(array_keys($_SESSION['product'])) + 1); $i++) {
                    if (!empty($_SESSION['product'][$i])) {
            ?>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION['product'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($_SESSION['quantity'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($_SESSION['price'][$i]); ?></td>
                            <td><?php echo ($_SESSION['quantity'][$i] * $_SESSION['price'][$i]); ?></td>
                            <td>
                                <form method="POST" action="#">
                                    <input type="hidden" name="index" value="<?php echo $i; ?>">
                                    <input type="submit" name="edit" value="Edit">
                                    <input type="submit" name="delete" value="Delete">
                                </form>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total:</td>
                <td>
                    <?php
                    $total = 0;
                    if (isset($_POST['total'])) {
                        for ($i = 0; $i < (max(array_keys($_SESSION['product'])) + 1); $i++) {
                            if (!empty($_SESSION['product'][$i])) {
                                $total += $_SESSION['quantity'][$i] * $_SESSION['price'][$i];
                            }
                        }
                    }
                    echo $total;
                    ?>
                </td>
                <td>
                    <form method="POST" action="#">
                        <input type="submit" name="total" value="Calculate total">
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>