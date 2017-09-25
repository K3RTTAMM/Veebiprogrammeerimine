<?php
	//muutujad
	$myName = "Kert";
	$myFamilyName = "Tamm";
	
	//var_dump($monthNamesEt);
	//Vanusega seotud muutujad
	$myAge = 0;
	$ageNote ="";
	$myBirthYear;
	$yearsOfMyLife ="";
	
	
	//Kasutajanime ja salasõnaga seotud muutujad
	$myUsername ="";
	$myPassword ="";
	$usernameNote ="";
	$passwordNote ="";

	
	//echo $_POST;
	//var_dump ($_POST);
	//echo $_POST["birthYear"];	
	
		
	//Lihtne tsükkel
	/*for ($i = 0; $i < 5; $i++)
	{
	echo "ha";
	}
	*/
	
	
	
		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kert Tamm Veebiprogrammeerimise aine</title>	
</head>

<body>
	<h2>
	<?php
		echo $myName ." " .$myFamilyName;
	?>
	
	
	
	<h1>Kodutöö</h1>
	<h1>Kasutajanime ja salasõna sisestus</h1>
	<p>Sisesta kasutajanimi ja parool</p>
	<form method="POST">
		<label>Kasutajanimi</label>
		<input name="username" id="username" type="text" value="<?php echo $myUsername; ?>">
		
		<input id="submitUsername" type="submit" value="Kinnita Kasutajanimi">
	</form>
	<form>
		<label>Salasõna</label>
		<input name="password" id="password" type="text" value="<?php echo $myPassword; ?>">
		
		<input id="submitPassword" type="submit" value="Kinnita Parool">
	
	</form>
	

	<?php
		if ($passwordNote != "")
			{
			echo $passwordNote;
			}
		if ($myPassword != "")
			{
			echo "\n <h3>Olete sisestanud kasutajanime</h3> \n" . $myPassword;
			}	
	?>

</body>
</html>