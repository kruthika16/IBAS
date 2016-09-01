<?php

include 'dbcon.php';
$email=$_POST["email"];//echo $email;
$x=$_POST["x"];//echo $x;
$y=$_POST["y"];//echo $y;
$dest=$_POST["dest"];//echo $dest;


$result=mysqli_query($con,"select * from destination where destname='$dest'")
	or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{
$row=mysqli_fetch_array($result);
$destx=$row["x"];
$desty=$row["y"];
//echo $destx;echo $desty;
}
else echo "0 results";
mysqli_query($con,"update user set x=$x, y=$y, destx=$destx, desty=$desty where email='$email'")
or die(mysqli_error());


?>