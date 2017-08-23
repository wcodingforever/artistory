<?php 
	
	$dbConn = new PDO("mysql:hostname=;dbname=artistory","root","");
	$errorTxt = "";

//updating - saving likes into DB
	$theID=($_REQUEST["id"]);
	$action="";
	if (isset($_REQUEST["id"])) {$theID = $_REQUEST["id"];}
	if (isset($_REQUEST["action"])) { $action = $_REQUEST["action"]; }
	//$user=($_REQUEST["username"]);

	if ($action === 'update') {
		$dbStat = $dbConn->prepare("UPDATE fileuploadtable SET likes = (likes + 1) WHERE id = :inid");
		$dbRes = $dbStat->execute([":inid" => $theID]);
	}

// reading from the DB
	$dbStat = $dbConn->prepare("SELECT likes, loves FROM fileuploadtable WHERE id=:inid");
	$dbRes = $dbStat->execute([":inid" => $theID]);
	while($row = $dbStat->fetch( PDO::FETCH_ASSOC)) {
   /* print_r($row);}*/
   echo ("RESULT likes: {$row['likes']".PHP_EOL);
	}

?>
