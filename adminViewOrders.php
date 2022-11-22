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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


        <style>
            body{
                background-color:#343a40;
            }

            #backButton{
                margin:10px;

            }
            h1{
                color:white;

                text-align: left;
                margin-left:30px;
                font-weight: bold;
                text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;


            }
        </style>
        <meta charset="UTF-8">
        <title>ASSIGNMENT 2</title>
    </head>
    <body>

<?php
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

$sql = "SELECT * FROM `ASSIGNMENT_2_ORDERS`";
$result = $conn->query($sql);

if (!$result){
    die("Query failed ".$conn->error); //FIXME remove details once working.
}

$result->data_seek(0);
?>
<form action ="admin.php" method ="post" id = "myForm">
   <div id = "backButton"> <input  type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/admin.php'" value="Back to admin screen" class="btn btn-secondary "/></div>
       <table class = "table table-striped table-dark table-hover"><h1>Current orders:</h1>
        <thead class="thead-light">
        <tr>
            <th>order_id</th>
            <th>painting_id</th>
            <th>name</th>
            <th>phone_number</th>
            <th>email</th>
            <th>postal_address</th>

        </tr></thead>
        <?php
        if ($result->num_rows>0){
            while ($row = $result->fetch_assoc()){
                echo "<tr>".
                    "<td>".$row["order_id"]."</td>".
                    "<td>".$row["painting_id"]."</td>".
                    "<td>".$row["name"]."</td>".
                    "<td>".$row["phone_number"]."</td>".
                    "<td>".$row["email"]."</td>".
                    "<td>".$row["postal_address"]."</td>".
                    "</tr>";
            }
        }

        ?>
    </table>
</form>

<?php