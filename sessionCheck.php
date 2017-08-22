<?php

    if (!isset($_REQUEST['session']) || !isset($_REQUEST['username'])) {
        header("Location: artistory.php");
    }
    else{
        $errorStr="";
        $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
        $username=$_REQUEST['username'];
        $sessionToken=$_REQUEST['session'];

        $dbStatement=$dbConn->prepare("SELECT `username` FROM `loginSessionTable` WHERE `username` = :inUser");
        $dbResult=$dbStatement->execute(array(":inUser"=>$username));
        $results=$dbStatement->fetchAll(PDO::FETCH_ASSOC);
        if(count($results)!==0){
            //fetching the timestampDB from the table.
            $dbStatement=$dbConn->prepare("SELECT `timestamp`, NOW() AS current FROM `loginSessionTable` WHERE `username` = :inUser AND `session` = :inSession");
            $dbResult=$dbStatement->execute(array(":inUser"=>$username,":inSession"=>$sessionToken));
            $results=$dbStatement->fetchAll(PDO::FETCH_ASSOC);

            //getting the difference between timestamps.
            $timestampDB=new DateTime($results[0]['timestamp']);
            // print_r($timestampDB).PHP_EOL;
            $timestampNow=new DateTime($results[0]['current']);
            // print_r($timestampNow).PHP_EOL;
            $interval = $timestampNow->getTimestamp() - $timestampDB->getTimestamp();
            if ($interval < (24 * 60 * 60)) {
                // echo ("WITHIN 24".PHP_EOL);
                $msg = "OK";
            }
            else {
                // echo ("AFTER 24".PHP_EOL);
                header("Location: artistory.php");
            }
            $arr = array ('code'=> $msg);
            echo json_encode($arr);
        }
        
    }
    


?>