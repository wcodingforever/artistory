<?php

    // $incomingStr = "";
    // foreach ($_REQUEST as $thisKey => $thisVal) $incomingStr .= "[" . $thisKey . "][" . $thisVal. "]".PHP_EOL;
    // file_put_contents("logininfo.log", $incomingStr);

    $errorStr="";
    $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
    if(count($_REQUEST)>0 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
        $username=$_REQUEST['username'];
        $password=$_REQUEST['password'];
        //hashing the password
        $hashedPW= hash("sha256",$password);
        //writing to database 
        $dbStatement=$dbConn->prepare("SELECT `username`,`password` FROM `loginSessionTable` WHERE `username` = :inUser AND `password` = :inPwd");
        $dbResult=$dbStatement->execute(array(":inUser"=>$username,":inPwd"=>$hashedPW));
        $results=$dbStatement->fetchAll(PDO::FETCH_ASSOC);
        if (count($results)!==0){
            $timestamp=date("H:i:s");
            $sessionTokenVal=$hashedPW.$timestamp;
            $sessionToken=hash("sha256",$sessionTokenVal);
            $dbStatement=$dbConn->prepare("UPDATE `loginSessionTable` SET session=:inSession , timestamp=:inTime WHERE password=:inPwd");
            $dbResult=$dbStatement->execute(array(":inSession"=>$sessionToken,":inTime"=>$timestamp,":inPwd"=>$hashedPW));
            //returning json value with the sessiontoken
            $arr = array ('code'=>"OK",'session'=>$sessionToken);
            echo json_encode($arr);
        }
        else{
            $arr = array ('code'=>"ERROR");
            echo json_encode($arr);
        }
    }

    
?>