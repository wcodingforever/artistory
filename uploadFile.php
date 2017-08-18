<?php

    $errorStr="";
    $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
    $username=$_REQUEST['username'];
    if(count($_REQUEST)>0 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
        $fileName=$_REQUEST['fileName'];
        $fileAddress=$_REQUEST['filePath'];
        $dbStatement=$dbConn->prepare("INSERT INTO `fileUploadTable` (`username`,`filename`,`filepath`,`timestamp`) VALUES (:inUser, :inFileName, :inFilePath, NOW())");
        $dbResult=$dbStatement->execute(array(":inUser"=>$username, ":inFileName"=>$fileName,":inFilePath"=>$fileAddress));
    }

?>