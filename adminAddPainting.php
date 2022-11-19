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




if(!isset($userFile)) {
    echo '<p>Please select a file</p>';
}

if($name && $date_of_completion && $width && $height && $price && $description && is_uploaded_file($_FILES["userfile"]['tmp_name']) && getimagesize($_FILES["userfile"]['tmp_name']) != false){
 /***  get the image info. ***/
    $info = getimagesize($_FILES['userfile']['tmp_name']);
    $type = $info['mime'];
    $imgfp = file_get_contents($_FILES['userfile']['tmp_name']);
    $dims = $info[3];
    $imgName = basename($_FILES['userfile']['name']);
    $imgType = pathinfo($imgName, PATHINFO_EXTENSION);
    $maxsize = 999999;
    $allowTypes = array('jpg','png','jpeg','gif');      //https://www.codexworld.com/store-retrieve-image-from-database-mysql-php/


    echo "<p>Image of name '$imgName', type $type, dimensions $dims and size " . $_FILES['userfile']['size'] . "B uploaded successfully</p>"; //FIXME Debug info
    if(in_array($imgType, $allowTypes)){
        $image = $_FILES['userfile']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        if ($_FILES['userfile']['size'] < $maxsize) {
                $insert = $conn->prepare("INSERT INTO `ASSIGNMENT_2` (`name`, `date_of_completion`, `width(mm)`, `height(mm)`, `price(£)`,`description`,`id`, `image`)".
                        " VALUES ('$name', '$date_of_completion','$width', '$height','$price', '$description',NULL, (?))");

                if (!$insert->bind_param('b', $imgfp)) {
                            die("Failed to bind parameter");
                }//FIXME only show error during debugging
                if (!$insert->send_long_data(0, $imgfp)) {
                            die("Failed to send long data");
                }//FIXME only show error during debugging
                if (!$insert->execute()) {
                            die("Failed to execute query " . $insert->error);
                }//FIXME only show error during debugging

                        printf("%d Row inserted with ID %d.\n", $insert->affected_rows, $conn->insert_id);


                    echo "Painting added succesfully!";

                    $select = "SELECT * FROM `ASSIGNMENT_2`  WHERE `id` = ".$conn->insert_id;
                    $result = $conn->query($select);

                    if (!$result){
                        die("Query failed ".$conn->error); //FIXME remove details once working.
                    }



        }else{
            die ("Must be appropriate size of image".$conn->error);
        }
    }else{
        die ("Must be of type jpg, png, jpeg or gif".$conn->error);
    }
}else {//invalid submission - show the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["add"])) {
        echo "failed to add painting to database";
    }
}









?>
<form action ="adminAddPainting.php" method ="post" id = "myForm" enctype = "multipart/form-data">
<input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/admin.php'" value="Back to admin screen" />


        <h2>Add painting to database: </h2>

        <p>Name: <input type="text" name="name" value="<?php echo $name; ?>" placeholder="name"></p>
        <p>Date of completion:   <input type="date" name="date_of_completion" value="<?php echo $date_of_completion; ?>" placeholder="date of completion"></p>
        <p>Width(mm):   <input type="text" name="width" value="<?php echo $width; ?>" placeholder="width"></p>
        <p>Height(mm):   <input type="text" name="height" value="<?php echo $height; ?>" placeholder="height"></p>
        <p>Price(£):   <input type="text" name="price" value="<?php echo $price; ?>" placeholder="price"></p>
        <p>Description:   <input type="text" name="description" value="<?php echo $description; ?>" placeholder="description"></p>
    <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
    <p>Image :<div><input name="userfile" type="file" /></div></p>


        <p><input type="submit" name="add" value="add"></p>





</form>

<!--<form enctype="multipart/form-data" action="adminAddPainting.php" method="post">-->
<!---->
<!--    <div><input type="submit" value="Submit" /></div>-->
<!--</form>-->

<?php


//Disconnect
$conn->close();
?>

</body>
</html>