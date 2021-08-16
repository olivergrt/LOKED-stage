<?php 
	// Modifier une annonce 
	if (isset($_SESSION['idadmin'], $_GET['gestion'], $_GET['modifier-annonce'])) {
		
		$idAnnonce = $_GET['modifier-annonce'];
		$reqModifAnnonce = $bdd->prepare("SELECT * FROM vehicules WHERE id = ?");
		$reqModifAnnonce->execute(array($idAnnonce)); 
		$infosAnnonces = $reqModifAnnonce->fetch();  

		if (isset($_POST['newDispo']) AND !empty($_POST['newDispo']) AND $_POST['newDispo'] != $infosAnnonces['dispo']) {
			$newDispo = htmlspecialchars($_POST['newDispo']); 
			$insertDispo = $bdd->prepare('UPDATE vehicules SET dispo = ? WHERE id = ?'); 
			$insertDispo->execute(array($newDispo, $idAnnonce)); 
			header("location: /loked/accueil");
		}

		if (isset($_POST['newTitre']) AND !empty($_POST['newTitre']) AND $_POST['newTitre'] != $infosAnnonces['titre']) {
			$newTitre = htmlspecialchars($_POST['newTitre']); 
			$insertTitre = $bdd->prepare('UPDATE vehicules SET titre = ? WHERE id = ?'); 
			$insertTitre->execute(array($newTitre, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newDescription']) AND !empty($_POST['newDescription']) AND $_POST['newDescription'] != $infosAnnonces['description']) {
			$newDescription = htmlspecialchars($_POST['newDescription']); 
			$insertDescription = $bdd->prepare('UPDATE vehicules SET description = ? WHERE id = ?'); 
			$insertDescription->execute(array($newDescription, $idAnnonce)); 
			header("location: /loked/accueil");
		}

		if (isset($_POST['newUrlImage']) AND !empty($_POST['newUrlImage']) AND $_POST['newUrlImage'] != $infosAnnonces['url']) {
			$newUrlImage = htmlspecialchars($_POST['newUrlImage']); 
			$insertUrlImage1 = $bdd->prepare('UPDATE vehicules SET url = ? WHERE id = ?'); 
			$insertUrlImage1->execute(array($newUrlImage, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newUrlImage2']) AND !empty($_POST['newUrlImage2']) AND $_POST['newUrlImage2'] != $infosAnnonces['url2']) {
			$newUrlImage2 = htmlspecialchars($_POST['newUrlImage2']); 
			$insertUrlImage2 = $bdd->prepare('UPDATE vehicules SET url2 = ? WHERE id = ?'); 
			$insertUrlImage2->execute(array($newUrlImage2, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newUrlImage3']) AND !empty($_POST['newUrlImage3']) AND $_POST['newUrlImage3'] != $infosAnnonces['url3']) {
			$newUrlImage3 = htmlspecialchars($_POST['newUrlImage3']); 
			$insertUrlImage3 = $bdd->prepare('UPDATE vehicules SET url3 = ? WHERE id = ?'); 
			$insertUrlImage3->execute(array($newUrlImage3, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newUrlImage4']) AND !empty($_POST['newUrlImage4']) AND $_POST['newUrlImage4'] != $infosAnnonces['url4']) {
			$newUrlImage4 = htmlspecialchars($_POST['newUrlImage4']); 
			$insertUrlImage4 = $bdd->prepare('UPDATE vehicules SET url4 = ? WHERE id = ?'); 
			$insertUrlImage4->execute(array($newUrlImage4, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newUrlImage5']) AND !empty($_POST['newUrlImage5']) AND $_POST['newUrlImage5'] != $infosAnnonces['url5']) {
			$newUrlImage5 = htmlspecialchars($_POST['newUrlImage5']); 
			$insertUrlImage = $bdd->prepare('UPDATE vehicules SET url5 = ? WHERE id = ?'); 
			$insertUrlImage->execute(array($newUrlImage5, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newUrlGetaround']) AND !empty($_POST['newUrlGetaround']) AND $_POST['newUrlGetaround'] != $infosAnnonces['urlGetaround']) {
			$newUrlGetaround = htmlspecialchars($_POST['newUrlGetaround']); 
			$insertUrlGetaround = $bdd->prepare('UPDATE vehicules SET urlGetaround = ? WHERE id = ?'); 
			$insertUrlGetaround->execute(array($newUrlGetaround, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newUrlOuicar']) AND !empty($_POST['newUrlOuicar']) AND $_POST['newUrlOuicar'] != $infosAnnonces['urlOuicars']) {
			$newUrlOuicar = htmlspecialchars($_POST['newUrlOuicar']); 
			$insertUrlOuicar = $bdd->prepare('UPDATE vehicules SET urlOuicars = ? WHERE id = ?'); 
			$insertUrlOuicar->execute(array($newUrlOuicar, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['prix_jour']) AND !empty($_POST['prix_jour']) AND $_POST['prix_jour'] != $infosAnnonces['prix_jour']) {
			$prix_jour = htmlspecialchars($_POST['prix_jour']); 
			$insertPrix_jour = $bdd->prepare('UPDATE vehicules SET prix_jour = ? WHERE id = ?'); 
			$insertPrix_jour->execute(array($prix_jour, $idAnnonce)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['prix_heure']) AND !empty($_POST['prix_heure']) AND $_POST['prix_heure'] != $infosAnnonces['prix_heure']) {
			$prix_heure = htmlspecialchars($_POST['prix_heure']); 
			$insertPrix_heure = $bdd->prepare('UPDATE vehicules SET prix_heure = ? WHERE id = ?'); 
			$insertPrix_heure->execute(array($prix_heure, $idAnnonce)); 
			header("location: /loked/accueil");
		}

	}
	else{
		header("location: /loked/accueil");
	}

?>
<!DOCTYPE html>
<html>
	<table align="center" class="gestion">
		<form method="POST" action="">

			<tr class="gestion">
				<td class="gestion">
					Disponibilité
				</td>
				<td class="gestion">
					<?php 
					if ($infosAnnonces['dispo'] == 1) {
						$infosAnnonces['dispo'] = 'Disponible'; 
					}
					elseif($infosAnnonces['dispo'] == 2){
						$infosAnnonces['dispo'] = 'Indisponible'; 
					}
					else{
						echo "Erreur";
					}
					?>

					<select class="disponibilite" name="newDispo">
						<option><?= $infosAnnonces['dispo']?></option>
						<?php 
						if ($infosAnnonces['dispo'] == 'Disponible') {
						?>

						<option value="2">Indisponible</option>

						<?php 
						}
						elseif($infosAnnonces['dispo'] == 'Indisponible'){
							?>
						<option value="1">Disponible</option>	
						<?php
						} 
						else{
							echo "Erreur"; 
						}
						?>
					</select>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					Titre
				</td>
				<td class="gestion">
					<input class="modif-titre" type="text" name="newTitre" value="<?= $infosAnnonces['titre']?>">
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					Description
				</td>
				<td class="gestion">
					<textarea class="modif-titre" type="text" name="newDescription" rows="6" cols="50"><?= $infosAnnonces['description']?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					URL image 1
				</td>
				<td class="gestion">
					<textarea type="text" class="modif-titre" name="newUrlImage" rows="6" cols="50" value="<?= $infosAnnonces['titre']?>"><?= $infosAnnonces['url']?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					URL image 2
				</td>
				<td class="gestion">
					<textarea type="text" class="modif-titre" name="newUrlImage2" rows="6" cols="50" value="<?= $infosAnnonces['titre']?>"><?= $infosAnnonces['url2']?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					URL image 3
				</td>
				<td class="gestion">
					<textarea type="text" class="modif-titre" name="newUrlImage3" rows="6" cols="50" value="<?= $infosAnnonces['titre']?>"><?= $infosAnnonces['url3']?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					URL image 4
				</td>
				<td class="gestion">
					<textarea type="text" class="modif-titre" name="newUrlImage4" rows="6" cols="50" value="<?= $infosAnnonces['titre']?>"><?= $infosAnnonces['url4']?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					URL image 5
				</td>
				<td class="gestion">
					<textarea type="text" class="modif-titre" name="newUrlImage5" rows="6" cols="50" value="<?= $infosAnnonces['titre']?>"><?= $infosAnnonces['url5']?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					URL Getaround.com
				</td>
				<td class="gestion">	
					<textarea type="text" class="getaround" name="newUrlGetaround" rows="6" cols="50"><?= $infosAnnonces['urlGetaround']?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					URL OuiCar.fr
				</td>
				<td class="gestion">
					<textarea class="ouicar" type="text" name="newUrlOuicar" rows="6" cols="50"><?= $infosAnnonces['urlOuicars']?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					Prix / jour
				</td>
				<td class="gestion">
					<input class="modif-titre" type="number" name="prix_jour" value="<?= $infosAnnonces['prix_jour']?>" maxlength="3">
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
					Prix / heure
				</td>
				<td class="gestion">
					<input class="modif-titre" type="number" name="prix_heure" value="<?= $infosAnnonces['prix_heure']?>" maxlength="3">
				</td>
			</tr>
			
			<tr class="gestion">
				<td class="gestion">
				</td>
				<td class="gestion"><br>
					<input class="btn-modif-titre" type="submit" value="Enregistrer" name="submitMajAnnonce">
					<a href="/loked/accueil"><button class="modif-titre">Annuler</button></a>
				</td>
			</tr>
			
		</form>
	</table>
</html>