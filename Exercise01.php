<?php

session_start(); //iniciamos la sesion

if (!isset($_SESSION['Worker'])) {
    $_SESSION['Worker'] = ''; //inicializamos la variable worker si no estaba inicializada, por eso el if.
}

if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [ //inicializamos la variable inventory si no estaba inicializada, para eso el if.
        'milk' => 3,
        'softdrink' => 0
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['product'];
    $worker = $_POST['worker'];
    $quantity = $_POST['quantity']; // almacenamos en unas cuantas variables los datos que queremos añadir o modificar.

    if (isset($_SESSION['inventory'][$product])) {  // verifico si existe el producto en el inventario
        if (isset($_POST['Add'])) { //si existe y se le da a add, añadimos el valor sumandolo al array de la session.
            $_SESSION['inventory'][$product] += $quantity;
            $_SESSION['Worker'] = $worker;
        } else if ($_SESSION['inventory'][$product] - $quantity >= 0) { // si ha presionado remove, verificamos que no se pueda quedar como negativo.
            if (isset($_POST['Remove'])) {
                $_SESSION['inventory'][$product] -= $quantity;
                $_SESSION['Worker'] = $worker; // almacenamos los valores en la session.
            }
        } else {
            echo "Los productos no pueden ser negativos."; // en el caso de que resulte ser negativo, simplemente mostramos el error y no actualizamos nada.
        }
    }
}

?>

<!-- HTML con el form. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 01</title>
</head>

<body>
    <!-- formulario con el titulo tipo post. -->
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
    // printeamos el worker.
    echo '<h1>Inventory</h1>';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        echo '<p>Worker: ';
        echo $_SESSION['Worker'] . '</p>';
    }
    // printeamos las unidades del inventario actualizadas. 
    echo '<p>Units milk: ';
    echo $_SESSION['inventory']['milk'] . '</p><p>Units soft drink: ';
    echo $_SESSION['inventory']['softdrink'] . '</p>';
    ?>
</body>

</html>