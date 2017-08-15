<?php
    $errorStr="";
    $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
    $username=$_REQUEST['username'];
    $sessionToken=$_REQUEST['session'];

    $dbStatement=$dbConn->prepare("SELECT `username` FROM `loginSessionTable` WHERE `username` = :inUser");
    $dbResult=$dbStatement->execute(array(":inUser"=>$username));
    $results=$dbStatement->fetchAll(PDO::FETCH_ASSOC);
    if(count($results)!==0){
        $dbStatement=$dbConn->prepare("SELECT `timestamp` FROM `loginSessionTable` WHERE `username` = :inUser AND `session` = :inSession");
        $dbResult=$dbStatement->execute(array(":inUser"=>$username,":inSession"=>$sessionToken));
        $results=$dbStatement->fetchAll(PDO::FETCH_ASSOC);
        $timestampDB=new DateTime($results[0]['timestamp']);
        print_r($timestampDB);
        $timestampNow=new DateTime(date("H:i:s"));
        print_r( $timestampNow);
        $diff=$timestampDB->diff($timestampNow);
        print_r($diff->format('%i Minutes %s Seconds'));
        if($diff<24){
            $arr = array ('code'=>"OK");
            echo json_encode($arr);
        }

    }

?>