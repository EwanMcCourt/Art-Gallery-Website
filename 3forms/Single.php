<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My First Form</title>
</head>
<body>
<h1>My first form</h1>
<?php
$ishappy = isset($_POST["happy"]) && ($_POST["happy"]==="yes");
$forename = strip_tags(isset($_POST["forename"]) && ($_POST["forename"]!=="") ? $_POST["forename"] : "");
$surname = strip_tags(isset($_POST["surname"]) && ($_POST["surname"]!=="") ? $_POST["surname"] : "");



if ($forename && $surname){//Both required variables are set - show response
    echo "Hi $forename $surname.";
    if ($ishappy){
        echo " Glad you are happy!";
    }
} else {//invalid submission - show the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {  //https://stackoverflow.com/questions/1372147/check-whether-a-request-is-get-or-post
        echo "<p>Form completion errors - please check all fields.</p>";
    }
    ?>
    <form action="Single.php" method="post">
        <p>Name: <input type="text" name="forename" value="<?php echo $forename; ?>" placeholder="forename">
            <input type="text" name="surname" value="<?php echo $surname; ?>" placeholder="surname"></p>
        <p><input type="checkbox" name="happy" value="yes" <?php if ($ishappy) echo "checked"; ?>> I am happy</p>
        <p><input type="submit"></p>
    </form>
    <?php
}

?>
</body>
</html>