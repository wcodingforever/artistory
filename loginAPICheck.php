<?php
    //reading from database. 
    //debug
    $incomingStr = "";
    foreach ($_REQUEST as $thisKey => $thisVal) $incomingStr .= "[" . $thisKey . "][" . $thisVal. "]".PHP_EOL;
    file_put_contents("quickFormAjax.log", $incomingStr);

    $resultStr="";
    $errorStr="";
    $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");

    if(count($_REQUEST)>0 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
        $username=$_REQUEST['username'];
        $dbStatement=$dbConn->prepare("SELECT `username`, `password`, `message` FROM `loginSessionTable` WHERE `username` = :inUserName");
        $dbResult=$dbStatement->execute(array(":inUserName" => $username));

        while ($row=$dbStatement->fetch(PDO::FETCH_ASSOC)){
            $resultStr .= "{$row['username']}|{$row['password']}".PHP_EOL;
        }

        $tmpErrorsArr = $dbStatement->errorInfo();  // Any other errors?
        if ($tmpErrorsArr[0] !== "00000") $errorStr .= implode(" -- ", $tmpErrorsArr); // 00000 is no errors.
    }
    if ($errorStr !== "") echo ($errorStr);
    else echo($resultStr);
?>
