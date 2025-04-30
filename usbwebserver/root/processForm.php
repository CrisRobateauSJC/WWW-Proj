<!DOCTYPE html>
<body>
    <form action="processForm.php" method="POST">
        Name: <input type="text" name = "name" required> <br>
        Available Day(s):
            Monday<input type="checkbox" name="days[]" value="Monday"><br>
            Tuesday<input type="checkbox" name="days[]" value="Tuesday"><br>
            Wednesday<input type="checkbox" name="days[]" value="Wednesday"><br>
            Thursday<input type="checkbox" name="days[]" value="Thursday"><br>
            Friday<input type="checkbox" name="days[]" value="Friday"><br>
        <input type="submit"> 
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['name']) && isset($_POST['days'])) //use the actual name of the array without squared brackets
    {
        echo htmlspecialchars(stripslashes($_POST['name']))." is available on ";
        foreach($_POST['days'] as $d)
        {
            echo $d." ";
        }
        echo "<br>";
        print_r($_POST['days']);
    }
}
else
{
    if (isset($_GET['name']))
    {
        // query string
        echo $_GET['name']."is available each business day";
    }
}

?>
