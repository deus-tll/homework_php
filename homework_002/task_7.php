<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 7</title>
</head>
<body>

<?php
$x = 150;
$y = 150;
$color = "red";
?>

<script>
  const screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
  const screenHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

  const x = <?php echo $x; ?>;
  const y = <?php echo $y; ?>;

  if (x >= 0 && x <= screenWidth && y >= 0 && y <= screenHeight) {
    const div = document.createElement("div");
    div.style.position = "absolute";
    div.style.left = "<?php echo $x; ?>px";
    div.style.top = "<?php echo $y; ?>px";
    div.style.width = "50px";
    div.style.height = "50px";
    div.style.backgroundColor = "<?php echo $color; ?>";
    document.body.appendChild(div);
  }
  else {
    const div = document.createElement("div");
    div.innerHTML = "<p>Invalid coordinates. The point is outside the screen boundaries.</p>";
    document.body.appendChild(div);
  }
</script>

</body>
</html>