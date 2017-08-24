<?php
    if(isset($_FILES["fileInput"]) && $_FILES["fileInput"] !== null) {
        //saving to folder
        $dir = "images/";
        move_uploaded_file($_FILES["fileInput"]["tmp_name"], $dir. $_FILES["fileInput"]["name"]);
        echo($dir. $_FILES["fileInput"]["name"]);

        //writing to database.
        $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
        $username=$_REQUEST['username'];
        if(count($_REQUEST)>0 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
            $fileName=$_REQUEST['fileName'];
            $fileAddress=$_REQUEST['filePath'];
            $dbStatement=$dbConn->prepare("INSERT INTO `fileUploadTable` (`username`,`filename`,`filepath`,`timestamp`) VALUES (:inUser, :inFileName, :inFilePath, NOW())");
            $dbResult=$dbStatement->execute(array(":inUser"=>$username, ":inFileName"=>$fileName,":inFilePath"=>$fileAddress));
        }
    }
?>