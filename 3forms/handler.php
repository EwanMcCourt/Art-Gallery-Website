<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My First Reply</title>
</head>
<body>
<h1>My first reply</h1>
<p><?php

    $ishappy = isset($_GET["happy"]) && ($_GET["happy"]==="yes");
    $forename = strip_tags(isset($_GET["forename"]) && ($_GET["forename"]!=="") ? $_GET["forename"] : "pal");

    echo "Hi $forename.";
    if ($ishappy){
        echo " Glad you are happy!";
    }

    ?></p>
</body>
</html>