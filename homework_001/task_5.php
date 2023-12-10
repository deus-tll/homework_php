<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 5</title>
</head>
<body>

<form method="post" action="">
    <fieldset>
        <legend>1. What is the capital of France?</legend>
        <label>
            <input type="radio" name="q_1" value="a">
            a) London
        </label>
        <label>
            <input type="radio" name="q_1" value="b">
            b) Paris
        </label>
        <label>
            <input type="radio" name="q_1" value="c">
            c) Berlin
        </label>
        <label>
            <input type="radio" name="q_1" value="d">
            d) Rome
        </label>
    </fieldset>

    <fieldset>
        <legend>2. Which programming languages are web-based?</legend>
        <label>
            <input type="checkbox" name="q_2[]" value="a">
            a) Python
        </label>
        <label>
            <input type="checkbox" name="q_2[]" value="b">
            b) PHP
        </label>
        <label>
            <input type="checkbox" name="q_2[]" value="c">
            c) Java
        </label>
        <label>
            <input type="checkbox" name="q_2[]" value="d">
            d) JavaScript
        </label>
    </fieldset>

    <fieldset>
        <legend>3. Explain the concept of Object-Oriented Programming (OOP).</legend>
        <label>
            You can type your answer here:
            <textarea name="q_3" rows="4" cols="50"></textarea>
        </label>
    </fieldset>

    <button style="margin-top: 20px" type="submit">Submit</button>
</form>

<div style="margin-top: 20px">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h2>Submitted Answers:</h2>";
        echo "<br>";

        $q_1_answer = $_POST['q_1'];
        echo "<p>1.) Your answer: $q_1_answer</p>";

        $q_2_answers = $_POST['q_2'] ?? [];
        echo "<p>2.) Your answers: " . implode(', ', $q_2_answers) . "</p>";

        $q_3_answer = $_POST['q_3'] ?? '';
        echo "<p>3.) Your answer: $q_3_answer</p>";
    }
    ?>
</div>

</body>
</html>