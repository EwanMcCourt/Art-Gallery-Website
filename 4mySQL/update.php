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
 * User: Mark
 * Date: 07/10/2022
 */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MySQL Update</title>
</head>
<body>
<h1>MySQL Update</h1>
<?php

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

$id = safePost($conn, "id");
$stage = safePost($conn, "stage");

if ($stage==="3") {
    /***** STAGE 3 - Update table for user $id */
    $name = safePost($conn, "name");
    $phone = safePost($conn, "phone");
    $email = safePost($conn, "email");
    $twitter = safePost($conn, "twitter");
    $facebook = safePost($conn, "facebook");

    echo "<p>Update for form $id</p>";

    if ($name==="") die("Sorry a name is needed");
    if ( ($phone==="") && ($email==="") && ($twitter==="") && ($facebook==="")) die("Sorry some contact details needed");

    $sql = "UPDATE `000_phonebook` SET ".
        "`name`     = '$name', ".
        "`email`    = '$email', ".
        "`phone`    = '$phone', ".
        "`twitter`  = '$twitter', ".
        "`facebook` = '$facebook' ".
        "WHERE `000_phonebook`.`id` = $id";

//    echo "<p>$sql</p>";

    if ($conn->query($sql)) {
        echo "<p>Update successfull - thank you</p>";
    } else {
        die ("Update failed".$conn->error);//FIXME remove details once working.
    }
} else if ($stage==="2") {
    /***** STAGE 2 - Show the form for user $id */
    echo "<p>Updating user id $id</p>";

    $sql = "SELECT * FROM `000_phonebook`  WHERE `id` = $id";
    $result = $conn->query($sql);
    if (!$result){
        die("Query failed ".$conn->error); //FIXME remove details once working.
    }
    //first output as paragraphs
    if ($result->num_rows===1){
        while ($row = $result->fetch_assoc()){
            echo "<p>".$row["name"]." ".$row["email"]." ".$row["phone"]." ".$row["twitter"]." ".$row["facebook"]." "."</p>";
            ?>
            <form action="update.php" method="post">
                <input type="hidden" name="stage" value="3">
                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                <p><label for="name">Name: </label><input name="name" id="name" type="text" value="<?php echo $row["name"]; ?>"></p>
                <p><label for="mail">Email: </label><input name="email" id="email" type="text" value="<?php echo $row["email"]; ?>"></p>
                <p><label for="phone">Phone: </label><input name="phone" id="phone" type="text" value="<?php echo $row["phone"]; ?>"></p>
                <p><label for="twitter">Twitter: </label><input name="twitter" id="twitter" type="text" value="<?php echo $row["twitter"]; ?>"></p>
                <p><label for="facebook">Facebook: </label><input name="facebook" id="facebook" type="text" value="<?php echo $row["facebook"]; ?>"></p>
                <p><input type="submit"></p>
            </form>
            <?php
        }
    }

} else {//stage not set so assume stage 1
    /***** STAGE 1 - Show the select menu to pick a user to edit */
    ?>
    <form method="post" action="update.php">
        <input type="hidden" name="stage" value="2">
        <p><label for="id">Choose a user to edit:</label>

            <select name="id" id="id">
                <?php
                $sql = "SELECT * FROM `000_phonebook`";
                $result = $conn->query($sql);

                if (!$result){
                    die("Query failed ".$conn->error); //FIXME remove details once working.
                }

                //first output as paragraphs
                if ($result->num_rows>0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value=\"".$row["id"]."\">".$row["id"]." - ".$row["name"]."</option>";
                    }
                }

                ?>
            </select></p>
        <p><input type="submit"></p>
    </form>
    <?php
}

//Disconnect
$conn->close();
?>

</body>
</html>