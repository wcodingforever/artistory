<?php
    $incomingStr = "";
    foreach ($_REQUEST as $thisKey => $thisVal) $incomingStr .= "[" . $thisKey . "][" . $thisVal. "]".PHP_EOL;
    file_put_contents("logininfo.log", $incomingStr);

    $errorStr="";
    $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
    if(count($_REQUEST)>0 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
        $username=$_REQUEST['username'];
        $password=$_REQUEST['password'];
        //writing to database
        $dbStatement=$dbConn->prepare("INSERT INTO `loginSessionTable` (`username`,`password`) VALUES (:inUser, :inPwd)");
        $dbResult=$dbStatement->execute(array(":inUser"=>$username,":inPwd"=>$password));

        //check to see if things are written into the databse. 
        if ($dbStatement->rowCount() < 1) $errorStr .= " -- COULD NOT ADD ROW TO DATABASE. -- "; // Any rows added?
        $tmpErrorsArr = $dbStatement->errorInfo();  // Any other errors?
        if ($tmpErrorsArr[0] !== "00000") $errorStr .= implode(" -- ", $tmpErrorsArr); // 00000 is no errors.
    }
    if ($errorStr !== "") echo ($errorStr);
    else echo("OK");
?>