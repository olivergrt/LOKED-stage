<?php 
require_once('config.php');

	if (isset($_SESSION['idadmin'], $_GET['gestion'])) {
	
		$reqModifContact= $bdd->query("SELECT * FROM contact");
		$infosContact = $reqModifContact->fetch();  

		if (isset($_POST['newAdresse']) AND !empty($_POST['newAdresse']) AND $_POST['newAdresse'] != $infosAnnonces['newAdresse']) {
			$newAdresse = htmlspecialchars($_POST['newAdresse']); 
			$insertAdresse = $bdd->prepare('UPDATE contact SET adresse = ?'); 
			$insertAdresse->execute(array($newAdresse)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newTel']) AND !empty($_POST['newTel']) AND $_POST['newTel'] != $infosAnnonces['newTel']) {
			$newTel = htmlspecialchars($_POST['newTel']); 
			$insertTel = $bdd->prepare('UPDATE contact SET tel = ?'); 
			$insertTel->execute(array($newTel)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newEmail']) AND !empty($_POST['newEmail']) AND $_POST['newEmail'] != $infosAnnonces['newEmail']) {
			$newEmail = htmlspecialchars($_POST['newEmail']); 
			$insertEmail = $bdd->prepare('UPDATE contact SET email = ?'); 
			$insertEmail->execute(array($newEmail)); 
			header("location: /loked/accueil");
		}
	}
	else{
		header('location: /loked/accueil');
	}
?>
<!DOCTYPE html>
<html>
	<table align="center" class="gestion">
		<form method="POST" action="">

			<tr class="gestion">	
				<td class="gestion">
				Adresse de la société
			</td>
				<td class="gestion">
					<input class="modif-titre" type="text" name="newAdresse" value="<?= $infosContact['adresse'] ?>">
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
				Numéro de Téléphone
			</td>
				<td class="gestion">
					<input class="modif-titre" type="number" name="newTel" value="<?= $infosContact['tel'] ?>">
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
				E-mail
			</td>
				<td class="gestion">
					<input class="modif-titre" type="email" name="newEmail" value="<?= $infosContact['email'] ?>">
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">
				</td>
				<td class="gestion">
					<br>
					<input class="btn-modif-titre" type="submit" value="Enregistrer" name="submitModifContact"> 
				 	<a href="/loked/accueil"><button class="modif-titre">Annuler</button></a>
				 </td>
			</tr>
		</form>
	</table>
</html>