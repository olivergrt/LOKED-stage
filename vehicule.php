<?php 
if (isset($_GET["vehicule"])) {
	if (!empty($_GET['vehicule'])) {

		$id = $_GET["vehicule"]; 
		$reqInfoVehicule = $bdd->query("SELECT * FROM vehicules WHERE id = '$id'"); 
		$infosVehicule = $reqInfoVehicule->fetch(); 

		if ($infosVehicule['dispo'] == 1) {
			$infosVehicule['dispo'] = 'Disponible';  
			$etat = "dispo";
		}
		else{
			$infosVehicule['dispo'] = 'Indisponible';
			$etat = "indispo";
		}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/style.css">
	<table class="vehicules">
		<tr>
			<td>
				<h1 class="titre-vehicules"><?= $infosVehicule['titre'] ?></h1>

			<?php 

			if ($infosVehicule['dispo'] == 'Disponible') { ?>			
				
			<h3 id="dispo" class="etat-vehicules"><span class="<?= $etat ?>"></span><?= $infosVehicule['dispo'] ?></h3>

			<?php 
			}
			else{	?>

			<h3 class="etat-vehicules"><span class="<?= $etat ?>"></span><?= $infosVehicule['dispo'] ?></h3>

			<?php	} ?><br>

			</td>
		</tr>
		<tr>
			<td>
				<!-- <img class="image-vehicules" src="<?= $infosVehicule['url'] ?>"> -->
				<!-- ZONE SLIDER -->

				<div style="max-width: 800px;" class="w3-content w3-display-container">
					
					<img class="mySlides" src="<?= $infosVehicule['url'] ?>">

					<?php 
					if ($infosVehicule['url2'] != null) { ?>
						
					<img class="mySlides" src="<?= $infosVehicule['url2'] ?>">
					
					<?php }
					?>

					<?php 
					if ($infosVehicule['url3'] != null) { ?>
						
					<img class="mySlides" src="<?= $infosVehicule['url3'] ?>">
					
					<?php }
					?>

					<?php 
					if ($infosVehicule['url4'] != null) { ?>
						
					<img class="mySlides" src="<?= $infosVehicule['url4'] ?>" style="width:100%;">
					
					<?php }
					?>

					<?php 
					if ($infosVehicule['url5'] != null) { ?>
						
					<img class="mySlides" src="<?= $infosVehicule['url5'] ?>">
					
					<?php }
					?>

					<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
					<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
					
					<h1>
						<?php if ($infosVehicule['prix_heure'] != null) { ?>
				
						<span class="prix_jour"> <?= $infosVehicule['prix_heure'] ?>€ /h</span>
						<?php } ?>

						<span class="prix_jour"><?= $infosVehicule['prix_jour'] ?>€ /Jour</span></h1>

				</div>
			</td>
		</tr>
		
		<tr>
			<td><br>

				<p id="description-titre" class="description"><b>Consulter sur</b></p>

				<?php if ($infosVehicule['urlGetaround'] != null) { ?>

					<a class="link" target="_blank" href="<?= $infosVehicule['urlGetaround'] ?>"><button class="getaround">Getaround.com</button></a>

					<?php } if ($infosVehicule['urlOuicars'] != null) { ?>


					<a class="link" target="_blank" href="<?= $infosVehicule['urlOuicars'] ?>"><button class="ouicar">OuiCar.fr</button></a>
				<?php } ?>
			</td>
		</tr>

		<tr>
			<td style="background: #F0F0F0;"><br>
				<p id="description-titre" class="description"><b>Description du véhicule</b></p><br>
				<p class="description"><?= $infosVehicule['description'] ?></p>
			</td>
		</tr>

		<tr>
			<td style="background: #F0F0F0;"><br>
				<p id="description-titre" class="description"><b>Moteur</b></p><br>
				<p class="description">Diesel</p>
			</td>
		</tr>

		<tr>
			<td style="background: #F0F0F0;"><br>
				<p id="description-titre" class="description"><b>Boite :</b></p><br>
				<p class="description">Manuelle</p>
			</td>
		</tr>

		<tr>
			<td style="background: #F0F0F0;"><br>
				<p id="description-titre" class="description"><b>Compteur</b></p><br>
				<p class="description">190 000 - 200 000 Km</p>
			</td>
		</tr>

		<tr>
			<td style="background: #F0F0F0;"><br>
				<p id="description-titre" class="description"><b>OPTIONS ET ACCESSOIRES</b></p><br>
				<p class="description"><?= $infosVehicule['description'] ?></p>
			</td>
		</tr>
	</table>


 	<!-- JS Slider -->
	<script>
		var slideIndex = 1;
		showDivs(slideIndex);

		function plusDivs(n) {
		  showDivs(slideIndex += n);
		}

		function showDivs(n) {
		  var i;
		  var x = document.getElementsByClassName("mySlides");
		  if (n > x.length) {slideIndex = 1}
		  if (n < 1) {slideIndex = x.length}
		  for (i = 0; i < x.length; i++) {
		    x[i].style.display = "none";  
		  }
		  x[slideIndex-1].style.display = "block";  
		}
	</script>
</html>

<?php 
	}
	else{
		header("Location: index.php"); 
	}
}
else{
	header("Location: index.php"); 
}

?>