<?php 
	
	$dbConn = new PDO("mysql:hostname=;dbname=artistory","root","");
	$errorTxt = "";

    // reading from the DB
	$dbStat = $dbConn->prepare("SELECT `id`, `username`, `filename`, `timestamp` FROM fileuploadtable");
	$dbRes = $dbStat->execute();
    $allRows = $dbStat->fetchAll(PDO::FETCH_ASSOC);

    $returnStr = "[";
    $innerStrArr = [];
    for ($i = 0; $i < count($allRows); $i++) {
        $innerStr = "{";
        $innerStr .= "\"id\": \"" . $allRows[$i]['id'] . "\",";
        $innerStr .= "\"username\": \"" . $allRows[$i]['username'] . "\",";
        $innerStr .= "\"filename\": \"" . $allRows[$i]['filename'] . "\",";
        $innerStr .= "\"timestamp\": \"" . $allRows[$i]['timestamp'] . "\"";
        $innerStr .= "}";
        array_push($innerStrArr, $innerStr);
    }
    $returnStr .= implode(",", $innerStrArr);
    $returnStr .= "]";

    echo $returnStr;
?>