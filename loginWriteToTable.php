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
        $dbStatement=$dbConn->prepare("INSERT INTO `loginSessionTable` (`username`,`password`) VALUES (:inUser, :inPwd)");
        $dbResult=$dbStatement->execute(array(":inUser"=>$username,":inPwd"=>$hashedPW));

        $tmpErrorsArr = $dbStatement->errorInfo();  // Any other errors?
        if ($tmpErrorsArr[0] !== "00000") $errorStr .= implode(" -- ", $tmpErrorsArr); // 00000 is no errors.
    }

    $arr = array();
    if ($errorStr !== "") {
        $arr = array ('code' => "ERROR", 'msg' => $errorStr);
    } else {
        $arr = array ('code' => "OK");
    }
    echo json_encode($arr);
?>




