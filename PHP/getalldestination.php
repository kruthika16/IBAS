<?php
include 'dbcon.php';
$ans="";
$result=mysqli_query($con,"select * from destination")
	or die(mysqli_error());
while($row=mysqli_fetch_array($result))
$ans=$ans.$row["destname"].",";
echo $ans;

?>