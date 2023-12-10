<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 3</title>
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
            Select operation:
            <select id="operation" name="operation" required>
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
        </label>
    </div>


    <div style="margin-top: 20px">
        <label>
            Enter the second number:
            <input type="number" name="num2" required>
        </label>
    </div>


    <button style="margin-top: 20px" type="submit">Submit</button>
</form>

<div style="margin-top: 20px">
    <?php
    if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operation'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                $operationSymbol = '+';
                break;
            case 'subtract':
                $result = $num1 - $num2;
                $operationSymbol = '-';
                break;
            case 'multiply':
                $result = $num1 * $num2;
                $operationSymbol = '*';
                break;
            case 'divide':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = 'Undefined (division by zero)';
                }
                $operationSymbol = '/';
                break;
            default:
                $result = 'Invalid operation';
                $operationSymbol = '';
        }

        echo "'$num1' '$operationSymbol' '$num2' = '$result'";
    }
    ?>
</div>

</body>
</html>