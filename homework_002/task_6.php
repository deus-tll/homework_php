<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 6</title>
</head>
<body>

<?php
$session_id = rand(0, 1);
?>

<div style="margin-top: 20px">
    <p><?php echo "Session ID: $session_id";?></p>
</div>

<?php
if ($session_id == 0) {
    ?>
    <form method="post" action="">
        <div style="margin-top: 20px">
            <label>
                Login:
                <input type="text" name="login" id="login" required>
            </label>
        </div>

        <div style="margin-top: 20px">
            <label>
                Password:
                <input type="password" name="password" required>
            </label>
        </div>

        <button style="margin-top: 20px" type="submit">Submit</button>
    </form>
    <?php
}
elseif ($session_id == 1) {
    echo "You are registered. Please <a href='#'>log in</a>.";
}
else {
    echo "Invalid session_id value.";
}
?>

</body>
</html>