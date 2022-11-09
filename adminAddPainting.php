<?php
/*
This code is distributed under Creative Commons Attribution 4.0 International
https://creativecommons.org/licenses/by/4.0/

You are free to:
  - Share - copy and redistribute the material in any medium or format
  - Adapt - remix, transform, and build upon the material for any purpose, even commercially.

Under the following terms:
  - Attribution - You must give appropriate credit, provide a link to the license, and indicate
    if changes were made. You may do so in any reasonable manner, but not in any way that suggests
    the licensor endorses you or your use.

The licensor cannot revoke these freedoms as long as you follow the license terms.
No additional restrictions - You may not apply legal terms or technological measures that legally
restrict others from doing anything the license permits.

The suggested attribution is:
   Based on Code by Mark Dunlop from University of Strathclyde, Scotland under
   Creative Commons licence. Source https://personal.cis.strath.ac.uk/mark.dunlop/teaching/
*/
/**
 * Created by IntelliJ IDEA.
 * User: Mark Dunlop
 * Date: 07/10/2022
 */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ASSIGNMENT 2</title>
</head>
<body>

<?php

$name = strip_tags(isset($_POST["name"]) && ($_POST["name"]!=="") ? $_POST["name"] : "");
$date_of_completion = strip_tags(isset($_POST["date_of_completion"]) && ($_POST["date_of_completion"]!=="") ? $_POST["date_of_completion"] : "");
$width = strip_tags(isset($_POST["width"]) && ($_POST["width"]!=="") ? $_POST["width"] : "");
$height = strip_tags(isset($_POST["height"]) && ($_POST["height"]!=="") ? $_POST["height"] : "");
$price = strip_tags(isset($_POST["price"]) && ($_POST["price"]!=="") ? $_POST["price"] : "");
$description = strip_tags(isset($_POST["description"]) && ($_POST["description"]!=="") ? $_POST["description"] : "");

$password = strip_tags(isset($_POST["password"]) && ($_POST["password"]!=="") ? $_POST["password"]: "");

/*
 * Simple function to make get a POST variable safely (tags stripped and MySQL escapes added
 */
function safePost($conn, $name){
    return isset($_POST[$name])?$conn->real_escape_string(strip_tags($_POST[$name])):"";
}

//Connect to MySQL
$host = "devweb2022.cis.strath.ac.uk";//set year for devweb
$user = "vib20137";//your username
$pass = "ush2Cei9uor0";//your MySQL password (or include from a .gitignored file
$dbname = $user;
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error){
    die("Connection failed : ".$conn->connect_error); //FIXME remove details once working.
}






if($name && $date_of_completion && $width && $height && $price && $description ){

    $insert = "INSERT INTO `ASSIGNMENT_2` (`name`, `date_of_completion`, `width(mm)`, `height(mm)`, `price(£)`,`description`,`id`)".
        " VALUES ('$name', '$date_of_completion','$width', '$height','$price', '$description',NULL)";

    if ($conn->query($insert)){
        echo "Painting added succesfully!";

        $insert = "SELECT * FROM `ASSIGNMENT_2`  WHERE `id` = ".$conn->insert_id;
        $result = $conn->query($insert);

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
<form action ="adminAddPainting.php" method ="post" id = "myForm">
<input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/admin.php'" value="Back to admin screen" /><table>


        <h2>Add painting to database: </h2>
        <p>Name: <input type="text" name="name" value="<?php echo $name; ?>" placeholder="name"></p>
        <p>Date of completion:   <input type="date" name="date_of_completion" value="<?php echo $date_of_completion; ?>" placeholder="date of completion"></p>
        <p>Width(mm):   <input type="text" name="width" value="<?php echo $width; ?>" placeholder="width"></p>
        <p>Height(mm):   <input type="text" name="height" value="<?php echo $height; ?>" placeholder="height"></p>
        <p>Price(£):   <input type="text" name="price" value="<?php echo $price; ?>" placeholder="price"></p>
        <p>Description:   <input type="text" name="description" value="<?php echo $description; ?>" placeholder="description"></p>

        <p><input type="submit" name="add" value="add"></p>





</form>

<?php


//Disconnect
$conn->close();
?>

</body>
</html>