<?php
	//muutujad
	$myName = "Kert";
	$myFamilyName = "Tamm";
	
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
		echo date("d.m.Y") .", käes on " .$partOfDay;
		echo ".</p>";
		echo "<p>Lehe avamise hetkel oli kell: " .date("H:i:s") .".</p>";
	?>

</body>
</html>