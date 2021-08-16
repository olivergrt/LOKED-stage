<?php 
session_start();
require_once('config.php'); 

	$reqAllAnnonce = $bdd->query("SELECT * FROM vehicules");
	$reqAllContact = $bdd->query("SELECT * FROM contact");
	$reqAllTitre = $bdd->query("SELECT * FROM titre");
	// $nbVehicules = $bdd->query("SELECT COUNT(*) FROM vehicules");
	$nbVehiculesDispo = $bdd->query("SELECT COUNT(*) FROM vehicules WHERE dispo = 1");
	$nbVehiculesIndispo = $bdd->query("SELECT COUNT(*) FROM vehicules WHERE dispo = 2"); 
	$contact = $reqAllContact->fetch(); 
	$titre = $reqAllTitre->fetch();
	// $nb = $nbVehicules->fetch(); 
	$nbDispo = $nbVehiculesDispo->fetch();
	$nbIndispo = $nbVehiculesIndispo->fetch();	 

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locked ™</title>
    <base href="/loked/">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
<body class="light">

	<header>
	    <nav>
	      <input type="checkbox" id="check">
	      <label for="check" class="checkbtn">
	        <i class="fa fa-bars"></i>
	      </label>
	      <label class="logo"><a class="logo" href="/loked/accueil">Loked</a></label>

	      <ul>
	      	<?php if(isset($_SESSION['idadmin'])){ ?>
		      	<li>
		      		<a class="gestion" href="/loked/account"><i style="font-size: 24px;" class="fas fa-user-circle"></i> Mon compte</a>
		      	</li>

		      	<li><a class="gestion" href="/loked/accueil">Gestion</a></li>
		      	<li><a class="gestion" href="/loked/deconnexion">Déconnexion</a></li>
	      	<?php } ?>

	        <li><a href="#">Accueil</a></li>
	        <li><a href="/loked/accueil#vehicules">Véhicules</a></li>
	        <li><a href="/loked/accueil#contact">Contact</a></li>
	        <li>
	        	<a target="_blank" href="https://fr.getaround.com/users/2254253" href="https://www.ouicar.fr/users/6a05bc9b-1fdd-11e9-b431-0a8f8d7e2c8c">Evaluations</a>
	        </li>
	      </ul>

	    </nav>
	</header>

<div id="page">	
	
<?php 
	// detail vehicules
	if (isset($_GET['vehicule'])) {
		if (!empty($_GET['vehicule'])) {
			
			require_once('vehicule.php');
		}
		else{
			header("location: /loked/accueil");
		}
	}

	// Supprimer 
	if (isset($_GET['supprimer'], $_SESSION['idadmin'])) {
	
			include('supprimer.php'); 

	}
	// suppression
	if (isset($_GET['suppression'], $_SESSION['idadmin'])) {
		
		$id	= $_GET['suppression'];
		$reqSupprimer = $bdd->prepare("DELETE FROM vehicules WHERE id = ?"); 
		$reqSupprimer->execute(array($id)); 
		header("location: /loked/accueil"); 
	}

	if (isset($_GET['gestion'], $_SESSION['idadmin'])) {

		switch ($_GET['gestion']) {

			case 'ajouter':
				include('ajouter.php');
				break;

			case 'modifier-titre':
				include('modifierTitre.php');
				break;

			case 'modifier-annonce':
				include('modifierAnnonce.php');
				break;

			case 'modifier-avis':
				include('modifierAvis.php');
				break;

			case 'modifier-contact':
				include('modifierContact.php');
				break;
			
		}
	}

?>	
<!-- bouton mode nuit / jour -->
	<div class="btn-toggle"><i class="fas fa-adjust"></i></div>

