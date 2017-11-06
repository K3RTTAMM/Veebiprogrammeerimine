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
	//<?php echo createUsersTable(); ?>
	<hr>
	<h3>N�idistabel oli selline</h3>
	<table border="1" style="border: 1px solid black; border-collapse: collapse">
	<tr>
		<th>Eesnimi</th><th>perekonnanimi</th><th>e-posti aadress</th>
	</tr>
	<tr>
		<td>Juku</td><td>Porgand</td><td>juku.porgand@aed.ee</td>
	</tr>
	<tr>
		<td>Mari</td><td>Karus</td><td>mari.karus@aed.ee</td>
	</tr>
	
	</table>
	
</body>
</html>