<?php
	//muutujad
	$myName = "Kert";
	$myFamilyName = "Tamm";
	$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	
	//var_dump($monthNamesEt);
	
	//echo $monthNamesEt[3];
	$monthNow = $monthNamesEt[date("n") -1];
	
	$hourNow = date("H");
	//echo $hourNow;
	//võrdlen kellaaega ja annan hinnangu, mis päeva osaga on tegemist. (<  >   ==   <=  >=  !=)
	
	$partOfDay = "";
	
	$schoolDayStart = date("d.m.Y") ." 8:15";
	//echo $schoolDayStart;
	$schoolBegin = strtotime($schoolDayStart);
	//echo $schoolBegin;
	$timeNow = strtotime("now");
	//echo ($timeNow - $schoolBegin);
	$minutesPassed = round(($timeNow - $schoolBegin) / 60);
	//echo $minutesPassed;
	
	
	if ( $hourNow < 8 )
		{
		$partOfDay = "Varajane Hommik";
		}
	//echo $partOfDay;
	if ($hourNow >= 8 and $hourNow < 16)
		{
		$partOfDay = "Koolipäev";
		}
	if ($hourNow >= 16)
		{
		$partOfDay = "Õhtu";
		}
		
	//Vanusega seotud muutujad
	$myAge = 0;
	$ageNote ="";
	$myBirthYear;
	$yearsOfMyLife ="";

	
	//echo $_POST;
	//var_dump ($_POST);
	//echo $_POST["birthYear"];	
	
	if (isset($_POST["birthYear"]) and $_POST["birthYear"] !=0 )
		{
		$myBirthYear = $_POST["birthYear"];
		$myAge = date("Y") - $myBirthYear;
		//echo $myAge;
		$ageNote = "<p>Te olete umbes " .$myAge ." aastat vana.</p>";
		
		//Teen Listi
		$yearsOfMyLife = "<ul> \n";
		$yearNow = date("Y");
		for ($i = $myBirthYear; $i <= $yearNow; $i++)
			{
			$yearsOfMyLife .= "<li>" .$i ."</li> \n";
			}
		$yearsOfMyLife .= "</ul> \n";
		
		}
	
		
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
	<h1>
	<?php
		echo $myName ." " .$myFamilyName;
	?>
	</h1>
	
	<p>See veebileht on loodud õppetöö raames ning ei sisalda tõsiselt võetavat sisu.</p>


	<p>Kodus lisasin Mozilla browseri pordi 3128 kaudu ja logisin PUTTYs lin2'te ja WinSCPs sain index.html faili kätte, 
	kirjutasin siia selle lisaks</p>
	<p>Nägin seda veebilehte kui Mozilla oli häälestatud 3128 porti kasutama läbi FoxyProxy lisa ja PUTTY pidi ka töötama.</p>
	<p>\(^o^)/ KODUTÖÖ TEHTUD \(^o^)/</p>
	
	<?php
		echo "<p>2. Loeng - Kõige esimene PHP abil väljastatud sõnum, täitsa töötab.</p>";
		echo "<p>Täna on ";
		echo date("d. ") .$monthNow .date(" Y") .", käes on " .$partOfDay;
		echo ".</p>";
		echo "<p>Lehe avamise hetkel oli kell: " .date("H:i:s") .".</p>";
	?>
	
	
	
	<h3>3. Loeng</h1>
	<h2>Räägime vanusest</h2>
	<p>Sisesta oma sünniaasta, arvutame vanuse!</p>
	<form method="POST">
		<label>Teie sünniaasta: </label>
		<input name="birthYear" id="birthYear" type="number" min="1900" max="2017" value="<?php echo $myBirthYear; ?>">
		
		<input id="submitBirthYear" type="submit" value="Kinnita">
	
	</form>
	
	<?php
		if ($ageNote != "")
			{
			echo $ageNote;
			}
		if ($yearsOfMyLife != "")
			{
			echo "\n <h3>Olete elanud järgmistel aastatel</h3> \n" . $yearsOfMyLife;
			}	
	?>
	
</body>
</html>