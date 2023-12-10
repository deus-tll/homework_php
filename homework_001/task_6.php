<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 6</title>
</head>
<body>

<?php
$tag = $_POST['tag'] ?? 'div';
$background_color = $_POST['background_color'] ?? 'blue';
$color = $_POST['$color'] ?? 'red';
$width = $_POST['width'] ?? '100px';
$height = $_POST['height'] ?? '100px';
?>

<form method="post" action="">
    <div style="margin-top: 20px">
        <label>
            Tag:
            <input type="text" id="tag" name="tag" value="<?php echo $tag; ?>" required>
        </label>
    </div>

    <div style="margin-top: 20px">
        <label>
            Background Color:
            <input type="text" id="background_color" name="background_color" value="<?php echo $background_color; ?>" required>
        </label>
    </div>

    <div style="margin-top: 20px">
        <label>
            Text Color:
            <input type="text" id="color" name="color" value="<?php echo $color; ?>" required>
        </label>
    </div>

    <div style="margin-top: 20px">
        <label>
            Width:
            <input type="text" id="width" name="width" value="<?php echo $width; ?>" required>
        </label>
    </div>

    <div style="margin-top: 20px">
        <label>
            Height:
            <input type="text" id="height" name="height" value="<?php echo $height; ?>" required>
        </label>
    </div>

    <button style="margin-top: 20px" type="submit">Generate Styled Tag</button>
</form>

<div style="margin-top: 20px">
    <?php
    echo "<$tag style='background-color: $background_color; color: $color; width: $width; height: $height;'>";
    echo "This is a $tag with custom styles.";
    echo "</$tag>";
    ?>
</div>

</body>
</html>