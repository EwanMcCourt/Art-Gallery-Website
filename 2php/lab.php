<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab2</title>
</head>
<body>
<h1>Your age</h1>
<p><?php
    $today = new DateTime();
    $date = DateTime::createFromFormat('d F Y', '29 September 2022');

    function daysBetween($day1, $day2){
        return $day1->diff($day2)->format("%d");


    }

    echo "<p> Today is ".date("d F Y").". Your pet is ".daysBetween($date,$today). " days old";


?>
</p>
</body>
</html>