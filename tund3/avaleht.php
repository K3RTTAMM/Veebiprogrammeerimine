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
	<h2>Mõned lingid</h2>
	<p>Õpime <a href="http://www.tlu.ee">Tallinna Ülikoolis</a>.</p>
	<p>Minu esimene PHP leht on <a href="../esimene.php">SIIN</a>.</p>
	<p>Minu kursavenna leht on <a href="../../../~masijoon/veebiprogrammeerimine">SIIN</a>.</p>
	<p>Pilte ülikoolist näeb <a href="foto.php">SIIN</a>.</p>
	
	
	<?php
		echo "<p>Täna on ";
		echo date("d. ") .$monthNow .date(" Y") .", käes on " .$partOfDay;
		echo ".</p>";
		echo "<p>Lehe avamise hetkel oli kell: " .date("H:i:s") .".</p>";
	?>
	
</body>
</html>