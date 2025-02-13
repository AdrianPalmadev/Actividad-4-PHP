<?php

session_start();
if (!isset($_SESSION['array'])) {
    $_SESSION['array'] = [10, 20, 22];
}

if (isset($_POST['Modify'])) {
    $value = $_POST['newValue'];
    $position = $_POST['position'];
    $_SESSION['array'][$position] = $value;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 02</title>
</head>

<body>

    <!-- El formulario lo he creado con chatGPT para ahorrarme trabajo. El resto del codigo es mio propio -->
    <form action="#" method="post">
        <h2>Modify array saved in session</h2>
        <label for="position">Position to modify:</label>
        <select id="position" name="position">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>

        <br><br>

        <label for="newValue">New value:</label>
        <input type="text" id="newValue" name="newValue" required>

        <br><br>

        <input type="submit" name="Modify" value="Modify">
        <input type="submit" name="Average" value="Average">
        <input type="reset" value="Reset">
    </form>
    <br><br>



    <?php
    echo "Current array: " . $_SESSION['array'][0] . ", " . $_SESSION['array'][1] . ", " . $_SESSION['array'][2] . '<br><br>';
    if (isset($_POST['Average'])) {
        $sum = $_SESSION['array'][0] + $_SESSION['array'][1] + $_SESSION['array'][2];

        echo "The actual avarage is: " . ($sum / 3);
    }
    ?>

</body>

</html>