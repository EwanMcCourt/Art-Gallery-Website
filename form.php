<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ASSIGNMENT 2</title>
</head>
<body>
<h1>Order Form</h1>
<?php
$name = strip_tags(isset($_POST["name"]) && ($_POST["name"]!=="") ? $_POST["name"] : "");
$phone_number = strip_tags(isset($_POST["phone_number"]) && ($_POST["phone_number"]!=="") ? $_POST["phone_number"] : "");
$email= strip_tags(isset($_POST["email"]) && ($_POST["email"]!=="") ? $_POST["email"] : "");
$postal_address=isset($_POST["postal_address"]);
$host = "devweb2022.cis.strath.ac.uk";//set year for devweb
$user = "vib20137";//your username
$pass = "ush2Cei9uor0";//your MySQL password (or include from a .gitignored file
$dbname = $user;
$conn = new mysqli($host, $user, $pass, $dbname);
$id = intval($_GET["id"]);
if ($conn->connect_error){
    die("Connection failed : ".$conn->connect_error); //FIXME remove details once working.
}
$sql = 'SELECT * FROM `ASSIGNMENT_2` WHERE id= '.$id;
$result = $conn->query($sql);

$row = mysqli_fetch_row($result);
if (!$result){
    die("Query failed ".$conn->error); //FIXME remove details once working.
}


if ($name && $phone_number && $email && $postal_address){//Both required variables are set - show response

    echo "Thank you! Your order has been placed.";


    $insert = "INSERT INTO `ASSIGNMENT_2_ORDERS` (`order_id`,`painting_id`, `name`, `phone_number`, `email`, `postal_address`)".
        " VALUES (NULL,'$id', '$name', '$phone_number','$email', '$postal_address')";

    if ($conn->query($insert)){
        echo "<p>Your order ID is:  ".$conn->insert_id."</p>";

        $insert = "SELECT * FROM `ASSIGNMENT_2_ORDERS`  WHERE `order_id` = ".$conn->insert_id;
        $result = $conn->query($insert);

        if (!$result){
            die("Query failed ".$conn->error); //FIXME remove details once working.
        }



    } else {
        die ("query failed ".$conn->error);//FIXME remove details once working.
    }
} else {//invalid submission - show the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {  //https://stackoverflow.com/questions/1372147/check-whether-a-request-is-get-or-post
        echo "<p>Form completion errors - please check all fields.</p>";
    }
    ?>
    <form action="form.php?id=<?=$id?>" method="post">
        <p>You are purchasing: </p>
        <table><tr>

            <th>name</th>
            <th>date of completion</th>
            <th>width(mm)</th>
            <th>height(mm)</th>
            <th>price(£)</th>
            <th>description </th>
                <th>id</th>
        </tr></table>
        <?php

        foreach ($row as $value) {
        echo "$value";
        }?>
        <p>Please fill in your details in the form below.</p>
        <p>Name: <input type="text" name="name" value="<?php echo $name; ?>" placeholder="name"></p>
         <p>Phone Number:   <input type="text" name="phone_number" value="<?php echo $phone_number; ?>" placeholder="phone number"></p>
        <p>Email:   <input type="text" name="email" value="<?php echo $email; ?>" placeholder="email"></p>
        <p>Postal Address:   <input type="text" name="postal_address" value="<?php echo $postal_address; ?>" placeholder="postal address"></p>

        <p><input type="submit"></p>
    </form>
    <?php
}

?>
</body>
</html>