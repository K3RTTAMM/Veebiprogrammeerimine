<?php
	require("functions.php");
	$notice = "";
	
	//kui pole sisseloginud, siis sisselogimise lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//kui logib välja
	if (isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: login.php");
	}
	
	//Algab foto laadimise osa
	$target_dir = "../pics/";
	$target_file = "";
	$uploadOk = 1;
	$imageFileType = "";
	$maxWidth = 600;
	$maxHeight = 400;
	$marginVer = 10;
	$marginHor = 10;
	
	//Kas vajutati üleslaadimise nuppu
	if(isset($_POST["submit"])) {
		
		if(!empty($_FILES["fileToUpload"]["name"])){
			
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]))["extension"]);
			$timeStamp = microtime(1) *10000;
			$target_file = $target_dir . pathinfo(basename($_FILES["fileToUpload"]["name"]))["filename"] ."_" .$timeStamp ."." .$imageFileType;
		
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Fail on pilt - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				$notice .= "See pole pildifail. ";
				$uploadOk = 0;
			}
		
			//Kas selline pilt on juba üles laetud
			if (file_exists($target_file)) {
				$notice .= "Kahjuks on selle nimega pilt juba olemas. ";
				$uploadOk = 0;
			}
			//Piirame faili suuruse
			if ($_FILES["fileToUpload"]["size"] > 1000000) {
				$notice .= "Pilt on liiga suur! ";
				$uploadOk = 0;
			}
			
			//Piirame failitüüpe
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$notice .= "Vabandust, vaid jpg, jpeg, png ja gif failid on lubatud! ";
				$uploadOk = 0;
			}
			
			//Kas saab laadida?
			if ($uploadOk == 0) {
				$notice .= "Vabandust, pilti ei laetud üles! ";
			//Kui saab üles laadida
			} else {		
				/*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
				} else {
					$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
				}*/
				
				//muudame suurust
				//lähtudes failitüübist, loome pildiobjekti
				if($imageFileType == "jpg" or $imageFileType == "jpeg"){
					$myTempImage = imagecreatefromjpeg ($_FILES["fileToUpload"]["tmp_name"]);
				}
				
				if($imageFileType == "png"){
					$myTempImage = imagecreatefrompng ($_FILES["fileToUpload"]["tmp_name"]);
				}
				
				if($imageFileType == "gif"){
					$myTempImage = imagecreatefromgif ($_FILES["fileToUpload"]["tmp_name"]);
				}					
					
				$imageWidth = imagesx($myTempImage);
				$imageHeight= imagesy($myTempImage);
				
				$sizeRatio = 1;
				if($imageWidth > $imageHeight){
					$sizeRatio = $imageWidth / $maxWidth;
				} else {
					$sizeRatio = $imageHeight / $maxHeight;
				}
				$myImage = resize_image($myTempImage, $imageWidth, $imageHeight, round($imageWidth / $sizeRatio), round($imageHeight / $sizeRatio));
				
				//lisame vesimärgi
				$stamp = imagecreatefrompng("../graphics/hmv_logo.png");
				$stampWidth = imagesx($stamp);
				$stampHeight = imagesy($stamp);
				$stampPosX = round($imageWidth / $sizeRatio) - $stampWidth - $marginHor;
				$stampPosY =round($imageHeight / $sizeRatio) - $stampHeight - $marginVer;
				imagecopy($myImage, $stamp, $stampPosX, $stampPosY, 0, 0, $stampWidth, $stampHeight);
				
				//lisame ka teksti
				$txtToImage = "Minu pilt";
				
				//loen EXIF infot
				@$exif = exif_read_data($_FILES["fileToUpload"]["tmp_name"], "ANY_TAG", 0, true);
				//var_dump($exif);
				if(!empty($exif["DateTimeOriginal"])){
					$txtToImage = "Pilt tehti: " .$exif["DateTimeOriginal"];
				} else {
					$txtToImage = "Pildistamise aeg teadmata.";
				}
				
				//teksti värv
				//imagecolorallocate oleks ilma läbipaistvuseta
				//alpha on 0 - 127 'ni
				$textColor = imagecolorallocatealpha($myImage, 150, 150, 150, 60);
				imagettftext($myImage, 20, 0, 10, 25, $textColor, "../graphics/FREESCPT.TTF", $txtToImage);
				
				//salvestame pildifaili
				if ($imageFileType == "jpg" or $imageFileType == "jpeg"){
					if(imagejpeg($myImage, $target_file, 90)){
						$notice = "Fail: " .basename($_FILES["fileToUpload"]["name"]) ." laeti üles!";
					} else {
						$notice = "Vabandust, Faili üles laadimisel tekkis viga!";
					}
				}
				if ($imageFileType == "png"){
					if(imagejpeg($myImage, $target_file, 90)){
						$notice = "Fail: " .basename($_FILES["fileToUpload"]["name"]) ." laeti üles!";
					} else {
						$notice = "Vabandust, Faili üles laadimisel tekkis viga!";
					}
				}				
				if ($imageFileType == "gif"){
					if(imagejpeg($myImage, $target_file, 90)){
						$notice = "Fail: " .basename($_FILES["fileToUpload"]["name"]) ." laeti üles!";
					} else {
						$notice = "Vabandust, Faili üles laadimisel tekkis viga!";
					}
				}

				//vabastame mälu
				imagedestroy($myTempImage);
				imagedestroy($myImage);
				
		} else {
			$notice = "Palun valige kõigepealt pildifail";
		}//kas faili nimi on olemas lõppeb
	}//kas üles laadida lõppeb
	
	function resize_image($image, $origW, $origH, $w, $h){
		$dst = imagecreatetruecolor($w, $h);
		imagecopyresampled($dst, $image, 0, 0, 0, 0, $w, $h, $origW, $origH);
		return $dst;
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Kert Tamm veebiprogemise asjad
	</title>
</head>
<body bgcolor="#ECF6CE">
	<h1>Kert Tamm</h1>
	<p>See veebileht on loodud veebiprogrammeerimise kursusel ning ei sisalda mingisugust tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja</a>!</p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<h2>Foto üleslaadimine</h2>
	<form action="photoupload.php" method="post" enctype="multipart/form-data">
		<label>Valige pildifail:</label>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Lae üles" name="submit">
	</form>
	
	<span><?php echo $notice; ?></span>
	<hr>
</body>
</html>