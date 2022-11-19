<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta charset="UTF-8">
    <title>ASSIGNMENT 2</title>
</head>
<body>
<h1>Order Form</h1>
<?php
$name = strip_tags(isset($_POST["name"]) && ($_POST["name"]!=="") ? $_POST["name"] : "");
$phone_number = strip_tags(isset($_POST["phone_number"]) && ($_POST["phone_number"]!=="") ? $_POST["phone_number"] : "");
$email= strip_tags(isset($_POST["email"]) && ($_POST["email"]!=="") ? $_POST["email"] : "");
$postal_address=strip_tags(isset($_POST["postal_address"]) && ($_POST["postal_address"]!=="") ? $_POST["postal_address"] : "");
$host = "devweb2022.cis.strath.ac.uk";//set year for devweb
$user = "vib20137";//your username
$pass = "ush2Cei9uor0";//your MySQL password (or include from a .gitignored file
$dbname = $user;
$conn = new mysqli($host, $user, $pass, $dbname);
$id = intval($_GET["id"]);
$validEmail = False;

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $validEmail =True;
}

if ($conn->connect_error){
    die("Connection failed : ".$conn->connect_error); //FIXME remove details once working.
}
$sql = 'SELECT * FROM `ASSIGNMENT_2` WHERE id= '.$id;
$result = $conn->query($sql);

$row = mysqli_fetch_row($result);
if (!$result){
    die("Query failed ".$conn->error); //FIXME remove details once working.
}


if ($name && $phone_number && $email && $postal_address && $validEmail){

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
        if(!$email || !$validEmail){
            echo "<p>Please complete the 'Email' field with a valid email.</p>";
        }
        if(!$name){
            echo "<p> Please complete the 'Name' field with a valid name.</p>";
        }
        if(!$postal_address){
            echo "<p> Please complete the 'Postal address' field with a valid address.</p>";
        }
        if(!$phone_number){
            echo "<p> Please complete the 'Phone number' field with a valid phone number.</p>";
        }
    }

    ?>
    <form action="form.php?id=<?=$id?>" method="post">
        <p>You are purchasing: </p>
        <table class = "table "><tr>
                <thead class="thead-dark">
            <th>name</th>
            <th>date of completion</th>
            <th>width(mm)</th>
            <th>height(mm)</th>
            <th>price(£)</th>
            <th>description </th>
                <th>id</th>
            </tr></thead>
        <?php
        $details = array();

        if ($result->num_rows>0){

            foreach ($row as $value) {
                array_push($details, $value);

            }
            $image = end($details);
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'"width="750" height="750"/>';
            $sliced = array_slice($details, 0, -1); //https://stackoverflow.com/questions/7096084/getting-all-the-values-in-an-array-except-the-last-one
            $paintingName= $sliced[0];
            $paintingDate= $sliced[1];
            $paintingWidth= $sliced[2];
            $paintingHeight= $sliced[3];
            $paintingPrice= $sliced[4];
            $paintingDescription= $sliced[5];
            $paintingId= $sliced[6];


         echo "<tr>".
            "<td>".$paintingName."</td>".
            "<td>".$paintingDate."</td>".
            "<td>".$paintingWidth."</td>".
            "<td>".$paintingHeight."</td>".
            "<td>".$paintingPrice."</td>".
            "<td>".$paintingDescription."</td>".
            "<td>".$paintingId."</td>".
            "</tr>";

            }?>



       </table>
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