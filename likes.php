<?php 
	
	$dbConn = new PDO("mysql:hostname=;dbname=artistory","root","");
	$errorTxt = "";

	//updating - saving likes into DB
	$theID = "";
	$action = "";

	if (isset($_REQUEST["id"])) { $theID = $_REQUEST["id"]; }
	if (isset($_REQUEST["action"])) { $action = $_REQUEST["action"]; }
	//$user=($_REQUEST["username"]);

	if ($action === 'addLike') {
		$dbStat = $dbConn->prepare("UPDATE fileuploadtable SET likes = (likes + 1) WHERE id = :inid");
		$dbRes = $dbStat->execute([":inid" => $theID]);
	}
	else if ($action === 'addLove') {
		$dbStat = $dbConn->prepare("UPDATE fileuploadtable SET loves = (loves + 1) WHERE id = :inid");
		$dbRes = $dbStat->execute([":inid" => $theID]);
	}

	if ($theID !== "") {
		// reading from the DB
		$dbStat = $dbConn->prepare("SELECT likes, loves FROM fileuploadtable WHERE id=:inid");
		$dbRes = $dbStat->execute([":inid" => $theID]);
		$allRows = $dbStat->fetchAll(PDO::FETCH_ASSOC);
	}

	$returnStr = "{";
	if ($theID !== "" && count($allRows) > 0) {
		$returnStr .= "\"likes\": {$allRows[0]['likes']}, ";
		$returnStr .= "\"loves\": {$allRows[0]['loves']}";
	}
	$returnStr .= "}";

	echo($returnStr);
?>
