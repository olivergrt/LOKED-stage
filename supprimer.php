<!DOCTYPE html>
<?php 
$id = $_GET['supprimer'];
?>
<html>
	<section id="supprimer">	
		<center><p class="supprimer">Êtes vous sur de vouloir supprimer ce véhicule ?</p></center>
		<center><a href="/loked/accueil/suppression/<?= $id ?>"><button class="btn-supp">OUI</button></a>&nbsp;	
		<a href="/loked/accueil"><button class="modif-titre">NON</button></a></center>
	</section>
</html>