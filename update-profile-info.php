<?php
    $errorStr = "";
    $resultStr = "";
    $dbConn=new PDO("mysql:hostname=localhost;dbname=artistory","root","");
    if (count ($_REQUEST) > 1 && array_key_exists("username", $_REQUEST) && $_REQUEST["username"] !== ""){
        // echo ("I'm HERE!");
        $editcity = $_REQUEST['city'];
        $editcountry = $_REQUEST['country'];
        $editphone = $_REQUEST['phone'];
        $editemail = $_REQUEST['email'];
        $editsocialmedia = $_REQUEST['socialMedia'];
        $editinterest = $_REQUEST['interest'];
        $username = $_REQUEST['username'];
        
        //writing to database
        $dbStatement = $dbConn -> prepare("UPDATE `profile` SET
            city = :incity,
            country = :incountry,
            phone = :inphone,
            email = :inemail,
            socialMedia = :insocialMedia,
            interest = :ininterest,
            regTime = NOW()
            WHERE username= :inusername"
        );

        $dbResult = $dbStatement -> execute(array(
            ":incity" => $editcity,
            ":incountry" => $editcountry,
            ":inphone" => $editphone,
            ":inemail" => $editemail,
            ":insocialMedia" => $editsocialmedia,
            ":ininterest" => $editinterest,
            ":inusername" => $username)
        );
        
        //check to see if things are written into the databse. 
        if ($dbStatement -> rowCount() < 1) $errorStr .= " -- COULD NOT ADD ROW TO DATABASE. -- ";
        $tmpErrorsArr = $dbStatement->errorInfo();  // Any other errors?
        if ($tmpErrorsArr[0] !== "00000") $errorStr .= implode(" -- ", $tmpErrorsArr); // 00000 is no errors.
    }

    $arr = array();
    if ($errorStr !== "") {
        $arr = array ('code' => "ERROR", 'msg' => $errorStr);
        echo json_encode($arr);
    } else {
        $arr = array ('code' => "OK");
        echo json_encode($arr);
    }
    
?>