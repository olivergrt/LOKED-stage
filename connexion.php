<?php 
session_start(); 
require_once('config.php'); 
if (!isset($_SESSION['idadmin'])) {

	if (isset($_POST['submit'])) {

		if (!empty($_POST['email']) AND !empty($_POST['pwd'])) {

			$email = htmlspecialchars($_POST['email']); 
			$password = sha1($_POST['pwd']); 

			$reqVerif = $bdd->prepare('SELECT * FROM administrateur WHERE email = ? AND pwd = ?'); 
			$reqVerif->execute(array($email,$password)); 
			$res = $reqVerif->rowCount(); 
			
			if ($res === 1) {
				
				$info = $reqVerif->fetch(); 
				$_SESSION['idadmin'] = $info['id']; 
				header("Location: /loked/accueil"); 
			}
			else{
				$erreur = "Identifiant ou mot de passe incorect !";
			}
		}
		else{
			$erreur = "Tous les champs doivent être complétés !"; 
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/connexion.css">
</head>
<body>
	<center><span style="color: red"><?php if (isset($erreur)) {echo $erreur;}?> </span></center>
	<center><h1 class="connexion">Gestionnaire</h1></center>
	<center><span class="warning">Attention<span><p class="warning">page réservés aux gestionnaires</p></center><br>
		
	<table align="center">
		<form method="POST" action="">
			<tr>
				<td>
					<input class="connexion" type="text" name="email" placeholder="Identifiant" required="">
				</td>
			</tr>
			<tr>
				<td>
					<input class="connexion" type="password" name="pwd" placeholder="Mot de passe" required="">
				</td>
			</tr>
			<tr>
				<td>
					<center><input value="connexion" class="btn" type="submit" name="submit"></center>
				</td>
			</tr>
		
		</form>
	</table>
</body>
</html>
<?php 
}
else{
	header('location: /loked/accueil');
}
?>