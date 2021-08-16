<?php
session_start();
require_once('config.php'); 

if (isset($_SESSION['idadmin'])){
 
	$idadmin = $_SESSION['idadmin'];

	$reqInfoUser = $bdd->query("SELECT prenom, nom, email FROM administrateur WHERE id = $idadmin"); 
	$InfoUser = $reqInfoUser->fetch();

	$reqAllUser = $bdd->query("SELECT email FROM administrateur"); 
 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<title>Mon compte</title>
	<base href="/loked/">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
		<header>
		    <nav>
		      <input type="checkbox" id="check">
		      <label for="check" class="checkbtn">
		        <i class="fa fa-bars"></i>
		      </label>
		      <label class="logo"><a class="logo" href="/loked/accueil">Loked</a></label>
		    </nav>
		</header>
	<body>
	<section id="mentions-legales">

	<center><h1 class="mentions-legales"><i style="font-size: 24px; color: red;" class="fas fa-user-circle"></i> Mon compte</h1></center><br>

  <?php
	if (isset($_GET['modifier'])) {
		
		switch ($_GET['modifier']) {
			case 'nom':
				include('modifierNom.php'); 
				break;
			
			case 'prenom':
				include('modifierPrenom.php'); 
				break;
			case 'email':
				include('modifierEmail.php'); 
				break;
			case 'mot-de-passe':
				include('modifierMdp.php'); 
				break;	
			case 'ajout-gestionnaire':
				include('ajoutGestionnaire.php'); 
				break;	
		}
	}
	?>

	<p>Nom : <?= $InfoUser['nom'] ?>	<a href="/loked/mon-compte/modifier/nom">Modifier</a></p>
	<p>Prénom : <?= $InfoUser['prenom'] ?>	<a href="/loked/mon-compte/modifier/prenom">Modifier</a></p>
	<p>E-mail : <?= $InfoUser['email'] ?>	<a href="/loked/mon-compte/modifier/email">Modifier</a></p>
	<p>Mot de passe	<a href="/loked/mon-compte/modifier/mot-de-passe">Modifier</a></p>	<br>
	<p>Autres gestionnaires : <br><br>
		
		<?php while($AllUser = $reqAllUser->fetch()){
		
		?>

		- <?= $AllUser['email'] ?></p>

	<?php } ?><br>

	<button class="ajoutGestionnaire"><a class="ajoutGestionnaire" href="/loked/mon-compte/modifier/ajout-gestionnaire">Ajouter un nouveau gestionnaire</a></button>


		

	</section>
</body>
</html>

<style type="text/css">
	
	header{
		padding-bottom: 150px;
	}
	section#mentions-legales{
		background-color: #F0F0F0;
		padding: 15px;
		color: #1F618D;
		border-radius: 10px;
		max-width: 80%;
		margin-bottom: 100px;
	}
	a.logo{
		color: white;
	}
	 h1.mentions-legales{
	  	color: #1F618D;
	  	font-size: 34px;

	}
	h2.mentions-legales{
		color: #1F618D;
		font-size: 26px;
	}
	p{
		margin-bottom: 10px;
	}
	a.ajoutGestionnaire{
		color: white;
	}
	button.ajoutGestionnaire{
		padding: 10px 10px;
		border:  0px;
		border-radius: 3px;
		box-shadow: 0px 8px 12px rgba(0,0,0,0.12);
		background-color: #1F618D;
	}
	button.ajoutGestionnaire:hover{
		padding: 11px 11px;
	}

</style>

<?php 
}
else{
	header("location: /loked/accueil");
}
?>