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
        body,html  {
            background-color:#343a40;


           }


        #thePage{
        position: absolute;
            width:100%;
            background-color:#343a40 ;

        }


        .carousel-inner {

           height:100%;



        }

        .carousel-item{
            position: fixed;
            height:100%;



        }
        #carouselExampleIndicators{
            height:75%;
        }
        .carousel-item img {

            min-width: 100%;
            min-height: 100%
        }

        table{
            z-index: =99999;
            position: relative;
            top:25%;
        }

        #pagination{
            padding:10px;
        }

        .page-link {
            border:#6c757d; background-color: #6c757d; color: #fff;

        }
        .page-link:hover {
            border:#545b62; background-color: #545b62; color: #fff;
        }




        /*https://stackoverflow.com/questions/4919076/outline-effect-to-text*/
        #theTitle{


            position:absolute;
            align:center;

              font-weight: bold;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;

        }



    </style>

    <meta charset="UTF-8">
    <title>ASSIGNMENT 2</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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
$per_page = 12;
$page = isset($_GET["page"]) ? $_GET["page"] :1;
$start = ($page-1)*$per_page;
$previous = $page-1;
$next = $page+1;



if ($conn->connect_error){
    die("Connection failed : ".$conn->connect_error); //FIXME remove details once working.
}

$sql = "SELECT * FROM `ASSIGNMENT_2`";
$sql1 = "SELECT * FROM `ASSIGNMENT_2` LIMIT $start, $per_page" ;
$result = $conn->query($sql);
$result1 = $conn->query($sql1);
$duplicateResult1 =  $conn->query($sql1);
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results/$per_page);




if (!$result1){
    die("Query failed ".$conn->error); //FIXME remove details once working.
}



$arrayOfPaintings=[];
//now output as table
$result1->data_seek(0);




?>
<form  action ="index.php" method ="post">

   <?php while ($row = $duplicateResult1->fetch_assoc()){
    array_push($arrayOfPaintings,$row['image'] );
   }?>
    <!--    //https://stackoverflow.com/questions/48824568/bootstrap-4-carousel-sliders-not-working-->
    <div id="carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
            <ol  class="carousel-indicators">
                <li  data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="z-index: 9999; "></li>
                <?php for($i=1; $i < count($arrayOfPaintings); $i++) {
                    ?>

                   <li data-target="#carouselExampleIndicators" data-slide-to=<?php echo $i ?> style="z-index: 9999; "></li>


                    <?php
                }?>

            </ol>
            <div class="carousel-inner"><div class="carousel-caption  d-md-block" id = "theTitle" style="text-align: center">
                    <h1>CARA'S ART GALLERY</h1 >
                    <p>AFFORDABLE, UNIQUE, LOW RESOLUTION PAINTINGS</p>
                </div>
                <div class="carousel-item active ">
                    <?php echo '<img class="d-block w-100" src="data:image/jpeg;base64,' . base64_encode( $arrayOfPaintings[0] ). '" style=" background-size: cover;  height:100%")/>'?>

                </div>


                <?php for($i=1; $i < count($arrayOfPaintings); $i++) {
                    ?>
                    <div class="carousel-item" >

                        <?php echo '<img class="d-block w-100" src="data:image/jpeg;base64,' . base64_encode( $arrayOfPaintings[$i] ). '" )/>'?>


                    </div>
                    <?php
                }?>


            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>






<div id = "thePage">
 <table class = "table table-striped table-dark table-hover">
     <thead class="thead-light">
        <tr>

            <th>Name</th>
            <th>Image</th>
            <th>Date of completion</th>
            <th>Width (mm)</th>
            <th>Height (mm)</th>
            <th>Price (£)</th>
            <th>Description </th>
            <th>Order now</th>

        </tr>
     </thead>
        <?php
        if ($result1->num_rows>0){

            while ($row = $result1->fetch_assoc()){



                echo "<tr>".

                    "<td>".$row["name"]."</td>".
                    "<td>".'<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"width="100" height="100"/>'."</td>".
                    "<td>".$row["date_of_completion"]."</td>".
                    "<td>".$row["width(mm)"]."</td>".
                    "<td>".$row["height(mm)"]."</td>".
                    "<td>".$row["price(£)"]."</td>".
                    "<td>".$row["description"]."</td>".
                    "<td>"?><input type="button" onclick="location.href='https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/form.php?id=<?=$row['id'];?>';" value="Purchase" class = "btn btn-secondary"/></td></tr>


                 <?php


            }
        }

        ?>
    </table>
    <div id = "pagination">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page>1){?>
                <li class = "page-item">
                <a class="page-link" href="https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/index.php?page=<?= $previous;?>" tabindex="-1" >&laquo;Previous</a>
                </li><?php }else{?>
                <li id = "disabled" class = "page-item disabled">
                    <a class="page-link" href="https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/index.php?page=<?= $page;?>" tabindex="-1" style="background-color: #1b1e21ed">&laquo;Previous</a>
                </li>
            <?php }?>
            <?php for($i=1;$i<=$number_of_pages;$i++) { ?>


                <li><a  class="page-link" href="https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/index.php?page=<?= $i;?>"><?= $i ?></a></li>

            <?php } ?>
            <?php if ($page>=$number_of_pages){?>
                <li class="page-item disabled">
                    <a class="page-link " href="https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/index.php?page=<?= $page;?>" style="background-color: #1b1e21ed" ">Next &raquo;</a>
                </li> <?php }else{?>
                <li class="page-item">
                    <a class="page-link" href="https://devweb2022.cis.strath.ac.uk/~vib20137/test/lasdsfdasfasddfsdf/index.php?page=<?= $next;?>" ">Next &raquo;</a>
                </li>
            <?php }?>
        </ul>
    </nav></div>

</form>


</div>
<?php


//Disconnect
$conn->close();
?>


</body>
</html>