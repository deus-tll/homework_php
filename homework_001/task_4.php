<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 4</title>
</head>
<body>

<form method="post" action="">
    <div style="margin-top: 20px">
        <label>
            Enter the first number:
            <input type="number" name="num1" required>
        </label>
    </div>

    <div style="margin-top: 20px">
        <label>
            Enter the second number:
            <input type="number" name="num2" required>
        </label>
    </div>

    <button style="margin-top: 20px" type="submit">Swap Numbers</button>
</form>

<div style="margin-top: 20px">
    <?php
    if (isset($_POST['num1']) && isset($_POST['num2'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];

        echo "Before swapping: num1 = $num1, num2 = $num2";
        echo "<br>";

        $num1 = $num1 + $num2;
        $num2 = $num1 - $num2;
        $num1 = $num1 - $num2;

        echo "After swapping: num1 = $num1, num2 = $num2";
    }
    ?>
</div>

</body>
</html>