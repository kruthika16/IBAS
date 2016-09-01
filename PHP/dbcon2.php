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
      else
          echo "Connected successfully";


		  $db = "INSERT INTO user VALUES(
			       'krishnamurthy.ms19@gmail.com',
             'abpsjsjsddosjdhjdlldjdjdjlfkjjddhhendjdjdkdldjfjhfhfhdjdkdkd',
             '12.343533',
             '79.7747474',
             '13.4757575',
             '80.0848484')";
	
		$sql = mysqli_query($con,$db);
		if($sql)
			echo "Inserted to Table user inserted successfully";
		else
			echo "failure(Table user)";

    $db = "INSERT INTO bus VALUES(
             '234',
             'freeware',
             '12.343533',
             '79.7747474')";
  
    $sql = mysqli_query($con,$db);
    if($sql)
      echo "Inserted to Table Bus inserted successfully";
    else
      echo "failure(Table user)";

    $db = "INSERT INTO destination VALUES(
             '5th main,7th cross,chamarajpet, bangalore - 560018',
             '12.343533',
             '79.7747474')";
  
    $sql = mysqli_query($con,$db);
    if($sql)
      echo "Inserted to Table destination inserted successfully";
    else
      echo "failure(Table user)";
		mysqli_close($con);
	?>