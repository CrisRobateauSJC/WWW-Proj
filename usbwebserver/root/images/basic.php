<?php
//declare(strict_types=1); //used to ensure that functions will only run when the arguments passed into the function are the data types of the parameters specified at function creation (only works in newer versions of PHP).
?>
<!DOCTYPE html>
<body>
    <p>Your one-stop shop for textbooks, SJC apparel, and souvenirs.</p>
    <?php /*PHP codes here*/ 
    // Another comment
    # also a comment
    $variable = 7;
    $num=15;

    echo $variable;
    print "<br> the value of num is $num";
    ECHO "<br>".$num;
    echo $num."<br>";

    define("PASSING", 70);
    print PASSING + $num;

    //alternative syntax
    if($num < 15):
        echo "need larger number";
    else:
        echo "good enough";
    endif;
/*
    function isMultiple(int $a, int $b):bool //you can declare a data type that the parameters will be converted into when passed into the function. You can also specify the return type by putting it after the parameter list.
    {
        return ($a%$b == 0); 
    }
*/
    function passByRef(&$a)
    {
        global $variable; //accessing a global variable within a function
        $a = $a+10;
        echo "<p>in function $variable </p>";
        echo "<p> super globals". $GLOBALS['variable']. "</p>"; //the GLOBALS array can be used to access every global variable
    }
    passByRef($num);
    echo "<br>".$num;

    $week = ["Mon", "Tue", "Wed", "Thur", "Fri"];
    $majors = array("CIS", "CNT", "MIS");
    echo $week[0];
    $week[] = "Sat"; //adding element to the end of the array
    
    ?>