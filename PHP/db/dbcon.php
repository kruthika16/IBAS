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

		$db = "CREATE TABLE IF NOT EXISTS user(
			       email text NOT NULL,
             gcmid text NOT NULL,
             x text NOT NULL,
             y text NOT NULL,
             destx text NOT NULL,
             desty text NOT NULL)";
	
		$sql = mysqli_query($con,$db);
		if($sql)
			echo "Table user created successfully";
		else
			echo "failure";

    $db = "CREATE TABLE IF NOT EXISTS bus(
             busno text NOT NULL,
             license text NOT NULL,
             x text NOT NULL,
             y text NOT NULL)";
  
    $sql = mysqli_query($con,$db);
    if($sql)
      echo "Table Bus created successfully";
    else
      echo "failure";

    $db = "CREATE TABLE IF NOT EXISTS destination(
             destname text NOT NULL,
             x text NOT NULL,
             y text NOT NULL)";
  
    $sql = mysqli_query($con,$db);
    if($sql)
      echo "Table destination created successfully";
    else
      echo "failure";
		mysqli_close($con);
	?>