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
            Enter your name:
            <input type="text" name="name" required>
        </label>
    </div>

    <div style="margin-top: 20px">
        <label>
            Enter your age:
            <input type="number" name="age" required>
        </label>
    </div>

    <button style="margin-top: 20px" type="submit">Submit</button>
</form>

<div style="margin-top: 20px">
    <?php
    if (isset($_POST['name']) && isset($_POST['age'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];

        echo "Hello! My name is '$name'.";
        echo "<br>";
        echo "I'm $age years old";
    }
    ?>
</div>

</body>
</html>