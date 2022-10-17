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
    <title>MySQL Select</title>
</head>
<body>
<h1>MySQL Select</h1>
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

$sql = "SELECT * FROM `000_phonebook`";
$result = $conn->query($sql);

if (!$result){
    die("Query failed ".$conn->error); //FIXME remove details once working.
}

echo "<p>".$result->num_rows." rows found.</p>";

//first output as paragraphs
if ($result->num_rows>0){
    while ($row = $result->fetch_assoc()){
        echo "<p>".$row["name"]." ".$row["email"]." ".$row["phone"]." ".$row["twitter"]." ".$row["facebook"]." "."</p>";
    }
}

//now output as table
$result->data_seek(0);
?>
<table>
    <tr>
        <th>name</th>
        <th>email</th>
        <th>phone</th>
        <th>twitter</th>
        <th>facebook</th>
    </tr>
    <?php
    if ($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
            echo "<tr>".
                "<td>".$row["name"]."</td>".
                "<td>".$row["email"]."</td>".
                "<td>".$row["phone"]."</td>".
                "<td>".$row["twitter"]."</td>".
                "<td>".$row["facebook"]."</td>".
                "</tr>";
        }
    }
    ?>
</table>
<?php


//Disconnect
$conn->close();
?>

</body>
</html>