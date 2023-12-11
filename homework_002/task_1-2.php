<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 1-2</title>
</head>
<body>

<form method="post" action="">
    <div style="margin-top: 20px">
        <label>
            Type first number:
            <input type="number" name="number1" required>
        </label>
    </div>

    <div style="margin-top: 20px">
        <label>
            Type second number:
            <input type="number" name="number2" required>
        </label>
    </div>

    <button style="margin-top: 20px" type="submit">Submit</button>
</form>

<div style="margin-top: 20px">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number1 = $_POST["number1"] ?? '';
        $number2 = $_POST["number2"] ?? '';

        if (is_numeric($number1) && is_numeric($number2)) {
            $largerNumber = ($number1 > $number2) ? $number1 : $number2;

            if ($number1 % $number2 === 0) {
                echo "$number1 is a multiple of $number2.";
            }
            else {
                echo "$number1 is not multiple of $number2.";
            }

            $square = $largerNumber * $largerNumber;
            echo "<br>";
            echo "The square of the larger number ($largerNumber) is: $square.";
        } else {
            echo "Please enter valid numeric values.";
        }
    }
    ?>
</div>

</body>
</html>