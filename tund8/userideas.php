<?php
	require("functions.php");
	
	$notice = "";
	$ideas = "";
	
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
	
	//kas vajutati m�tte salvestamise nuppu
	if(isset($_POST["ideaBtn"])){
		
		if(isset($_POST["userIdea"]) and isset($_POST["ideaColor"]) and !empty($_POST["userIdea"]) and !empty($_POST["ideaColor"])){
			//echo $_POST["ideaColor"];
			$notice = saveIdea(test_input($_POST["userIdea"]), $_POST["ideaColor"]);
		}
	}
	
	$ideas = readAllIdeas();
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Kert Tamm veebiprogemise asjad
	</title>
</head>
<body>
	
	<p>See veebileht on loodud �ppet�� raames ning ei sisalda t�siseltv�etavat sisu.</p>
	<p><a href="?logout=1">Logi v�lja</a></p>
	<p><a href="main.php">Pealeht</a></p>
	<h2>Head m�tted</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Hea m�te: </label>
		<input name="userIdea" type="text">
		<br>
		<label>M�ttega seostuv v�rv: </label>
		<input name="ideaColor" type="color">
		<br>
		<input name="ideaBtn" type="submit" value="Salvesta m�te!"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	<h2>Palju toredaid m�tteid</h2>
	<div style="width: 40%">
		<?php echo $ideas; ?>
	</div>
	
</body>
</html>