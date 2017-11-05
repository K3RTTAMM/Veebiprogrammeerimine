<?php
	require("functions.php");
	require("editideafunctions.php");
	$notice = "";
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
	
	//kui kl�psati uuendamise nuppu
	if(isset($_POST["ideaBtn"])){
		updateIdea($_POST["id"], test_input($_POST["userIdea"]), $_POST["ideaColor"]);
		header("Location: ?id=" .$_POST["id"]);
		//header("Location: userideas.php");
		//exit();
	}
	
	//kas kustutatakse
	if(isset($_GET["delete"])){
		deleteIdea($_GET["id"]);
		header("Location: userideas.php");
		exit();
	}
	
	$idea = getSingleIdea($_GET["id"]);
	
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
	<p><a href="userideas.php">Tagasi m�tete lehele</a></p>
	<h2>Hea m�tte toimetamine</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<input name="id" type="hidden" value="<?php echo $_GET["id"]; ?>">
		<label>Hea m�te: </label>
		<textarea name="userIdea"><?php echo $idea->text; ?></textarea>
		<br>
		<label>M�ttega seostuv v�rv: </label>
		<input name="ideaColor" type="color" value="<?php echo $idea->color; ?>">
		<br>
		<input name="ideaBtn" type="submit" value="Salvesta m�te!"><span><?php echo $notice; ?></span>
	</form>
	<p><a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a> see m�te!</p>
	<hr>

	
</body>
</html>