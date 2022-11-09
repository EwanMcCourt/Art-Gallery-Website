<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 3</title>
</head>
<body>
<h1>Lab 3</h1>
<?php

$forename = strip_tags(isset($_GET["forename"]) && ($_GET["forename"]!=="") ? $_GET["forename"] : "");
$surname = strip_tags(isset($_GET["surname"]) && ($_GET["surname"]!=="") ? $_GET["surname"] : "");
$title = strip_tags(isset($_GET['title']) && ($_GET['title']!=="") ? $_GET['title'] : "");
$hour = date('H', time());

if ($forename && $surname){//Both required variables are set - show response


    if( $hour > 0 && $hour <= 12) {
        echo "Good Morning, $title $forename $surname.";
    }
    else if($hour > 12 && $hour <= 18) {
        echo "Good Afternoon, $title $forename $surname.";
    }
    else if($hour > 18 && $hour <= 24) {
        echo "Good Evening, $title $forename $surname.";
    }


} else{
    if ($forename ||$surname) {
    echo "<p>Form completion errors - please check all fields.</p>";
}

    ?>

    <form action="lab3.php" method="get">
        <select name="title" id="title">
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Ms">Ms</option>
            <option value="Dr">Dr</option>
        </select>
        <p>Name: <input type="text" name="forename" value="<?php echo $forename; ?>" placeholder="forename">
            <input type="text" name="surname" value="<?php echo $surname; ?>" placeholder="surname"></p>

        <p><input type="submit"></p>
    </form>
    <?php
}

?>
</body>
</html>