<!-- A propos -->
<?php if (!isset($_GET['vehicule'])) { ?>

	<section id="apropos">

		<?php if (!isset($_SESSION['idadmin'])) {?>

				<b><h1 class="apropos"><?= $titre['titre'] ?></h1></b>
				<p class="apropos"><?= $titre['texte'] ?></p>

	    	<?php	}
	    		else{
	    	 ?>
						<div class="gestion-modif">
							<a href="/loked/accueil/gestion/modifier-titre"><i id='edit' class="fa fa-edit"></i></a>
							<h1 class="apropos"><?= $titre['titre'] ?></h1>
							<p class="apropos"><?= $titre['texte'] ?></p>
						</div>

					<?php	} ?>

	</section>
<?php }
?><br>


	<section id="vehicules">

		<?php 
		if (isset($_SESSION['idadmin'])) { ?>

			<a href="accueil/gestion/ajouter"><button class="newAnnonce"><i id="add" class="fa fa-plus" aria-hidden="true"></i></button></a><br><br>
		<?php } ?>

		<div class="nbVehicules">
			<p>Véhicules disponibles :<h3><?= $nbDispo['0'] ?><span class="dispo"></span></h3></p>
		</div><br>	

		<div class="nbVehicules">
			<p>Véhicules indisponibles : <h3><?= $nbIndispo['0'] ?><span class="indispo"></span></h3></p>
		</div><br>

			<?php	
				while ($annonces = $reqAllAnnonce->fetch()) {

					if ($annonces['dispo'] == 1) {
						$annonces['dispo'] = 'Disponible';  
						$etat = "dispo";
					}
					else{
						$annonces['dispo'] = 'Indisponible';
						$etat = "indispo";
					}
			?>


		<table class="vehicules">
			<tr>
				<td>
					<h1 class="titre-vehicules"><?= $annonces['titre'] ?></h1>

						<?php 
						if ($annonces['dispo'] == 'Disponible') { ?>			
							<h3 id="dispo" class="etat-vehicules"><span class="<?= $etat ?>"></span><?= $annonces['dispo'] ?></h3>

			<?php	}
					else{				
					?>
					<h3 class="etat-vehicules"><span class="<?= $etat ?>"></span><?= $annonces['dispo'] ?></h3>
			<?php	}					
					?><br>

					<?php if (isset($_SESSION['idadmin'])) { ?>
						<td><a  href="index.php?gestion=modifier-annonce&modifier-annonce=<?= $annonces['id']?>"><i id='edit' class="fa fa-edit"></i></a></td>
					<?php } ?>
				</td>
			</tr>

			<tr>
				<td>
					<a href="/loked/accueil/vehicule/<?= $annonces['id'] ?>"><img class="image-vehicules" src="<?= $annonces['url'] ?>"></a>
				</td>
			</tr>

			<tr>
				<td>
					<h1><span class="prix_jour"><?= $annonces['prix_jour'] ?>€ /Jour</span></h1>
				</td>
			</tr>

			<tr>
				<td><br>

					<?php if ($annonces['urlGetaround'] != null) { ?>

					<a class="link" target="_blank" href="<?= $annonces['urlGetaround'] ?>"><button class="getaround">Voir sur Getaround.com</button></a>

					<?php } if ($annonces['urlOuicars'] != null) { ?>


					<a class="link" target="_blank" href="<?= $annonces['urlOuicars'] ?>"><button class="ouicar">Voir sur OuiCar.fr</button></a>

					  

					<?php } if (isset($_SESSION['idadmin'])) { ?>

					<td><a href="/loked/accueil/supprimer/<?= $annonces['id'] ?>"><i id="supp" class="fas fa-trash"></i></a></td>

					<?php } ?>
				</td>
			</tr>
		</table><br><br><br><br><br>
			 
		<?php	} ?>

	</section>


	<section id="contact">
		<div class="style-contact">
			<?php if (!isset($_SESSION['idadmin'])) {?>
			<p class="contact"><b>Adresse : <?= $contact['adresse'] ?></b></p>
			<p class="contact"><b>Tel : <a href="tel: +33<?= $contact['tel'] ?>">+33 <?= $contact['tel'] ?></a></b></p>
			<p class="contact"><b>E-mail : <a class="mailto" href="mailto:<?=$contact['email']?>"><?= $contact['email'] ?></a></b></p>
			<img class="map" src="img/map.png">
		</div>
		<?php	} ?>

			<?php if (isset($_SESSION['idadmin'])) {?>
				<div class="style-contact">
					<div class="gestion-modif">
						<a href="/loked/accueil/gestion/modifier-contact"><i id='edit' class="fa fa-edit"></i></a>
						<p class="contact"><b>Adresse : <?= $contact['adresse'] ?></b></p>
						<p class="contact"><b>Tel : <a href="tel: +33<?= $contact['tel'] ?>">+33 <?= $contact['tel'] ?></a></b></p>
						<p class="contact"><b>Mail : <a class="mailto" href="mailto:<?=$contact['email']?>"><?= $contact['email'] ?></a></b></p>
						<img class="map" src="img/map.png">
					</div>
			</div>
		<?php	} ?>
	</section>

</div>

<a class="btn-scroll-up" href="#"> <i class="fas fa-arrow-up"></i></a>

	<footer>
		<center><a href="/loked/mentions-legales" class="footer">Mentions Légales</a></center><br>
		<center><a href="/loked/admin" class="link"><p class="footer">ADMIN</a></center><br>


		<center><p class="footer"> Loked <i class="fas fa-copyright" aria-hidden="true"></i>&nbsp;Tous droits réservés.</i></p></center>	
	</footer>

</body>
</html>


<!-- JS NIGHT MODE -->
<script type="text/javascript">
	
	const btnToggle = document.querySelector('.btn-toggle');

	btnToggle.addEventListener('click', () => {

	    const body = document.body;

	    if(body.classList.contains('dark')){

	        body.classList.add('light')
	        body.classList.remove('dark')
	        btnToggle.innerHTML = '<i class="fas fa-adjust"></i>'

	    } else if(body.classList.contains('light')){

	        body.classList.add('dark')
	        body.classList.remove('light')
	        btnToggle.innerHTML = '<i class="fas fa-adjust"></i>'
	    }

	})
</script>
