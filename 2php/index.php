<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP index</title>
</head>
<body>
    <h1> PHP Index</h1>
    <p><?php
        echo ("3"==3);
        echo("<br>");

        $x = 1;
        $y = 3;
        $z = $x/$y;
        echo "$x / $y = " . round($z,2);
        echo "<br>\n";

        $a = "123";
        $b = "321";
        echo $a+$b;

        echo "<br>\n";
        $s1 = "hello";
        $s2 = "world";
        echo $s1.$s2."<br>\n";
        echo strtoupper($s1)."<br>\n";
        echo strrev($s1)."<br>\n";
        echo strlen($s1)."<br>\n";
        echo substr($s2,1,3)."<br>\n";
        echo str_replace("l","-",$s1)."<br>\n";

        echO"</p><p>";
        $price = 100;
        if($price>=100){
            echo "That is too expensive";

        }else{
            echo "That is fine, thanks";
        }

        echo($price<50) ? " - it is very cheap!" :"";

        echo"<br>\n";
        echo "1 --".(TRUE == TRUE)."--"."<br>\n";
        echo "2 --".(FALSE == TRUE)."--"."<br>\n";
        echo "3 --".($a == 123)."--"."<br>\n";
        echo "4 --".(FALSE === TRUE)."--"."<br>\n";
        echo "5 --".(FALSE === TRUE)."--"."<br>\n";
        echo "6 --".($a === 123)."--"."<br>\n";
        echo "7 --".($a === "123")."--"."<br>\n";

        echo "</p><p>\n";

        $names = array("Mark", "Isla", "Bob", "Jane");
        for($i = 0; $i < count($names); $i++){
            echo $names[$i]." ";
        }
        array_push($names, "Sam");

        echo"<br>";
        foreach($names as $name){
            echo "$name ";
        }

        $phones = array("Mark"=>3497, "Isla"=>1111, "Bob"=>2222, "Jane"=>3333);
        $phones["Sam"]=4444;
        unset($phones["Jane"]);
        ksort($phones);
        echo"<br>";
        foreach($phones as $name=>$number){
            echo "$name is on ext $number<br>";
        }


        ?></p>
</body>
</html>