<?php
    $incomingStr = "";
    foreach ($_REQUEST as $thisKey => $thisVal) $incomingStr .= "[" . $thisKey . "][" . $thisVal. "]".PHP_EOL;
    file_put_contents("artistoryAjax.log", $incomingStr);

    if (count ($_REQUEST) > 0 && array_key_exists("", $_REQUEST) && $_REQUEST["firstName"] !== ""){
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $phone = $_REQUEST['phone'];
        $email = $_REQUEST['email'];
        $socialMedia = $_REQUEST['socialMedia'];
        $interest = $_REQUEST['interest'];
        $city = $_REQUEST['city'];
        $country = $_REQUEST['country'];
        $regTime = $_REQUEST['regTime'];
        
        //writing to database
        $dbStatement = $dbConn -> prepare("INSERT INTO `artistoryprofile` 
        (`firstName`, `lastName`, `phone`, `email`, `socialMedia`, `interest`, `city`, `country`, `regTime`) 
VALUES (:infirstName, :inlastName, :inphone, :inemail, :insocialMedia, :ininterest, :incity, :incountry, :inregTime)");
        
        $dbResult = $dbStatement -> execute(array(":infirstName" => $firstName,":inlastName" => $lastName,":inphone" => $phone,":inemail" => $email,
        ":insocialMedia" => $socialMedia, ":ininterest" => $interest, ":incity" => $city,":incountry" => $country, ":inregTime" => $regTime));

        while ($row=$dbStatement->fetch(PDO::FETCH_ASSOC)){
            $resultStr .= "{$row['firstName']}|{$row['lastName']}|{$row['phone']}|{$row['email']}|{$row['socialMedia']}|{$row['interest']}|{$row['city']}|{$row['country']}|{$row['regTime']}".PHP_EOL;
        }

        //check to see if things are written into the databse. 
        if ($dbStatement -> rowCount() < 1) $errorStr .= " -- COULD NOT ADD ROW TO DATABASE. -- ";
        $tmpErrorsArr = $dbStatement -> errorInfo();
        if ($tmpErrorsArr[0] !== "00000") $errorStr .= implode(" -- ", $tmpErrorsArr);
    
        $errorStr = "";
        if ($errorStr !== "") echo ($errorStr);
        else echo("OK");
    }

?>