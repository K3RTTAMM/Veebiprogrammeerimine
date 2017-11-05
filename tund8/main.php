<?php
	require("functions.php");
	//kui pole sisse logitud, liigume login lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//v�ljalogimine
	if(isset($_GET["logout"])){
		session_destroy(); //l�petab sessiooni
		header("Location: login.php");
	}
	$picsDir = "../../pics/";
	$picFiles = [];
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	
	$allFiles = array_slice(scandir($picsDir), 2);
	
	foreach ($allFiles as $file){
		$fileType = pathinfo($file, PATHINFO_EXTENSION);
		if (in_array($fileType, $picFileTypes) == true){
			array_push($picFiles, $file);
		}
	}
	
	//var_dump($picFiles);
	$fileCount = count($picFiles);
	$picNumber = mt_rand(0, ($fileCount - 1));
	$picFile = $picFiles[$picNumber];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
	<?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?>
		 veebiprogemise asjad
	</title>
</head>
<body>
	<h1><?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?></h1>
	<p>See veebileht on loodud �ppet�� raames ning ei sisalda t�siseltv�etavat sisu.</p>
	<p><a href="?logout=1">Logi v�lja</a></p>
	<p><a href="usersInfo.php">Info kasutajate kohta</a></p>
	<p><a href="userideas.php">Head m�tted</a></p>
	<h2>Pilt �likoolist</h2>
	<img src="<?php echo $picsDir .$picFile; ?>" alt="Tallinna �likool">
	
</body>
</html>