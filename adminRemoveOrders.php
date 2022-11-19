
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ASSIGNMENT 2</title>
</head>
<body>

<?php

$order_id = strip_tags(isset($_POST["order_id"]) && ($_POST["order_id"]!=="") ? $_POST["order_id"] : "");
/*
 * Simple function to make get a POST variable safely (tags stripped and MySQL escapes added
 */


//Connect to MySQL
$host = "devweb2022.cis.strath.ac.uk";//set year for devweb
$user = "vib20137";//your username
$pass = "ush2Cei9uor0";//your MySQL password (or include from a .gitignored file
$dbname = $user;
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error){
    die("Connection failed : ".$conn->connect_error); //FIXME remove details once working.
}






if($order_id ){

    $delete = 'DELETE FROM `ASSIGNMENT_2_ORDERS` WHERE order_id=' .$order_id;

    if ($conn->query($delete)){
        echo "Painting deleted succesfully!";

        $delete = "SELECT * FROM `ASSIGNMENT_2`  WHERE `id` = ".$conn->insert_id;
        $result = $conn->query($delete);

        if (!$result){
            die("Query failed ".$conn->error); //FIXME remove details once working.
        }



    } else {
        die ("query failed ".$conn->error);//FIXME remove details once working.
    }
}else {//invalid submission - show the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["add"])) {
        echo "failed to add painting to database";
    }
}


?>
<form action ="adminRemoveOrders.php" method ="post" id = "myForm">
    <input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/admin.php'" value="Back to admin screen" /><table>


        <h2>Enter Order ID you wish to remove from database: </h2>
        <p>Order_id: <input type="text" name="order_id" value="<?php echo $order_id; ?>" placeholder="order_id"></p>

        <p><input type="submit" name="delete" value="delete"></p>





</form>

<?php


//Disconnect
$conn->close();
?>

</body>
</html>