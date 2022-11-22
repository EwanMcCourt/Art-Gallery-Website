<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        body  {
        background-color:#343a40;
            padding: 30px;
        }
        #theForm{
        padding:5%;
            marging:5%;
        }
        p{
            color: white;
        }
        #theTitle{
            color:white;
            text-align: center;
            font-weight: bold;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;


        }
        h2{
            color:white;
            text-align: center;
            font-weight: bold;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;



        }



    </style>

    <meta charset="UTF-8">
    <title>ASSIGNMENT 2</title>
</head>
<body>
<div id = "theTitle">
<h1>You are purchasing:</h1>
    </div>
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




if ($conn->connect_error){
    die("Connection failed : ".$conn->connect_error); //FIXME remove details once working.
}
$sql = 'SELECT * FROM `ASSIGNMENT_2` WHERE id= '.$id;
$result = $conn->query($sql);

$row = mysqli_fetch_row($result);
if (!$result){
    die("Query failed ".$conn->error); //FIXME remove details once working.
}


if ($name && $phone_number && $email && $postal_address ){

    echo "<p>Thank you! Your order has been placed.<p>";


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


    ?>
    <form action="form.php?id=<?=$id?>" method="post" class ="was-validated">


        <table  class = "table table-striped table-dark table-hover"><tr>
                <thead class="thead-light">
            <th>Name</th>
            <th>Date of completion</th>
            <th>Width(mm)</th>
            <th>Height(mm)</th>
            <th>Price(£)</th>
            <th>Description </th>
            <th>Id</th>
            </tr></thead>
        <?php
        $details = array();

        if ($result->num_rows>0){

            foreach ($row as $value) {
                array_push($details, $value);

            }
            $image = end($details);


            echo '<img class = " img-responsive img-thumbnail rounded mx-auto d-block" id = "image" src="data:image/jpeg;base64,'.base64_encode( $image ).'" width = "75%" height = "75%" style = "margin:30px"/>';

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
        <div id = "theForm">
            <h2> Please fill in the form below to complete your order: </h2>
        <p>Name: <input type="text" name="name" value="<?php echo $name; ?>" placeholder="name" class="form-control is-valid" required></p>
         <p>Phone Number:   <input type="tel" pattern = "^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" name="phone_number" value="<?php echo $phone_number; ?>" placeholder="phone number" class="form-control is-valid" required></p><!--https://www.html5pattern.com/Phones-->

        <p>Email Address: <input type="email" name="email" value="<?php echo $email; ?>" placeholder="email" id = "emailInput" class = "form-control is-valid" required ></p>



        <p>Postal Address:   <input type="text" name="postal_address" value="<?php echo $postal_address; ?>" placeholder="postal address" class="form-control is-valid" required></p>

        <p><input type="submit" class="btn btn-primary"></p></div>
    </form>
    <?php

}
?>
</body>
</html>