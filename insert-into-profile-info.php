<?php
    $incomingStr = "";
    foreach ($_REQUEST as $thisKey => $thisVal) $incomingStr .= "[" . $thisKey . "][" . $thisVal. "]".PHP_EOL;
    file_put_contents("profile-ajax.log", $incomingStr);
    
    $errorStr = "";
    $resultStr = "";
    $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
    if (count ($_REQUEST) > 0 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
        // echo ("I'm HERE!");
        $username = $_REQUEST['username'];
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $phone = $_REQUEST['phone'];
        $email = $_REQUEST['email'];
        $socialMedia = $_REQUEST['socialMedia'];
        $interest = $_REQUEST['interest'];
        $city = $_REQUEST['city'];
        $country = $_REQUEST['country'];
        //$regTime = $_REQUEST['regTime'];
        
        //writing to database
        $dbStatement = $dbConn -> prepare("INSERT INTO `profile` 
        (`username`, `firstName`, `lastName`, `city`, `country`, `phone`, `email`, `socialMedia`, `interest`, `regTime`) 
VALUES (:inusername, :infirstName, :inlastName, :incity, :incountry, :inphone, :inemail, :insocialMedia, :ininterest, NOW())");
        
        $dbResult = $dbStatement -> execute(array(":inusername" => $username, ":infirstName" => $firstName, ":inlastName" => $lastName, 
        ":incity" => $city,":incountry" => $country, ":inphone" => $phone,":inemail" => $email, ":insocialMedia" => $socialMedia, ":ininterest" => $interest));

        //check to see if things are written into the databse. 
        if ($dbStatement -> rowCount() < 1) $errorStr .= " -- COULD NOT ADD ROW TO DATABASE. -- ";
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