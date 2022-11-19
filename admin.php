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


$password = strip_tags(isset($_POST["password"]) && ($_POST["password"]!=="") ? $_POST["password"]: "");
//The admin section should be password protected. If you are splitting this across multiple pages then best practice is use of session variable once logged in to one page - a little technical extension mark if you do this...
/*
 * Simple function to make get a POST variable safely (tags stripped and MySQL escapes added
 */



?>
<form action ="admin.php" method ="post" id = "myForm">
    <p>For security, please input the password to access administrator screen. </p>
    Password: <input type="password" name="password" value="<?php echo $password; ?>" ><p><input type="submit" name="login" value="login"></p>
    <?php
    if (isset($_POST["login"]) || isset($_POST["add"])) {
        if ($password === "YouAskMeHow22"){

    ?>

    <input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/adminViewOrders.php'" value="View Orders" />
    <input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/adminAddPainting.php'" value="Add Painting" />
    <input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/adminRemoveOrders.php'" value="Remove Order" />



</form><?php
}
}
?>


</body>
</html>