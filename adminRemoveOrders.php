
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        body{
            background-color:#343a40;
        }
        p{
            color:white;
        }
        #backButton{
            margin:10px;

            top:0px;
            left:0px;
        }
        h1{
            color:white;


            text-align: left;
            margin-left:30px;
            font-weight: bold;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;


        }
        #errorMessage{
            margin:30px;

            position:fixed;
            font-weight: bold;


        }

        #successMessage{
            margin:30px;

            position:fixed;
            font-weight: bold;


        }

        p{
            color:white;

        }
        #theForm{
            margin:30px;
            margin-right:75%;

        }
    </style>


    <meta charset="UTF-8">
    <title>ASSIGNMENT 2</title>
</head>
<body>

<?php

$order_id = strip_tags(isset($_POST["order_id"]) && ($_POST["order_id"]!=="") ? $_POST["order_id"] : "");
$errorMessage = null;
$successMessage = null;
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
    $check =  'SELECT * FROM `ASSIGNMENT_2_ORDERS` WHERE order_id=' .$order_id;

    $checkResult = $conn->query($check);

    if ($conn->query($check)) {

        if (mysqli_num_rows($checkResult) > 0) {
            if ($conn->query($delete)){
                $successMessage = "<div id = 'successMessage'><p>Order deleted succesfully!</p></div>";


                $result = $conn->query($delete);

                if (!$result){
                    echo("<div id = 'errorMessage'><p>Query failed </p></div>".$conn->error); //FIXME remove details once working.
                }
        }
    } else {
        $errorMessage= ("<div id = 'errorMessage'><p>Query failed: No such record exists </p> </div>".$conn->error);//FIXME remove details once working.
    }





    }
}else {//invalid submission - show the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["add"])) {
        echo "failed to remove order from database";
    }
}


?>
<form action ="adminRemoveOrders.php" method ="post" id = "myForm"  class ="was-validated">
    <input id = "backButton" type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/admin.php'" value="Back to admin screen" class="btn btn-secondary "/><table>


        <h1>Enter order ID you wish to remove from database: </h1><div id = "theForm">
        <p>Order_id: <input type="number"  class="form-control is-valid" name="order_id" value="<?php echo $order_id; ?>" placeholder="order_id" required></p>

        <p><input type="submit" name="delete" value="delete" class="btn btn-primary"></p>

        </div>
        <?php
        if($successMessage){
            echo $successMessage;
        }
        if($errorMessage){
            echo $errorMessage;
        }
        ?>


</form>

<?php


//Disconnect
$conn->close();
?>

</body>
</html>