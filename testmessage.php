    <?php
    $message="Testing from cinemachoodu";
    $username = "pappu";
    $password = "manoj3567";
    $sender = "CINEMA";
    $domain = "sms.pappuit.com";
    $method = "POST";
    $mobile = "9581594325";
    $username = urlencode($username);
    $password = urlencode($password);
    $sender = urlencode($sender);
    $message = urlencode($message);
    $parameters = "username=$username&password=$password&to=$mobile&from=$sender&message=$message";
    $fp = fopen("http://$domain/SendSms.aspx?$parameters", "r");
    $response = stream_get_contents($fp);
    fpassthru($fp);
    fclose($fp); 

    ?>