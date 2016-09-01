<?php
include 'dbcon.php';
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
?>
<?php

//this block is to post message to GCM on-click
$pushStatus = "";


//this block is to receive the GCM regId from external (mobile apps)
if(!empty($_GET["shareRegId"]))
{
    $gcmRegID  = $_POST["regId"];
    $emailid = $_GET["email"];
	
	//see what I have done below, and do the same in your website
	
	
    $result=mysqli_query($con,"select * from user where gcmid='$gcmRegID'")
            or die(mysqli_error());
    
    if(mysqli_num_rows($result)==0)
    {
        $result1=mysqli_query($con,"insert into user values('$emailid','$gcmRegID','0','0','0','0')")
                or die(mysqli_error());

    }
	
	
    echo "Ok!";
    exit;
}
?>
<html>
<head>
<title>Google Cloud Messaging (GCM) Server in PHP</title>
</head>
<body>
<h1>Google Cloud Messaging (GCM) Server in PHP</h1>
<form method="post" action="gcmnew.php/?push=1">
                           <div>
                           <textarea rows="2" name="message" cols="23" placeholder="Message to transmit via GCM"></textarea>
                                   </div>
                                   <div><input type="submit"  value="Send Push Notification via GCM" /></div>
                                           </form>
                                           <p><h3><?php //echo $pushStatus;
?></h3></p>
</body>
</html>
