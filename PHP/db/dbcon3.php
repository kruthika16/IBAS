<?php
	  $services_json = json_decode(getenv('VCAP_SERVICES'),true);
      $mySql = $services_json["mysql-5.5"][0]["credentials"];
      $myDbUsername = $mySql["username"];
      $myDbPassword = $mySql["password"];
      $myDbHost = $mySql["hostname"];
      $myDbName = $mySql["name"];
      $myDbPort = $mySql["port"];
  
      $con=mysqli_connect($myDbHost,$myDbUsername,$myDbPassword, $myDbName, $myDbPort);

	$fetch=mysqli_query($con,"select busno, license, x, y from bus where 1") or die("mysqli_error($con)"); ?>
	
	<table border="1" style="width:100%; border-collapse: collapse;">
		  <tr>
			<th>busno</th> 
			<th>license</th> 
			<th>x</th>
			<th>y</th>
			
		  </tr>
		  <?php
			while($row=mysqli_fetch_assoc($fetch))
			{
				echo '<tr>';
				echo '<td>'.$row['busno'].'</td>';
				echo '<td>'.$row['license'].'</td>';
				echo '<td>'.$row['x'].'</td>';
				echo '<td>'.$row['y'].'</td>';
				echo '<tr>';
			}
			?>
	</table>

	<?php $fetch=mysqli_query($con,"select * from user where 1") or die("mysqli_error($con)"); ?>
	
	<table border="1" style="width:100%; border-collapse: collapse;">
		  <tr>
			<th>email</th> 
			<th>gcmid</th> 
			<th>x</th>
			<th>y</th>
			<th>destx</th>
			<th>desty</th>
			
		  </tr>
		  <?php
			while($row=mysqli_fetch_assoc($fetch))
			{
				echo '<tr>';
				echo '<td>'.$row['email'].'</td>';
				echo '<td>'.$row['gcmid'].'</td>';
				echo '<td>'.$row['x'].'</td>';
				echo '<td>'.$row['y'].'</td>';
				echo '<td>'.$row['destx'].'</td>';
				echo '<td>'.$row['desty'].'</td>';
				echo '<tr>';
			}
			?>
	</table>


	<?php $fetch=mysqli_query($con,"select * from destination where 1") or die("mysqli_error($con)"); ?>
	
	<table border="1" style="width:100%; border-collapse: collapse;">
		  <tr>
			<th>destname</th>
			<th>x</th>
			<th>y</th>
			
		  </tr>
		  <?php
			while($row=mysqli_fetch_assoc($fetch))
			{
				echo '<tr>';
				echo '<td>'.$row['destname'].'</td>';
				echo '<td>'.$row['x'].'</td>';
				echo '<td>'.$row['y'].'</td>';
				echo '<tr>';
			}
			?>
	</table>