<?php
    $incomingStr = "";
    foreach ($_REQUEST as $thisKey => $thisVal) $incomingStr .= "[" . $thisKey . "][" . $thisVal. "]".PHP_EOL;
    file_put_contents("logininfo.log", $incomingStr);

    $errorStr="";
    $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
    if(count($_REQUEST)>0 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
        $username=$_REQUEST['username'];
        $password=$_REQUEST['password'];
        //hashing the password
        $hashedPW= hash("sha256",$password);
        //writing to database 
        $dbStatement=$dbConn->prepare("INSERT INTO `loginSessionTable` (`username`,`password`,`session`) VALUES (:inUser, :inPwd,:inHashed)");
        $dbResult=$dbStatement->execute(array(":inUser"=>$username,":inPwd"=>$password,":inHashed"=>$hashedPW));

        // $dbStatement=$dbConn->prepare("SELECT `username` FROM `loginSessionTable` WHERE `username`= :inUser ");
        // $dbResult=$dbStatement->execute(array(":inUser=>$username"));
        // $numOfRows=mysqli_num_rows($dbResult);
        // if ($numOfRows==0){
        //     echo("your username does not exist.");
        // }
        // else{
        //     echo("username correct!");
        //     $dbStatement=$dbConn->prepare("SELECT `username`,`password` FROM `loginSessionTable` WHERE `username` = :inUser AND `password`= :inPwd ");
        //     $dbResult=$dbStatement->execute(array(":inPwd"=>$password,":inUser"=>$username));
        //     $numOfRows=mysqli_num_rows($dbResult);
        //     if ($numOfRows==0){
        //         echo("your user password was invalid does not exist.");
        //     }
        //     else{
        //         echo("success!");
        //     }
        }


?>




