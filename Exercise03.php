<?php

// iniciamos la session
session_start();
// verificamos si estan creadas las variables con el is_array verifica si es array o no lo es.
if (!isset($_SESSION['product']) || !is_array($_SESSION['product'])) {
    $_SESSION['product'] = [];
}
if (!isset($_SESSION['quantity']) || !is_array($_SESSION['quantity'])) {
    $_SESSION['quantity'] = [];
}
if (!isset($_SESSION['price']) || !is_array($_SESSION['price'])) {
    $_SESSION['price'] = [];
}

if (isset($_POST['add'])) { // si le da al boton de add, añadiremos valores
    // usamos el count, para que siempre cojamos el indice
    $indice = count($_SESSION['product']); // guardamos el ultimo valor del indice en una variable local
    $_SESSION['product'][$indice] = $_POST['name'];
    $_SESSION['quantity'][$indice] = $_POST['quantity'];
    $_SESSION['price'][$indice] = $_POST['price']; // almacenamos los datos en la session.
}

if (isset($_POST['delete'])) { // en el caso de que le demos al boton simplemente usamos el unset con el indice del boton, que lo recogemos del form
    unset($_SESSION['product'][$_POST['index']]);
    unset($_SESSION['quantity'][$_POST['index']]);
    unset($_SESSION['price'][$_POST['index']]);
}



if (isset($_POST['edit'])) { // si le dan al edit, almacenamos en la session el valor del indice.
    $_SESSION['edit_index'] = $_POST['index'];
}


if (isset($_POST['upd']) && isset($_SESSION['edit_index'])) { //si le dan al update y edit_index tiene valores, updatearemos los valores.
    $editIndex = $_SESSION['edit_index']; // guardamos momentaneamente en una variable local el indice.

    $_SESSION['product'][$editIndex] = $_POST['name'];
    $_SESSION['quantity'][$editIndex] = $_POST['quantity'];
    $_SESSION['price'][$editIndex] = $_POST['price']; // almacenamos los nuevos valores.

    unset($_SESSION['edit_index']); // le quitamos el valor para evitar problemas si volvemos a updatear el valor
}

?>

<!-- HTML con PHP en algunos fragmentos. -->
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
        <input type="text" id="name" name="name" value='<?php if (isset($_POST['edit'])) { // en el caso de que el usuario le de a edit, simplemente printeamos el valor del que queremos editar.
                                                            echo htmlspecialchars($_SESSION['product'][$_POST['index']]);
                                                        } else {
                                                            echo ""; // en caso de que no se le haya dado, lo dejamos vacio.
                                                        } ?>' required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value='<?php if (isset($_POST['edit'])) { // exactamente igual que el anterior pero con la cantidad
                                                                        echo htmlspecialchars($_SESSION['quantity'][$_POST['index']]);
                                                                    } else {
                                                                        echo "";
                                                                    } ?>' required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value='<?php if (isset($_POST['edit'])) { // igual pero con el precio.
                                                                echo htmlspecialchars($_SESSION['price'][$_POST['index']]);
                                                            } else {
                                                                echo "";
                                                            } ?>' required><br><br>

        <input type="submit" name="add" value="Add">
        <input type="submit" name="upd" value="Update">
        <input type="reset" value="Reset">
    </form>


    <!-- añadimos una tabla con borde, en la que almacenamos los productos. -->
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
            if (!empty($_SESSION['product'])) { // si el array de productos esta vacio, obviamos entrar
                for ($i = 0; $i < (max(array_keys($_SESSION['product'])) + 1); $i++) { // cogemos el numero maximo del indice y hacemos un bucle
                    if (!empty($_SESSION['product'][$i])) { //verificamos que el indice que cogemos no esta vacio
            ?>
                        <tr>
                            <!-- lo printeamos en el bucle. -->
                            <td><?php echo htmlspecialchars($_SESSION['product'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($_SESSION['quantity'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($_SESSION['price'][$i]); ?></td>
                            <!-- calculamos el total de este mismo producto. -->
                            <td><?php echo ($_SESSION['quantity'][$i] * $_SESSION['price'][$i]); ?></td>
                            <td>
                                <!-- aqui, almacenaremos en un input hidden (que no se ve en pantalla) el indice del boton que seleccionamos -->
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
            } // cerramos todos los bucles e if
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total:</td>
                <td>
                    <?php
                    $total = 0;
                    if (isset($_POST['total'])) { // aqui en el caso de que le den a total, calculamos el total y lo printeamos
                        for ($i = 0; $i < (max(array_keys($_SESSION['product'])) + 1); $i++) {
                            if (!empty($_SESSION['product'][$i])) {
                                $total += $_SESSION['quantity'][$i] * $_SESSION['price'][$i];
                            }
                        }
                    }
                    echo $total; // como hemos inicializado la variable antes, pues simplemente será 0 en el caso de que no se le de al boton.
                    ?>
                </td>
                <td>
                    <!-- creamos el boton de calcular el tota. -->
                    <form method="POST" action="#">
                        <input type="submit" name="total" value="Calculate total">
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>