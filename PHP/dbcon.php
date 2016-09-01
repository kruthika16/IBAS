<?php
$services_json = json_decode(getenv('VCAP_SERVICES'),true);
      $mySql = $services_json["mysql-5.5"][0]["credentials"];
      $myDbUsername = $mySql["username"];
      $myDbPassword = $mySql["password"];
      $myDbHost = $mySql["hostname"];
      $myDbName = $mySql["name"];
      $myDbPort = $mySql["port"];
  
      $con=mysqli_connect($myDbHost,$myDbUsername,$myDbPassword, $myDbName, $myDbPort);

      if (!$con) 
          die('Could not connect: ' . mysqli_error());
      //else echo "Connected successfully";
//else echo "Connecyed!";

//$conn->close();

?>