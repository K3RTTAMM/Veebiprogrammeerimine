<?php
	$picsDir = "../pics/";
	$picFiles = [];
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	
	
	$allFiles = array_slice(scandir($picsDir),2);
	
	foreach ($allFiles as $file){
		$fileType = pathinfo($file, PATHINFO_EXTENSION);
		if (in_array($fileType, $picFileTypes) == true){
			array_push($picFiles, $file);	
		}
	}
	
	
	//var_dump($allFiles);
	//$picFiles = ;
	$fileCount = count($picFiles);
	$picNumber = mt_rand(0, ($fileCount - 1));
	$picFile = $picFiles[$picNumber];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Kert Tamm Veebiprogrammeerimise aine
	</title>
	
</head>
<body>
	<p>See veebileht on loodud õppetöö raames.</P>
	<h2>Pilt ülikoolist</h2>
	<img src="<?php echo $picsDir .$picFile; ?>" alt="Tallinna Ülikool">
	
</body>
</html>