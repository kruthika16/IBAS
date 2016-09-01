<?php

echo "Sri";

include 'dbcon.php';
$busno=$_POST["busno"];echo $email;
$x=$_POST["x"];echo $x;
$y=$_POST["y"];echo $y;
$license=$_POST["license"];echo $dest;


$result=mysqli_query($con,"select * from bus where busno='$busno' and license='$license'")
	or die(mysqli_error());
if(mysqli_num_rows($result)>0)
{
mysqli_query($con,"update bus set x=$x, y=$y where busno='$busno' and license='$license'")
or die(mysqli_error());
}
else
{
mysqli_query($con,"insert into bus values('$busno','$license','$x','$y')")
or die(mysqli_error());
}


$result=mysqli_query($con,"select * from user")
	or die(mysqli_error());
while($row=mysqli_fetch_array($result))
{
	if(abs($row["x"]-$x)<=1.00 || abs($row["y"]-$y)<=1.00)
	pushgcm($busno, $license, $x, $y, $row["gcmid"]);
}


//generic php function to send GCM push notification
function sendPushNotificationToGCM($registatoin_ids, $message)
{
    //Google cloud messaging GCM-API url
    $url = 'https://android.googleapis.com/gcm/send';
    $fields = array(
                  'registration_ids' => $registatoin_ids,
                  'data' => $message,
              );
    // Google Cloud Messaging GCM API Key
    define("GOOGLE_API_KEY", "AIzaSyDjCDI1R5HoyoJg5K5TPmnPaKA_LEa1G-I");
    $headers = array(
                   'Authorization: key=' . GOOGLE_API_KEY,
                   'Content-Type: application/json'
               );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE)
    {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

function pushgcm($busno,$license,$x,$y,$gcmid)
{
//this block is to post message to GCM on-click
$pushStatus = "";
 
    
        //$gcmRegIds = array($gcmRegID);
        $message = array("notify" => "true", "busno" => $busno, "license" => $license, "x" => $x, "y" => $y);
        
                    
        $gcmRegIds1=array();
        $gcmRegIds1[0]=$gcmid;

        $pushStatus = sendPushNotificationToGCM($gcmRegIds1, $message);
        //print_r($message);
        echo $pushStatus;
        
        echo "Ok!";
    
    
}




?>