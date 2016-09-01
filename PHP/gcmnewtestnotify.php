<?php


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
        print_r($message);
        
        echo "Ok!";
    
    
}


?>
<html>
<head>
<title>Google Cloud Messaging (GCM) Server in PHP</title>
</head>
<body>
<h1>Google Cloud Messaging (GCM) Server in PHP</h1>
<form method="post" action="gcmnewtestnotify.php/?push=1">
      <div>
        <textarea rows="2" name="fromwhom" cols="23" placeholder="Message from"></textarea>
      </div>
      <div>
        <textarea rows="2" name="message" cols="23" placeholder="Message Body"></textarea>
      </div>
      <div><input type="submit"  value="Send Push Notifications" /></div>
</form>
<p><h3>
    <?php echo $pushStatus;?>
</h3></p>
</body>
</html>