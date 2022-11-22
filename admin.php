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
        body  {
            background-color:#343a40;

        }

        p{
            color:white;
        }
    </style>

        <meta charset="UTF-8">
    <title>ASSIGNMENT 2</title>


</head>
<body>

<?php
session_start();

if(isset($_SESSION["sessionPass"])){

    $password = $_SESSION["sessionPass"];
    $sessionPass= $_SESSION["sessionPass"];
}else{
    $password = strip_tags(isset($_POST["password"]) && ($_POST["password"]!=="") ? $_POST["password"]: "");
    $sessionPass="";
}

$loginOK= ($password == "YouAskMeHow22")||($sessionPass =="YouAskMeHow22");


if($loginOK){
    $_SESSION["sessionPass"]=$password;
}
//The admin section should be password protected. If you are splitting this across multiple pages then best practice is use of session variable once logged in to one page - a little technical extension mark if you do this...
/*
 * Simple function to make get a POST variable safely (tags stripped and MySQL escapes added
 */



?>
<form action ="admin.php" method ="post" id = "myForm" >
    <p>For security, please input the password to access administrator screen. </p>


    <p>Password: <input type="password" class="form-control "  name="password" value="<?php echo $password; ?>" required><p>
              <input type="submit" name="login" value="login" class="btn btn-primary"></p>
    <?php

    if (isset($_POST["login"]) || $loginOK ) {
        if($password==="YouAskMeHow22"){
    ?>

    <input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/adminViewOrders.php'" value="View Orders" class="btn btn-secondary "/>
    <input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/adminAddPainting.php'" value="Add Painting" class="btn btn-secondary " />
    <input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/adminRemoveOrders.php'" value="Remove Order" class="btn btn-secondary "/>



</form><?php
}else{
            echo "<p> Incorrect password. </p>";
}
}







?>









</body>
</html>