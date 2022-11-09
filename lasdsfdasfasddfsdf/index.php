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

$sql = "SELECT * FROM `ASSIGNMENT_2`";
$result = $conn->query($sql);

if (!$result){
    die("Query failed ".$conn->error); //FIXME remove details once working.
}




//now output as table
$result->data_seek(0);
?>
<form action ="index.php" method ="post">
 <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>date_of_completion</th>
            <th>width(mm)</th>
            <th>height(mm)</th>
            <th>price(£)</th>
            <th>description </th>

        </tr>
        <?php
        if ($result->num_rows>0){
            while ($row = $result->fetch_assoc()){
                echo "<tr>".
                    "<td>".$row["id"]."</td>".
                    "<td>".$row["name"]."</td>".
                    "<td>".$row["date_of_completion"]."</td>".
                    "<td>".$row["width(mm)"]."</td>".
                    "<td>".$row["height(mm)"]."</td>".
                    "<td>".$row["price(£)"]."</td>".
                    "<td>".$row["description"]."</td>"."</tr>";
                ?> <td><input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/form.php?id=<?=$row['id'];?>';" value="Purchase" /></td> <?php

            }
        }

        ?>
    </table></form>



<?php


//Disconnect
$conn->close();
?>

</body>
</html>