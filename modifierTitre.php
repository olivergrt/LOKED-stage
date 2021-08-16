<?php 
require_once('config.php');
	if (isset($_SESSION['idadmin'], $_GET['gestion'])) {
	
		$reqModifTitre= $bdd->query("SELECT * FROM titre");
		$infosTitre = $reqModifTitre->fetch();  

		if (isset($_POST['newTitre']) AND !empty($_POST['newTitre']) AND $_POST['newTitre'] != $infosTitre['newTitre']) {
			$newTitre = htmlspecialchars($_POST['newTitre']); 
			$insertTitre = $bdd->prepare('UPDATE titre SET titre = ?'); 
			$insertTitre->execute(array($newTitre)); 
			header("location: /loked/accueil");
		}
		if (isset($_POST['newTexte']) AND !empty($_POST['newTexte']) AND $_POST['newTexte'] != $infosTitre['newTexte']) {
			$newTexte = htmlspecialchars($_POST['newTexte']); 
			$insertTexte = $bdd->prepare('UPDATE titre SET texte = ?'); 
			$insertTexte->execute(array($newTexte)); 
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
					Titre<br>(100 carractères max)
				</td>
				<td class="gestion">
					<input class="modif-titre" type="text" name="newTitre" maxlength="100" value="<?= $infosTitre['titre'] ?>">
				</td>
			</tr>
			
			<tr class="gestion">
				<td class="gestion">
				Texte
			</td>
				<td class="gestion">
					<textarea class="modif-titre" type="text" name="newTexte" rows="6" cols="50" maxlength="500"><?= $infosTitre['texte'] ?></textarea>
				</td>
			</tr>

			<tr class="gestion">
				<td class="gestion">				
				</td>
				<td class="gestion"><br>
					<input class="btn-modif-titre" value="Enregistrer" type="submit" name="submitModifTitre">
					<a href="/loked/accueil"><button class="modif-titre">Annuler</button></a>
				</td>
			</tr>

		</form>
	</table>
</html>